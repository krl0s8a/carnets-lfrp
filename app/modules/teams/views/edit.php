<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-2">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div style="max-width:200px; margin: 0 auto;">
                    <?=
                        $personal->avatar ? '<img alt="" src="' . base_url() . 'assets/uploads/avatars/thumbs/' . $personal->avatar . '" class="avatar">' :
                        '<img alt="" src="' . base_url() . 'assets/images/' . $personal->gender . '.png" class="avatar">';
                    ?>
                </div>
                <h4>
                    <?= lang('age'); ?>
                </h4>
                <p><i class="fa fa-calendar"></i>
                    <?= age($personal->birth); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <ul id="myTab" class="nav nav-tabs">
            <li class=""><a href="#personal" class="tab-grey">
                    <?= lang('tab_personal') ?>
                </a></li>
            <li class=""><a href="#laboral" class="tab-grey">
                    <?= lang('tab_laboral') ?>
                </a></li>
            <li class=""><a href="#contact" class="tab-grey">
                    <?= lang('tab_contact') ?>
                </a></li>
            <li class=""><a href="#doc" class="tab-grey">
                    <?= lang('tab_doc') ?>
                </a></li>
            <li class="" style="display:none;"><a href="#avatar" class="tab-grey">
                    <?= lang('tab_photo') ?>
                </a></li>
        </ul>
        <div class="tab-content">
            <div id="personal" class="tab-pane fade in">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-edit nb"></i>
                            <?= lang('lgd_personal'); ?>
                        </h2>
                    </div>
                    <?php
                    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                    echo form_open($this->uri->uri_string() . '#personal', $attrib);
                    ?>
                    <div class="box-content">
                        <?php $this->load->view('personal/_personal'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div id="laboral" class="tab-pane fade">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-key nb"></i>
                            <?= lang('lgd_laboral'); ?>
                        </h2>
                    </div>
                    <?php
                    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                    echo form_open($this->uri->uri_string() . '#laboral', $attrib);
                    ?>
                    <div class="box-content">
                        <?php $this->load->view('personal/_laboral'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div id="contact" class="tab-pane fade">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-key nb"></i>
                            <?= lang('lgd_contact'); ?>
                        </h2>
                    </div>
                    <?php
                    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                    echo form_open($this->uri->uri_string() . '#contact', $attrib);
                    ?>
                    <div class="box-content">
                        <?php $this->load->view('personal/_contact'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div id="doc" class="tab-pane fade">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-key nb"></i>
                            <?= lang('lgd_doc'); ?>
                        </h2>
                    </div>
                    <?php
                    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                    echo form_open($this->uri->uri_string() . '#doc', $attrib);
                    ?>
                    <div class="box-content">
                        <?php $this->load->view('personal/_doc'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div id="avatar" class="tab-pane fade">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-file-picture-o nb"></i>
                            <?= lang('change_avatar'); ?>
                        </h2>
                    </div>
                    <?php echo form_open_multipart($this->uri->uri_string() . '#avatar'); ?>
                    <div class="box-content">
                        <?php $this->load->view('personal/_photo'); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>