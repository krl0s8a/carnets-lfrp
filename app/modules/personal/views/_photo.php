<div class="row">
    <div class="col-md-5">
        <div style="position: relative;">
            <?php if ($personal->avatar && false) { ?>
                    <img src="<?php echo base_url(); ?>assets/uploads/avatars/<?= $personal->avatar ?>"
                        class="profile-image img-thumbnail">
                    <a href="#" class="btn btn-danger btn-xs po" style="position: absolute; top: 0;"
                        title="<?= lang('delete_avatar') ?>"
                        data-content="<p><?= lang('r_u_sure') ?></p><a class='btn btn-block btn-danger po-delete-avatar' href='<?= base_url('personal/deleteAvatar/' . $personal->id . '/' . $personal->avatar) ?>'> <?= lang('i_m_sure') ?></a> <button class='btn btn-block po-close'> <?= lang('no') ?></button>"
                        data-html="true" rel="popover"><i class="fa fa-trash-o"></i></a><br>
                    <br>
            <?php }
            ?>
        </div>
        <div class="form-group">
            <?= lang('change_avatar', 'change_avatar'); ?>
            <input type="file" data-browse-label="<?= lang('browse'); ?>" name="avatar" id="product_image"
                required="required" data-show-upload="false" data-show-preview="false" accept="image/*"
                class="form-control file" />
        </div>
        <?php echo form_hidden('id', $personal->id);
        echo form_button(
            array(
                'type'  => 'submit',
                'name'  => 'update_avatar',
                'class' => 'btn btn-primary'
            ),
            '<i class="fa fa-save"></i> ' . lang('save_avatar')
        );
        echo anchor(site_url('personal'), lang('cancel'), array('class' => 'btn btn-link'));
        ?>
    </div>
</div>