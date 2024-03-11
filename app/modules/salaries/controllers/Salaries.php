<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Salaries extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('salaries');
        $this->load->model(array('salary_model', 'payment_salary_model'));
        $this->load->helper(array('banks/bank','date'));

        Assets::add_module_js('salaries', 'salaries.js');
        Template::set_block('sub_nav', '_sub_nav');
    }

    public function index() {
        Template::set('toolbar_title', lang('salary_manage'));
        Template::render();
    }

    public function create() {

        if (isset($_POST['save'])) {
            if ($id = $this->save('insert')) {
                Template::set_message(lang('salary_created_success'), 'success');
                Template::redirect('salaries');
            } else {
                Template::set_message(lang('salary_created_failure'), 'danger');
            }
        }

        $this->load->model('employees/employee_model');
        $this->load->model('banks/bank_account_model');
        $this->config->load('payments');
        Template::set('payments', config_item('typepayment'));
        Template::set('banks', $this->bank_account_model->format_dropdown('id', 'name'));
        Template::set('employees', $this->employee_model->arrEmployees());
        Template::set('toolbar_title', lang('salary_create'));
        Template::render();
    }

    public function edit() {
        $id = (int) $this->uri->segment(3);
        if (empty($id)) {
            Template::set_message(lang('invalid_id'), 'danger');
            redirect('salaries');
        }
        if (isset($_POST['save'])) {
            if ($id = $this->save('update', $id)) {
                Template::set_message(lang('salary_updated_success'), 'success');
                Template::redirect('salaries');
            } else {
                Template::set_message(lang('salary_updated_failure'), 'danger');
            }
        }

        $this->load->model('employees/employee_model');
        $this->load->model('banks/bank_account_model');
        // Recuperamos todos los pagos realizados

        Template::set('payments', $this->payment_salary_model->getPaymentsBySalary($id));
        Template::set('salary', $this->salary_model->find($id));
        Template::set('banks', $this->bank_account_model->format_dropdown('id', 'name'));
        Template::set('employees', $this->employee_model->arrEmployees());
        Template::render();
    }

    public function payments(){
        Template::render();
    }

    /**
     * Acciones sobre un abonos (borrar, excel e imprimir)
     */
    public function salariesActions() {

        $this->form_validation->set_rules('form_action', lang('form_action'), 'required');

        if ($this->form_validation->run() == true) {
            if (!empty($_POST['val'])) {

                if ($this->input->post('form_action') == 'delete') {
                    foreach ($_POST['val'] as $k => $v) {
                        $this->salary_model->delete($v);
                        log_activity(
                            $this->current_user->id,
                            lang('act_delete_city') . ' : ' . $v,
                            'Localidades'
                        );
                    }
                    Template::set_message(lang('city_deleted_success'), 'success');

                    redirect($_SERVER['HTTP_REFERER']);
                }
                // Exporte excel
                if ($this->input->post('form_action') == 'export_excel') {

                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle(lang('sales'));
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('first_name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('last_name'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('email'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('company'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('group'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('status'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $user = $this->site->getUser($id);
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $user->first_name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $user->last_name);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $user->email);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $user->company);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $user->group);
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $user->status);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $filename = 'users_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('danger', lang('no_user_selected'));
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            Template::set_message(validation_errors(), 'danger');
            //$this->session->set_flashdata('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Methods Ajax
    function getSalaries() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {

            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('delete_salary') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . site_url('salaries/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('delete_salary') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button>
	        <ul class="dropdown-menu pull-right" role="menu">	            
	            <li><a href="' . site_url('salaries/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_salary') . '</a></li><li class="divider"></li><li> ' . $delete_link . '</li>';
            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, t1.label as label, concat_ws(" ",t3.last_name, t3.first_name) as full_name, t2.position, t1.date_start_period, t1.date_end_period, t1.amount_salary, t1.status')
                ->from('salary as t1')
                ->join('employees as t2', 't2.id = t1.fk_employee', 'left')
                ->join('people as t3', 't3.id = t2.people_id', 'left')
                //->orderBy('t1.id','desc')
                ->edit_column('label', '$1__$2', 'label, id')
                ->add_column('Actions', $action, 'id');
            echo $this->datatables->generate();
        }
    }

    function getPayments() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {

            $this->load->library('datatables');
            $this->datatables
                ->select('t1.id as id, t1.id as ida, t2.label, concat_ws(" ", t4.last_name, t4.first_name) as full_name, t3.position, t2.date_start_period, t2.date_end_period, t1.type_payment, t5.name, t1.date_payment, t1.amount')
                ->from('payment_salary as t1')
                ->join('bank_accounts as t5','t5.id = t1.fk_bank_account','left')
                ->join('salary as t2','t2.id = t1.fk_salary','left')
                ->join('employees as t3', 't3.id = t2.fk_employee', 'left')
                ->join('people as t4', 't4.id = t3.people_id', 'left')
                ->edit_column('label', '$1__$2', 'label, id');
            echo $this->datatables->generate();
        }
    }

    private function save($type = 'insert', $id = 0) {

        $this->form_validation->set_rules('date_start_period', lang('lbl_date_start_period'), 'required');
        $this->form_validation->set_rules('date_end_period', lang('lbl_date_end_period'), 'required');

        if (isset($_POST['pay']) && $type == 'insert') {
            $this->form_validation->set_rules('date_payment', lang('lbl_date_payment'), 'required');
            $this->load->model('payment_salary_model');

            $payment = $this->payment_salary_model->prep_data($_POST);
            $payment['date_payment'] = formatDate($_POST['date_payment'], 'd/m/Y');
        }
        if ($this->form_validation->run() === false) {
            return false;
        }

        $data = $this->salary_model->prep_data($_POST);
        $data['date_start_period'] = formatDate($data['date_start_period'], 'd/m/Y');
        $data['date_end_period'] = formatDate($data['date_end_period'], 'd/m/Y');

        $data['amount_salary'] = $_POST['amount'];
        isset($_POST['pay']) ? $data['status'] = 1 : $data['status'] = 0;

        if ($type == 'insert') {
            $data['type_payment_default'] = $_POST['type_payment'];
            $data['fk_bank_account_default'] = $_POST['fk_bank_account'];
            $data['type_payment_default'] = $_POST['type_payment'];
            $id = $this->salary_model->insert($data);
            if (is_numeric($id)) {
                if (isset($_POST['pay'])) { // Insertamos el pago
                    $payment['fk_salary'] = $id;
                    $this->payment_salary_model->insert($payment);
                }
                $result = $id;
            }
        } else {
            $result = $this->salary_model->update($id, $data);
        }
        return $result;
    }

    ///----------------------------AJAX

    function add_pay($id, $amount_salary) {
        if ($this->input->is_ajax_request()) {
            $this->load->model('banks/bank_account_model');
            $data['total_payments'] = $this->payment_salary_model->totalPaymentsBySalary($id);
            $data['banks'] = $this->bank_account_model->format_dropdown('id', 'name');
            $data['amount_salary'] = $amount_salary;
            $data['fk_salary'] = $id;
            echo $this->load->view('add_pay', $data, TRUE);
        } else {
            return false;
        }
    }

    function save_add_pay() {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('amount', lang('lbl_amount'), 'required');
            $this->form_validation->set_rules('date_payment', lang('lbl_date_payment'), 'required');
            if ($this->form_validation->run() === false) {
                echo json_encode(['error' => 1, 'msg' => validation_errors()]);
                exit();
            }
            
            $data = $this->payment_salary_model->prep_data($_POST);
            $data['date_payment'] = formatDate($_POST['date_payment'], 'd/m/Y', 'Y-m-d');
            if ($id = $this->payment_salary_model->insert($data)) {
                log_activity(
                    $this->current_user->id,
                    lang('act_create_city') . ' : ' . $id,
                    'Pagos de sueldo'
                );
                $check = $_POST['amount_salary'] - ($_POST['amount'] + $_POST['total_payments']);
                if($check > 0){
                    // Pago parcial, estado igual a 2 (pagado parcialmente)
                    $this->salary_model->update($_POST['fk_salary'], array('status' => 2));
                } else if($check == 0){ // pago total, estado igual a 1 (Pagado)
                    $this->salary_model->update($_POST['fk_salary'], array('status' => 1));
                }
                Template::set_message(lang('payment_created_success'), 'success');
            } else {
                Template::set_message(lang('payment_created_failure'), 'danger');
            }
            echo json_encode(['error' => 0]);
        }
    }

    function delete_pay() {
        $pay = $this->payment_salary_model->find($_POST['id']);        
        if ($this->payment_salary_model->delete($_POST['id'])) {
            //$amount_total = $this->salary_model->find($pay->fk_salary)->amount_salary;
            $payments = $this->payment_salary_model->totalPaymentsBySalary($pay->fk_salary);
            if($payments == 0){            
                $this->salary_model->update($pay->fk_salary, array('status' => 0));
            } else {
                $this->salary_model->update($pay->fk_salary, array('status' => 2));
            }
            Template::set_message(lang('payment_deleted_success'), 'success');
        } else {
            Template::set_message(lang('payment_deleted_failure'), 'danger');
        }
    }

    /// Callback

    public function exceeds_amount($amount) {
        $payed = $_POST['total_payments'];
        if ($_POST['amount_salary'] < ($payed + $amount)) {
            $this->form_validation->set_message('_exceeds_amount', 'El {field} ingresado excede el monto total a pagar');
            return false;
        } else {
            return true;
        }
    }
}
