<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Personal_doc_model extends MY_Model {
    // others fields

    /** @var string Name of the table. */
    protected $table_name = 'personal_doc';

    /** @var string Name of the primary key. */
    protected $key = 'id';

    /** @var bool Use soft deletes (if true). */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Set the created time automatically (if true). */
    protected $set_created = false;

    /** @var bool Set the modified time automatically (if true). */
    protected $set_modified = false;

    function __construct() {
        parent::__construct();
    }

}

/* End of file Rrhh_model.php */
/* Location: .//D/www/futuro-srl/app/modules/rrhh/models/Rrhh_model.php */