<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i>
            <?= lang('title_edit_customer'); ?>
        </h2>
    </div>
    <?php
    echo form_open($this->uri->uri_string(), array('data-toggle' => 'validator', 'role' => 'form', 'id' => 'form_customer'));
    echo form_input(array('type' => 'hidden', 'id' => 'id', 'value' => isset($customer) ? $customer->id : ''));
    ?>
    <input type="hidden" name="people_id" value="<?= $customer->people_id ?>">
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_create_teacher'); ?>
                </p>
                <div class="row">
                    <div class="col-md-3">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?php echo lang('lgd_personal') ?>
                            </legend>
                            <?php
                            // type customer
                            echo co_form_dropdown(
                                array('name' => 'type', 'id' => 'type', 'class' => 'form-control'),
                                types_of_passenger(),
                                isset($customer->type) ? $customer->type : '',
                                lang('lbl_type')
                            );
                            // dni
                            echo co_form_number(
                                array('name' => 'dni', 'id' => 'dni', 'class' => 'form-control', 'required' => 'required'),
                                isset($customer->dni) ? $customer->dni : '',
                                lang('lbl_dni')
                            );
                            // last name
                            echo co_form_input(
                                array('name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'required' => 'required'),
                                isset($customer->last_name) ? $customer->last_name : '',
                                lang('lbl_last_name')
                            );
                            // last name
                            echo co_form_input(
                                array('name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control'),
                                isset($customer->first_name) ? $customer->first_name : '',
                                lang('lbl_first_name')
                            );
                            // level
                            echo co_form_dropdown(
                                array('name' => 'level', 'id' => 'level', 'class' => 'form-control'),
                                levelsCustomer(),
                                isset($customer->level) ? $customer->level : '',
                                lang('lbl_level')
                            );
                            ?>
                        </fieldset>
                    </div>
                    <div class="col-md-3">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Origen y Destino (por defecto)</legend>
                            <?php
                            // from
                            echo co_form_dropdown(
                                array('name' => 'from_default', 'id' => 'from_default', 'class' => 'form-control'),
                                $cities,
                                isset($customer->from_default) ? $customer->from_default : '',
                                lang('lbl_from_default')
                            );
                            // to
                            echo co_form_dropdown(
                                array('name' => 'to_default', 'id' => 'to_default', 'class' => 'form-control'),
                                $cities,
                                isset($customer->to_default) ? $customer->to_default : '',
                                lang('lbl_to_default')
                            );
                            ?>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?php echo lang('lgd_school') ?>
                            </legend>
                            <div class="form-group">
                                <?php
                                if (isset($pbs) && is_array($pbs)):
                                    echo '<div id="schools">';
                                    foreach ($pbs as $k => $v) {
                                        ?>
                                        <p>
                                            <span class="btn-sm btn-danger delete-school" id="<?php echo $v['id']; ?>"><i
                                                    class="fa fa-close"></i></span>
                                            <?php echo $v['name']; ?>
                                        </p>
                                        <?php
                                    }
                                    echo '</div>';
                                endif;
                                ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_dropdown('school_id', $schools, '', array('class' => 'form-control', 'id' => 'school_id')); ?>
                            </div>
                        </fieldset>
                        <div id="tramos">
                            <?php if (is_array($pbs) && is_array($pbs)): ?>
                                <?php foreach ($pbs as $k => $v): ?>
                                    <fieldset class="scheduler-border" id="fd_<?php echo $v['id']; ?>">
                                        <legend class="scheduler-border">
                                            <?php echo lang('lgd_routes') . ' a : ' . $v['name']; ?>
                                        </legend>
                                        <div class="form-group">
                                            <div id="cities_<?php echo $v['id']; ?>">
                                                <?php if (is_array($v['tramos']) && !empty($v['tramos'])): ?>
                                                    <?php foreach ($v['tramos'] as $tramo): ?>
                                                        <p><span class="btn-sm btn-danger delete-tramo"
                                                                id="tr_<?php echo $tramo->id; ?>"><i class="fa fa-close"></i></span>
                                                            <b>DESDE</b> :
                                                            <?php echo $tramo->ffrom; ?> | <b>HASTA</b> :
                                                            <?php echo $tramo->tto; ?>
                                                        </p>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group form-inline">
                                            <label>
                                                Desde :
                                                <?php echo form_dropdown('from', $cities, '', array('class' => 'form-control', 'id' => 'from_' . $v['id'])); ?>
                                            </label>
                                            <label>
                                                Hasta :
                                                <?php echo form_dropdown('to', $cities, '', array('class' => 'form-control', 'id' => 'to_' . $v['id'])); ?>
                                            </label>
                                            <span class="btn btn-sm btn-primary add-tramo" id="ps_<?php echo $v['id']; ?>"><i
                                                    class="fa fa-plus"></i></span>
                                        </div>
                                    </fieldset>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?php
        // save
        echo form_submit(
            array('name' => 'save','class' => 'btn btn-primary'),
            lang('save')
        );
        // delete
        echo form_button(
            array('type' => 'submit', 'name' => 'delete', 'class' => 'btn btn-danger'),
            '<i class="fa fa-trash"></i>  ' . lang('delete'),
            array('onClick' => "confirm('" . lang('confirm_delete_customer') . "')")
        );
        // back
        echo anchor(site_url('passengers'), lang('cancel'), array('class' => 'btn btn-link'));
        ?>
    </div>
    <?= form_close(); ?>
</div>
<script type="text/javasript">

</script>