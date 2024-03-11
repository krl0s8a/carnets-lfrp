<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">ESCUELA : <?php echo $school->name ?></h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="margin-bottom:0;">
                    <tbody>
                        <tr>
                            <td><strong><?= lang('field_number'); ?></strong></td>
                            <td><?= $school->number; ?></strong></td>
                        </tr>
                        <tr>
                            <td><strong><?= lang('field_cue'); ?></strong></td>
                            <td><?= $school->cue; ?></strong></td>
                        </tr>
                        <tr>
                            <td><strong><?= lang('field_level'); ?></strong></td>
                            <td><?= $school->level; ?></strong></td>
                        </tr>
                        <tr>
                            <td><strong><?= lang('field_telephone'); ?></strong></td>
                            <td><?= $school->telephone; ?></strong></td>
                        </tr>
                        <tr>
                            <td><strong><?= lang('field_location'); ?></strong></td>
                            <td><?= $cities[$school->city_id]; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer no-print">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= lang('close'); ?></button>
                    <a href="<?=site_url('schools/edit/' . $school->id); ?>" class="btn btn-primary"><?= lang('edit_school'); ?></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
