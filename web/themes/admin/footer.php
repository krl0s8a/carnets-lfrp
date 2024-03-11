<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
Assets::add_js(
    array(
        'bootstrap.min.js',
        'jquery.dataTables.min.js',
        'jquery.dataTables.dtFilter.min.js',
        'select2.min.js',
        'jquery-ui.min.js',
        'bootstrapValidator.min.js',
        'custom.js',
        'jquery.calculator.min.js',
        'core.js',
        'perfect-scrollbar.min.js'
    )
);
?>
<div class="clearfix"></div>
<footer>
    <a href="#" id="toTop" class="blue"
        style="position: fixed; bottom: 30px; right: 30px; font-size: 30px; display: none;">
        <i class="fa fa-chevron-circle-up"></i>
    </a>
    <p style="text-align:center;">&copy; <?= date('Y') . ' ' . $this->settings_lib->item('site.title'); ?>
        <?php
        if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
            echo ' - Página renderizada en <strong>{elapsed_time}</strong> segundos';
        }
        ?>
    </p>
</footer>
</div>
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div class="modal fade in" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
</div>
<div id="modal-loading" style="display: none;">
    <div class="blackbg"></div>
    <div class="loader"></div>
</div>
<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>
<script type="text/javascript">
    var dt_lang = <?= $dt_lang ?>,
        dp_lang = <?= $dp_lang ?>,
        site = <?= json_encode(['url' => base_url(), 'base_url' => site_url(), 'assets' => base_url('assets'), 'settings' => '', 'dateFormats' => $dateFormats]); ?>;
    var lang = { 'download': '<?= lang('download') ?>', 'active': '<?= lang('us_active') ?>', 'inactive': '<?= lang('us_inactive') ?>' };
    var oTable = '';
    var oLengthMenu = <?= $this->settings_lib->item('site.list_limit') ?>;
</script>
<?php echo Assets::js(); ?>
</body>

</html>