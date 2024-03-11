<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('import_by_cvs'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <?php
                $attrib = ['class' => 'form-horizontal', 'data-toggle' => 'validator', 'role' => 'form'];
                echo form_open_multipart('passengers/importStudents', $attrib)
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-small">
                            <a href="<?php echo site_url('passengers/download').'?file=sample_students.csv'; ?>"
                               class="btn btn-primary pull-right"><i
                                    class="fa fa-download"></i> <?= lang('download_sample_file') ?></a>
                            <p>
                                <span class="text-warning"><?= lang('csv1'); ?></span><br/><?= lang('csv2'); ?> <span
                                class="text-info">(<?= lang('field_last_name') . ', ' . lang('field_first_name') . ', ' . lang('field_dni') . ', ' . lang('field_level'); ?>
                                )</span> <?= lang('csv3'); ?>
                            </p>
                            <p><?= lang('images_location_tip'); ?></p>
                            <span class="text-primary"><?= lang('csv_update_tip'); ?></span>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="csv_file"><?= lang('upload_file'); ?></label>
                                <input type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile" class="form-control file" data-show-upload="false" data-show-preview="false" id="csv_file" required="required"/>
                            </div>

                            <div class="form-group">
                                <?php echo form_submit('import', $this->lang->line('import'), 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
