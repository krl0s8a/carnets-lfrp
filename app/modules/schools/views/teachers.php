<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo 'ESCUELA : '.$school->name; ?></h4>
        </div>
        <div class="modal-body">
            <?= lang('list_teachers'); ?></p>
            <div class="table-responsive">
                <table id="CSUData" cellpadding="0" cellspacing="0" border="0"
                       class="table table-bordered table-condensed table-hover table-striped">
                    <thead>
                    <tr class="primary">
                        <th><?= lang('field_last_name'); ?></th>
                        <th><?= lang('field_first_name'); ?></th>
                        <th><?= lang('field_dni'); ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if (isset($teachers) && !empty($teachers)) {
                        foreach ($teachers as $teacher) {
                            echo '<tr>'.
                            '<td>' . $teacher->last_name . '</td>' .
                            '<td>' . $teacher->first_name . '</td>' .
                            '<td>' . $teacher->dni . '</td>'.
                            '<td><a href="'.site_url('passengers/editTeacher/').$teacher->id.'">Mas info...</a></td>'.'</tr>';
                            }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4" class="dataTables_empty">No hay datos disponibles en la tabla.</td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
        </div>
    </div>
</div>

