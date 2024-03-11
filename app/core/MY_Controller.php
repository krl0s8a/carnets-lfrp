<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    /** @var object Stores the current user's details, if they've logged in. */
    protected $current_user = null;

    /** @var bool If true, the user must log in to access any method. */
    protected $require_authentication = true;

    /**
     * @var array Stores a number of items to 'autoload' when the constructor runs.
     * This allows any controller to easily set items which should always be loaded,
     * but not to force the entire application to autoload it through the config/autoload
     * file.
     */
    public $autoload = array(
        'libraries' => array('events', 'form_validation'),
        'helpers'   => 'form',
    );
    protected $limit;
    protected $pager;
    protected $digital_upload_path = 'files/';
    protected $upload_path = 'assets/uploads/';
    protected $thumbs_path = 'assets/uploads/thumbs/';
    protected $image_types = 'gif|jpg|jpeg|png|tif';
    protected $digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
    protected $allowed_file_size = '1024';

    public function __construct() {
        parent::__construct();

        // Handle any autoloading here...
        // Because this may be overloaded in someone's custom controllers, this
        // will be updated to call $this->autoloadClasses() in the future.
        $this->autoload_classes();

        $controllerClass = get_class($this);
        Events::trigger('before_controller', $controllerClass);

        if ($this->require_authentication === true) {
            $this->authenticate();
        }

        // Load the lang file here, after the user's language is known
        $this->lang->load('application');

        $cacheDriver = array();

        // Performance optimizations for production environments.
        //
        // Overrides database configuration of save_queries in production/testing
        // environments and db_debug in production as a hedge against accidental
        // configuration issues.
        switch (ENVIRONMENT) {
            case 'production':
                // With debugging information turned off, at times it is possible to
                // continue on after db errors. Also turns off display of any DB errors
                // to reduce info available to hackers.
                $this->db->db_debug = false;

            // If you need more differences between production/testing, you
            // may want to prevent fall-through by adding a break before the
            // 'testing' case.
            // no break
            case 'testing':
                // Saving queries can vastly increase the memory usage.
                $this->db->save_queries = false;

                $cacheDriver['adapter'] = 'apc';
                $cacheDriver['backup'] = 'file';
                break;
            default:
                // Development niceties...
                // Profiler bar?
                $this->showProfiler();

                $cacheDriver['adapter'] = 'dummy';
                break;
        }

        $this->load->driver('cache', $cacheDriver);

        // Auto-migrate core and/or app to latest version.
        if ($this->config->item('migrate.auto_core') || $this->config->item('migrate.auto_app')
        ) {
            $this->load->library('migrations/migrations');
            $this->migrations->autoLatest();
        }

        // Make sure no assets end up as a requested page or a 404 page.
        if (!preg_match('/\.(gif|jpg|jpeg|png|css|js|ico|shtml)$/i', $this->uri->uri_string())) {
            $this->previous_page = $this->session->userdata('previous_page');
            $this->requested_page = $this->session->userdata('requested_page');
        }

        // After-Controller Constructor Event
        $controllerClass = get_class($this);
        Events::trigger('after_controller_constructor', $controllerClass);
    }

    /**
     * If the Auth lib is loaded, set $this->current_user.
     *
     * By returning if the Auth library hasn't already been loaded, we potentially
     * save some time and prevent loading unnecessary libraries.
     *
     * @return void
     */
    protected function set_current_user() {
        if (!class_exists('Auth', false)) {
            return;
        }

        // Load the currently logged-in user for convenience.
        if ($this->auth->is_logged_in()) {
            $this->current_user = clone $this->auth->user();

            $this->current_user->user_img = gravatar_link(
                $this->current_user->email,
                22,
                $this->current_user->email,
                "{$this->current_user->email} Profile"
            );

            // If the user has a language setting then use it
            if (isset($this->current_user->language)) {
                $this->config->set_item('language', $this->current_user->language);
                $this->session->set_userdata('language', $this->current_user->language);
            }
        }

        // Make the current user available in the views.
        if (!class_exists('template', false)) {
            $this->load->library('template');
        }

        $dt_lang = json_encode(lang('datatables_lang'));

        $this->load->language('calendar');
        $dp_lang = json_encode(['days' => [lang('cal_sunday'), lang('cal_monday'), lang('cal_tuesday'), lang('cal_wednesday'), lang('cal_thursday'), lang('cal_friday'), lang('cal_saturday'), lang('cal_sunday')], 'daysShort' => [lang('cal_sun'), lang('cal_mon'), lang('cal_tue'), lang('cal_wed'), lang('cal_thu'), lang('cal_fri'), lang('cal_sat'), lang('cal_sun')], 'daysMin' => [lang('cal_su'), lang('cal_mo'), lang('cal_tu'), lang('cal_we'), lang('cal_th'), lang('cal_fr'), lang('cal_sa'), lang('cal_su')], 'months' => [lang('cal_january'), lang('cal_february'), lang('cal_march'), lang('cal_april'), lang('cal_may'), lang('cal_june'), lang('cal_july'), lang('cal_august'), lang('cal_september'), lang('cal_october'), lang('cal_november'), lang('cal_december')], 'monthsShort' => [lang('cal_jan'), lang('cal_feb'), lang('cal_mar'), lang('cal_apr'), lang('cal_may'), lang('cal_jun'), lang('cal_jul'), lang('cal_aug'), lang('cal_sep'), lang('cal_oct'), lang('cal_nov'), lang('cal_dec')], 'today' => lang('today'), 'suffix' => [], 'meridiem' => []]);

        $dateFormats = [
            'js_sdate'    => 'dd/mm/yyyy',
            'php_sdate'   => 'd/m/Y',
            'mysq_sdate'  => '%d/%m/%Y',
            'js_ldate'    => 'dd/mm/yyyy hh:ii:ss',
            'php_ldate'   => 'd/m/Y H:i:s',
            'mysql_ldate' => '%d/%m/%Y %T',
            'js_stime'    => 'hh:ii',
        ];

        Template::set('dateFormats', $dateFormats);
        Template::set('dt_lang', $dt_lang);
        Template::set('dp_lang', $dp_lang);
        Template::set('ip_address', $this->input->ip_address());
        Template::set('current_user', $this->current_user);
    }

    /**
     * Ensures that a user is logged in. Any additional authentication will need
     * to be done by the child classes.
     *
     * By having the authentication handled here (rather than Authenticated_Controller),
     * it can be called in the Base_Controller's __construct() method to ensure
     * the user's chosen language is used whenever the user is logged in, even if
     * the child controller doesn't require authentication.
     *
     * @return void
     */
    protected function authenticate() {
        $this->load->library('users/auth');

        // Ensure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
    }

    /**
     * Autoload any class-specific files that are needed throughout the controller.
     * This is often used by base controllers, but can easily be used to autoload
     * models, etc.
     *
     * @deprecated since 0.9.0. Use autoloadClasses() instead. Note the difference
     * in visibility.
     *
     * @return void
     */
    public function autoload_classes() {
        $this->autoloadClasses();
    }

    /**
     * Autoload any class-specific files that are needed throughout the controller.
     * This is often used by base controllers, but can easily be used to autoload
     * models, etc.
     *
     * @return void
     */
    protected function autoloadClasses() {
        // Using ! empty() because count() returns 1 for certain error conditions.

        if (!empty($this->autoload['libraries']) && is_array($this->autoload['libraries'])
        ) {
            foreach ($this->autoload['libraries'] as $library) {
                $this->load->library($library);
            }
        }

        if (!empty($this->autoload['helpers']) && is_array($this->autoload['helpers'])
        ) {
            foreach ($this->autoload['helpers'] as $helper) {
                $this->load->helper($helper);
            }
        }

        if (!empty($this->autoload['models']) && is_array($this->autoload['models'])
        ) {
            foreach ($this->autoload['models'] as $model) {
                $this->load->model($model);
            }
        }
    }

    /**
     * Enable the profiler if it is permitted for the current request.
     *
     * @param bool $frontEnd Set to true for a front-end (public/non-admin) page,
     * false for an admin page. This determines whether the 'site.show_front_profiler'
     * setting will be used to control display of the profiler.
     *
     * @return void
     */
    protected function showProfiler($frontEnd = true) {
        if (is_cli() || $this->input->is_ajax_request()) {
            return;
        }

        if ($frontEnd && !$this->settings_lib->item('site.show_front_profiler')) {
            return;
        }

        $this->load->library('Console');
        $this->output->enable_profiler(true);
    }

}

?>