<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-eye"></i>
                <?php echo lang('perm_details'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmView'] ?>
        <?php echo form_open($this->uri->uri_string(), $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>
                                <?= lang('field_name') ?>
                            </th>
                            <td>
                                <?= $permission->name ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('perm_description') ?>
                            </th>
                            <td>
                                <?= $permission->description ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('status') ?>
                            </th>
                            <td>
                                Activo
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="display:none;">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                <?= lang('close') ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>