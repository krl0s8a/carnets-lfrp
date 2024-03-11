<?php

class Users extends MY_Controller {

    private $siteSettings;
    private $permissionCreate = 'Bonfire.Users.Add';
    private $userAdd = 'Core.User.Add';
    private $userEdit = 'Core.User.Edit';
    private $permissionManage = 'Bonfire.Users.Manage';

    function __construct() {
        $this->load->helper(array('date', 'users'));
        $this->load->library('form_validation');
        $this->load->library('users/auth');

        $this->load->model('users/user_model');
        $this->load->model('roles/role_model');

        $this->siteSettings = $this->settings_lib->find_all();
        Assets::add_module_js('users', 'users.js');
        Assets::add_module_css('users', 'users.css');

        Template::set_block('sub_nav', '_sub_nav');
        $this->set_current_user();
    }

    /*
     * Display the user list and manage the user deletions/banning/purge.
     *
     * @param string $filter The filter to apply to the list.
     * @param int    $offset The offset from which the list will start.
     *
     * @return  void
     */

    public function index($filter = 'all', $offset = 0) {
        $this->auth->restrict($this->permissionManage);
        if (isset($_POST['form_action'])) {
            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {
                    $c = 0;
                    foreach ($_POST['val'] as $id) {
                        if ($id != $this->session->userdata('user_id')) {
                            if ($this->user_model->delete($id)) {
                                $c++;
                            }
                        }
                    }
                    if ($c > 0) {
                        Template::set_message(lang('us_deleted') . $c, 'success');
                    } else {
                        Template::set_message(lang('us_deleted_0'), 'danger');
                    }
                }
                if ($this->input->post('form_action') == 'export_excel') {
                    Template::set_message('Todavia falta esta funcionalidad', 'warning');
                }
            } else {
                Template::set_message(lang('us_no_selected'), 'danger');
            }
        }
        Template::set('per_page', $this->settings_lib->item('site.list_limit'));
        Template::set('toolbar_title', lang('us_user_management'));
        Template::render();
    }

    // records users

    public function getUsers() {
        if (!$this->input->is_ajax_request()) {
            redirect('404', 'refresh');
        } else {
            $edit_user = '<a href="' . site_url('users/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('us_edit_user') . '</a>';
            $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line('us_delete_user') . "</b>' data-content=\"<p>"
                . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete-user' id='a__$1' href='" . site_url('users/delete/$1') . "'>"
                . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
                . lang('us_delete_user') . '</a>';

            $action = '<div class="text-center"><div class="btn-group text-left">'
                . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
                . lang('actions') . ' <span class="caret"></span></button><ul class="dropdown-menu pull-right" role="menu">';

            $action .= '<li>' . $edit_user . '</li>';

            $action .= '<li>' . $delete_link . '</li>';

            $action .= '</ul></div></div>';

            $this->load->library('datatables');
            $this->datatables
                ->select($this->db->dbprefix('users') . '.id as id, username, email, ' . $this->db->dbprefix('roles') . '.role_name, last_login, last_ip, active')
                ->from('users')
                ->join('roles', 'users.role_id= roles.role_id', 'left')
                ->group_by('users.id')
                ->edit_column('active', '$1__$2', 'active, id')
                ->edit_column('username', '$1__$2', 'username, id')
                ->add_column('Actions', $action, 'id');

            echo $this->datatables->generate();
        }
    }

    // -------------------------------------------------------------------------
    // Authentication (Login/Logout)
    // -------------------------------------------------------------------------

    /**
     * Present the login view and allow the user to login.
     *
     * @return void
     */
    public function login() {
        // If the user is already logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('login');
            //Template::redirect($this->auth->login_destination);
        }

        // Try to login.
        if (isset($_POST['log-me-in']) && true === $this->auth->login(
            $this->input->post('login'),
            $this->input->post('password'),
            $this->input->post('remember_me') == '1'
        )
        ) {
            log_activity(
                $this->auth->user_id(),
                lang('us_log_logged') . ': ' . $this->input->ip_address(),
                'users'
            );

            // Now redirect. (If this ever changes to render something, note that
            // auth->login() currently doesn't attempt to fix `$this->current_user`
            // for the current page load).
            // If the site is configured to use role-based login destinations and
            // the login destination has been set...
            if ($this->settings_lib->item('auth.do_login_redirect') && !empty($this->auth->login_destination)
            ) {
                Template::redirect($this->auth->login_destination);
            }

            // If possible, send the user to the requested page.
            if (!empty($this->requested_page)) {
                Template::redirect($this->requested_page);
            }

            // If there is nowhere else to go, go home.
            Template::redirect('welcome');
        }

        // Prompt the user to login.
        Template::set('page_title', lang('us_login'));
        Template::render('login');
    }

    /**
     * Log out, destroy the session, and cleanup, then redirect to the home page.
     *
     * @return void
     */
    public function logout() {
        if (isset($this->current_user->id)) {
            // Login session is valid. Log the Activity.
            log_activity(
                $this->current_user->id,
                lang('us_log_logged_out') . ': ' . $this->input->ip_address(),
                'users'
            );
        }

        // Always clear browser data (don't silently ignore user requests).
        $this->auth->logout();
        Template::redirect('login');
    }

    /**
     * Create a new user.
     *
     * @return void
     */
    public function create() {
        $this->auth->restrict($this->userAdd);

        $this->load->config('address');
        $this->load->helper('address');
        $this->load->helper('date');

        if (isset($_POST['save'])) {
            if ($id = $this->saveUser('insert')) {
                $user = $this->user_model->find($id);
                $logName = empty($user->display_name) ? ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email) : $user->display_name;
                log_activity(
                    $this->auth->user_id(),
                    sprintf(lang('us_log_create'), $user->role_name) . ": {$logName}",
                    'users'
                );
                Template::set_message(lang('us_user_created_success'), 'success');

                redirect('users');
            }
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        Template::set(
            'roles',
            $this->role_model->select('role_id, role_name, default')
                ->where('deleted', 0)
                ->order_by('role_name', 'asc')
                ->find_all()
        );

        $this->load->model('state_model');
        Template::set('states', $this->state_model->getStates());
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCitiesByState(2));
        Template::set('gen_password', generatePassword(10));
        Template::set('toolbar_title', lang('us_create_user'));
        Template::set_view('users/user_form');
        Template::render();
    }

    /**
     * Edit a user.
     *
     * @param number/string $userId The ID of the user to edit. If empty, the
     * current user will be displayed/edited.
     *
     * @return void
     */
    public function edit($userId = '') {

        $this->load->config('address');
        $this->load->helper('address');
        $this->load->helper('date');

        // If no id is passed in, edit the current user.
        if (empty($userId)) {
            $userId = $this->auth->user_id();
        }

        if (empty($userId)) {
            Template::set_message(lang('us_empty_id'), 'danger');

            redirect('users');
        }

        if ($userId != $this->auth->user_id()) {
            //$this->auth->restrict($this->permissionManage);
            $this->auth->restrict($this->userEdit);
        }

        $this->load->config('user_meta');
        $metaFields = config_item('user_meta_fields');
        Template::set('meta_fields', $metaFields);

        $user = $this->user_model->find_user_and_meta($userId);

        if (isset($_POST['save'])) {
            if ($this->saveUser('update', $userId, $metaFields, $user->role_name)) {
                $user = $this->user_model->find_user_and_meta($userId);
                $logName = empty($user->display_name) ? ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email) : $user->display_name;
                log_activity(
                    $this->auth->user_id(),
                    lang('us_log_edit') . ": {$logName}",
                    'users'
                );
                Template::set_message(lang('us_user_update_success'), 'success');

                // Redirect to the edit page to ensure that a password change
                // forces a login check.
                redirect($this->uri->uri_string());
            }
        }

        if (!isset($user)) {
            Template::set_message(
                sprintf(lang('us_unauthorized'), $user->role_name),
                'danger'
            );

            redirect('users');
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        Template::set(
            'roles',
            $this->role_model->select('role_id, role_name, default')
                ->where('deleted', 0)
                ->order_by('role_name', 'asc')
                ->find_all()
        );

        // recuperamos los empleados que se pueden asociar a un usuario
        $this->load->model('employees/employee_model');
        $this->employee_model->select('employees.id, last_name, first_name, position');
        $this->employee_model->join('people', 'people.id = employees.people_id', 'left');
        $aux_employees = $this->employee_model->find_all();

        foreach ($aux_employees as $v) {
            $employees[0] = '--Ninguno--';
            $employees[$v->id] = $v->last_name . ' ' . $v->first_name . ' (' . $v->position . ')';
        }


        $this->load->model('state_model');
        Template::set('states', $this->state_model->getStates());
        $this->load->model('cities/city_model');
        Template::set('cities', $this->city_model->getCitiesByState(2));
        Template::set('employees', $employees);
        Template::set('user', $user);
        Template::set('toolbar_title', lang('us_edit_user'));
        Template::render();
    }

    public function view($userId = '') {

        $this->load->config('address');
        $this->load->helper('address');
        $this->load->helper('date');

        // If no id is passed in, edit the current user.
        if (empty($userId)) {
            $userId = $this->auth->user_id();
        }

        if (empty($userId)) {
            Template::set_message(lang('us_empty_id'), 'danger');

            redirect('users');
        }

        if ($userId != $this->auth->user_id()) {
            $this->auth->restrict($this->permissionManage);
        }

        $this->load->config('user_meta');
        $metaFields = config_item('user_meta_fields');
        Template::set('meta_fields', $metaFields);

        $user = $this->user_model->find_user_and_meta($userId);

        if (!isset($user)) {
            Template::set_message(
                sprintf(lang('us_unauthorized'), $user->role_name),
                'danger'
            );

            redirect('users');
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        Template::set(
            'roles',
            $this->role_model->select('role_id, role_name, default')
                ->where('deleted', 0)
                ->order_by('role_name', 'asc')
                ->find_all()
        );

        $this->load->model('state_model');
        $user->state = isset($this->state_model->getStates()[$user->state_id]) ? $this->state_model->getStates()[$user->state_id] : '';
        $this->load->model('cities/city_model');
        $user->city = isset($this->city_model->getCitiesByState(2)[$user->city_id]) ? $this->city_model->getCitiesByState(2)[$user->city_id] : '';

        $data['user'] = $user;
        echo $this->load->view('users/view', $data, TRUE);

    }



    /**
     * Force all users to require a password reset on their next login.
     *
     * Intended to be used as an AJAX function.
     *
     * @return void
     */
    public function force_password_reset_all() {
        $this->auth->restrict($this->permissionManage);

        if ($this->user_model->force_password_reset()) {
            // Resets are in place, so log the user out.
            $this->auth->logout();

            Template::redirect(LOGIN_URL);
        } else {
            Template::redirect($this->previous_page);
        }
    }

    /**
     * Display the registration form for the user and manage the registration process.
     *
     * The redirect URLs for success (Login) and failure (register) can be overridden
     * by including a hidden field in the form for each, named 'register_url' and
     * 'login_url' respectively.
     *
     * @return void
     */
    public function register() {
        // Are users allowed to register?
        if (!$this->settings_lib->item('auth.allow_register')) {
            Template::set_message(lang('us_register_disabled'), 'danger');
            Template::redirect('/');
        }

        $register_url = $this->input->post('register_url') ?: REGISTER_URL;
        $login_url = $this->input->post('login_url') ?: LOGIN_URL;

        $this->load->model('roles/role_model');
        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);

        if (isset($_POST['register'])) {
            if ($userId = $this->saveUser('insert', 0, $meta_fields)) {
                // User Activation
                $activation = $this->user_model->set_activation($userId);
                $message = $activation['message'];
                $error = $activation['error'];

                Template::set_message($message, $error ? 'danger' : 'success');

                log_activity($userId, lang('us_log_register'), 'users');
                Template::redirect($login_url);
            }

            Template::set_message(lang('us_registration_fail'), 'danger');
            // Don't redirect because validation errors will be lost.
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        // Generate password hint messages.
        $this->user_model->password_hints();

        Template::set_view('register');
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));
        Template::set('page_title', 'Register');
        Template::render();
    }

    /**
     * Save the user.
     *
     * @param  string  $type            The type of operation ('insert' or 'update').
     * @param  int $id              The id of the user (ignored on insert).
     * @return boolean /integer The id of the inserted user or true on successful
     * update. False if the insert/update failed.
     */
    private function saveUser($type = 'insert', $id = 0, $metaFields = array(), $currentRoleName = '') {
        $extraUniqueRule = '';

        if ($type != 'insert') {
            if ($id == 0) {
                $id = $this->current_user->id;
            }
            $_POST['id'] = $id;
            // Security check to ensure the posted id is the current user's id.
            if ($_POST['id'] != $this->current_user->id) {
                $this->form_validation->set_message('email', 'lang:us_invalid_userid');
                //return false;
            }
            $extraUniqueRule = ',users.id';
        }

        $this->form_validation->set_rules($this->user_model->get_validation_rules($type));

        $usernameRequired = '';
        if ($this->settings_lib->item('auth.login_type') == 'username' || $this->settings_lib->item('auth.use_usernames')
        ) {
            $usernameRequired = 'required|';
        }

        $this->form_validation->set_rules('username', 'lang:bf_username', "{$usernameRequired}trim|max_length[30]|unique[users.username{$extraUniqueRule}]");
        $this->form_validation->set_rules('email', 'lang:bf_email', "required|trim|valid_email|max_length[254]|unique[users.email{$extraUniqueRule}]");

        // If a value has been entered for the password, pass_confirm is required.
        // Otherwise, the pass_confirm field could be left blank and the form validation
        // would still pass.
        if ($type != 'insert' && $this->input->post('password')) {
            $this->form_validation->set_rules('pass_confirm', 'lang:bf_password_confirm', "required|matches[password]");
        }

        $userIsAdmin = isset($this->current_user) && $this->current_user->role_id == 1;

        // Setting the payload for Events system.
        $payload = array('user_id' => $id, 'data' => $this->input->post());

        // Event "before_user_validation" to run before the form validation.
        //Events::trigger('before_user_validation', $payload);

        if ($this->form_validation->run() === false) {
            return false;
        }

        // Compile our core user elements to save.
        $data = $this->user_model->prep_data($this->input->post());
        $result = false;

        if ($type == 'insert') {
            $activationMethod = $this->settings_lib->item('auth.user_activation_method');
            if ($activationMethod == 0) {
                // No activation method, so automatically activate the user.
                $data['active'] = 1;
            }

            $id = $this->user_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->user_model->update($id, $data);
        }

        // Add result to payload.
        $payload['result'] = $result;
        // Trigger event after saving the user.
        Events::trigger('save_user', $payload);

        return $result;
    }

    // -------------------------------------------------------------------------
    // User Management (Register/Update Profile)
    // -------------------------------------------------------------------------

    /**
     * Allow a user to edit their own profile information.
     *
     * @return void
     */
    public function profile() {
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);

        if (isset($_POST['update'])) {
            $user_id = $this->current_user->id;
            if ($this->saveUser('update', $user_id, $meta_fields)) {
                $user = $this->user_model->find($user_id);
                $log_name = empty($user->display_name) ?
                    ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email) : $user->display_name;

                log_activity(
                    $this->current_user->id,
                    lang('us_log_edit_profile') . ": {$log_name}",
                    'users'
                );

                Template::set_message(lang('us_profile_updated_success'), 'success');

                // Redirect to make sure any language changes are picked up.
                Template::redirect('/users/profile');
            }

            Template::set_message(lang('us_profile_updated_error'), 'danger');
        } elseif (isset($_POST['change_password'])) {
            $this->form_validation->set_rules('old_password', lang('old_password'), 'required');
            $this->form_validation->set_rules('password', lang('bf_password'), 'required|min_length[8]|max_length[25]');
            $this->form_validation->set_rules('pass_confirm', lang('bf_password_confirm'), 'required|matches[password]');

            $user = $this->user_model->find($_POST['id']);

            if ($this->form_validation->run() == true) {
                if ($this->auth->check_password($_POST['old_password'], $user->password_hash)) {
                    if ($this->user_model->update($_POST['id'], array('password' => $_POST['password']))) {
                        log_activity(
                            $this->current_user->id,
                            lang('us_log_edit_profile') . ": " . $_POST['id'],
                            'Usuarios'
                        );
                        Template::set_message(lang('us_pass_success'), 'success');
                    } else {
                        Template::set_message(lang('us_pass_failure'), 'danger');
                    }
                } else {
                    Template::set_message(lang('us_pass_no_identical'), 'danger');
                }
            }
        }

        // Get the current user information.
        $user = $this->user_model->find_user_and_meta($this->current_user->id);

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        Template::set(
            'roles',
            $this->role_model->select('role_id, role_name, default')
                ->where('deleted', 0)
                ->order_by('role_name', 'asc')
                ->find_all()
        );
        // Generate password hint messages.
        $this->user_model->password_hints();

        Template::set('user', $user);
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));
        Template::set('toolbar_title', lang('us_profile'));
        Template::set_view('profile');
        Template::render();
    }

    //--------------------------------------------------------------------------
    // ACTIVATION METHODS
    //--------------------------------------------------------------------------

    /**
     * Activate the selected user account.
     *
     * @param int $userId The ID of the user to activate.
     *
     * @return void
     */
    public function activate($userId) {
        $this->setUserStatus($userId, 1, 0);
    }

    /**
     * Deactivate the selected user account.
     *
     * @param int $userId The ID of the user to deactivate.
     *
     * @return void
     */
    public function deactivate($userId) {
        $this->setUserStatus($userId, 0, 0);
    }

    /**
     * Activate or deactivate a user from the users dashboard.
     *
     * @param int $userId        The ID of the user to activate/deactivate.
     * @param int $status        1 = Activate, -1 = Deactivate.
     * @param int $suppressEmail 1 = Suppress, All others = send email.
     *
     * @return void
     */
    private function setUserStatus($userId = false, $status = 1, $suppressEmail = 0) {
        if ($userId === false || $userId == -1) {
            Template::set_message(lang('us_err_no_id'), 'error');
            return;
        }

        $suppressEmail = isset($suppressEmail) && $suppressEmail == 1;
        $result = false;
        $type = '';

        // Set the user status (activate/deactivate the user).
        if ($status == 1) {
            $result = $this->user_model->admin_activation($userId);
            $type = lang('bf_action_activate');
        } else {
            $result = $this->user_model->admin_deactivation($userId);
            $type = lang('bf_action_deactivate');
        }

        if (!$result) {
            if (!empty($this->user_model->error)) {
                Template::set_message(lang('us_err_status_error') . $this->user_model->error, 'error');
            }
            return;
        }

        // If the status change succeeded, log the change and, if necessary,
        // send the user activation email.
        $user = $this->user_model->find($userId);
        $logName = $this->settings_lib->item('auth.use_own_names') ? $this->current_user->username : ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email);

        log_activity(
            $this->auth->user_id(),
            lang('us_log_status_change') . ": {$logName} : {$type}ed",
            'users'
        );

        $message = lang('us_active_status_changed');

        // If the user was activated and the email is not suppressed, send it.
        if ($status == 1 && !$suppressEmail && false) {
            $this->load->library('emailer/emailer');
            $siteTitle = $this->settings_lib->item('site.title');

            $data = array(
                'to' => $user->email,
                'subject' => lang('us_account_active'),
                'message' => $this->load->view('_emails/activated', array('link' => site_url(), 'title' => $siteTitle), true),
            );

            if ($this->emailer->send($data)) {
                $message = lang('us_active_email_sent');
            } else {
                $message = lang('us_err_no_email') . $this->emailer->error;
            }
        }
        Template::set_message($message, 'success');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // -------------------------------------------------------------------------
    // Password Management
    // -------------------------------------------------------------------------

    /**
     * Allow a user to request the reset of a forgotten password. An email is sent
     * with a special temporary link that is only valid for 24 hours. This link
     * takes the user to reset_password().
     *
     * @return void
     */
    public function forgot_password() {
        // If the user is logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('/');
        }

        if (isset($_POST['send'])) {
            // Validate the form to ensure a valid email was entered.
            $this->form_validation->set_rules('email', 'lang:bf_email', 'required|trim|valid_email');
            if ($this->form_validation->run() !== false) {
                // Validation passed. Does the user actually exist?
                $user = $this->user_model->find_by('email', $this->input->post('email'));
                if ($user === false) {
                    // No user found with the entered email address.
                    Template::set_message(lang('us_invalid_email'), 'error');
                } else {
                    // User exists, create a hash to confirm the reset request.
                    $this->load->helper('string');
                    $hash = sha1(random_string('alnum', 40) . $this->input->post('email'));

                    // Save the hash to the db for later retrieval.
                    $this->user_model->update_where(
                        'email',
                        $this->input->post('email'),
                        array('reset_hash' => $hash, 'reset_by' => strtotime("+24 hours"))
                    );

                    // Create the link to reset the password.
                    $pass_link = site_url('reset_password/' . str_replace('@', ':', $this->input->post('email')) . "/{$hash}");

                    // Now send the email
                    $this->load->library('emailer/emailer');
                    $data = array(
                        'to' => $this->input->post('email'),
                        'subject' => lang('us_reset_pass_subject'),
                        'message' => $this->load->view(
                            '_emails/forgot_password',
                            array('link' => $pass_link),
                            true
                        ),
                    );

                    if ($this->emailer->send($data)) {
                        Template::set_message(lang('us_reset_pass_message'), 'success');
                    } else {
                        Template::set_message(lang('us_reset_pass_error') . $this->emailer->error, 'error');
                    }
                }
            }
        }

        Template::set_view('users/forgot_password');
        Template::set('page_title', 'Password Reset');
        Template::render();
    }

    /**
     * Allows the user to create a new password for their account. At the moment,
     * the only way to get here is to go through the forgot_password() process,
     * which creates a unique code that is only valid for 24 hours.
     *
     * Since 0.7 this method is also reached via the force_password_reset security
     * features.
     *
     * @param string $email The email address to check against.
     * @param string $code  A randomly generated alphanumeric code. (Generated by
     * forgot_password()).
     *
     * @return void
     */
    public function reset_password($email = '', $code = '') {
        // If the user is logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('/');
        }

        // Bonfire may have stored the email and code in the session.
        if (empty($code) && $this->session->userdata('pass_check')) {
            $code = $this->session->userdata('pass_check');
        }

        if (empty($email) && $this->session->userdata('email')) {
            $email = $this->session->userdata('email');
        }

        // If there is no code/email, then it's not a valid request.
        if (empty($code) || empty($email)) {
            Template::set_message(lang('us_reset_invalid_email'), 'error');
            Template::redirect(LOGIN_URL);
        }

        // Handle the form
        if (isset($_POST['set_password'])) {
            $this->form_validation->set_rules('password', 'lang:bf_password', 'required|max_length[120]|valid_password');
            $this->form_validation->set_rules('pass_confirm', 'lang:bf_password_confirm', 'required|matches[password]');

            if ($this->form_validation->run() !== false) {
                // The user model will create the password hash.
                $data = array(
                    'password' => $this->input->post('password'),
                    'reset_by' => 0,
                    'reset_hash' => '',
                    'force_password_reset' => 0,
                );

                if ($this->user_model->update($this->input->post('user_id'), $data)) {
                    log_activity($this->input->post('user_id'), lang('us_log_reset'), 'users');

                    Template::set_message(lang('us_reset_password_success'), 'success');
                    Template::redirect(LOGIN_URL);
                }

                if (!empty($this->user_model->error)) {
                    Template::set_message(sprintf(lang('us_reset_password_error'), $this->user_model->error), 'error');
                }
            }
        }

        // Check the code against the database
        $email = str_replace(':', '@', $email);
        $user = $this->user_model->find_by(
            array(
                'email' => $email,
                'reset_hash' => $code,
                'reset_by >=' => time(),
            )
        );

        // $user will be an Object if a single result was returned.
        if (!is_object($user)) {
            Template::set_message(lang('us_reset_invalid_email'), 'error');
            Template::redirect(LOGIN_URL);
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        // At this point, it is a valid request....
        Template::set('user', $user);

        Template::set_view('users/reset_password');
        Template::render();
    }

}

?>