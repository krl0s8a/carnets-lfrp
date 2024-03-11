<?php
class Migracion extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    public function pasajeros() {
        // recuperamos los registros de la tabla usuarios
        $this->load->model('passengers/passenger_model');
        $this->load->model('people/people_model');
        $passengers = $this->passenger_model->find_all();
        //Elimina el registro que esta duplicado
        $this->passenger_model->delete(14816);

        // Insertamos en la tabla people
        foreach ($passengers as $p) {
            if ($p->address_city == 0) {
                $city = 1;
            } else {
                $city = $p->address_city;
            }
            $people = array(
                'first_name' => $p->first_name,
                'last_name' => $p->last_name,
                'birth' => null,
                'gender' => '',
                'cuil' => $p->dni,
                'dni' => $p->dni,
                'address' => '',
                'movil_phone' => '',
                'city_id' => $city
            );

            $id = $this->people_model->insert($people);

            if (is_numeric($id)) {
                // Actualizamos el people_id de la tabla passengers
                $this->passenger_model->update($p->id, array('people_id' => $id));
            }
        }
        // luego en la tabla de empleados
    }

    public function personal() {
        $this->load->model('users/user_model');
        $this->load->model('people/people_model');

        $this->user_model->where('id >', 1);
        $users = $this->user_model->find_all();

        foreach ($users as $p) {
            $list = explode('-', $p->cuil);
            if ($p->city_id == 0) {
                $city = 1;
            } else {
                $city = $p->city_id;
            }
            $people = array(
                'first_name' => $p->first_name,
                'last_name' => $p->last_name,
                'birth' => ($p->birth == '0000-00-00') ? null : $p->birth,
                'gender' => trim($p->gender),
                'cuil' => trim($p->cuil),
                'dni' => (int) $list[1],
                'address' => $p->address,
                'movil_phone' => trim($p->movil_phone),
                'city_id' => $city
            );

            $id = $this->people_model->insert($people);

            if (is_numeric($id)) {
                $this->load->model('employees/employee_model');
                $employee = array(
                    'work_file' => $p->work_file,
                    'position' => $p->position,
                    'dateemployment' => ($p->dateemployment == '0000-00-00') ? null : $p->dateemployment,
                    'dateemploymentend' => ($p->dateemploymentend == '0000-00-00') ? null : $p->dateemploymentend,
                    'people_id' => $id
                );

                if (is_numeric($this->employee_model->insert($employee))) {
                    # eliminamos el registro de la tabla usuarios
                    //$this->user_model->delete($p->id);
                }
            }
        }
    }
}
?>