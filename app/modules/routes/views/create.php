<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>
            <?= lang('new_route'); ?>
        </h2>
    </div>
    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreateRoute'];
    echo form_open($this->uri->uri_string(), $attrib);
    $index = 'bs_' . rand(1, 999999);
    ?>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">
                    <?php echo lang('info_create'); ?>
                </p>
                <input type="hidden" id="index_arr" name="index_arr" value="<?php echo $index; ?>" />
                <div class="row">
                    <div class="col-md-3">
                        <?php
                        echo co_form_input(
                            array(
                                'name' => 'name',
                                'class' => 'form-control',
                                'required' => 'required'
                            ),
                            set_value('name'),
                            lang('lbl_name')
                        );
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                        echo co_form_dropdown(
                            array(
                                'name' => 'line_id',
                                'class' => 'form-control',
                                'required' => 'required'
                            ),
                            $lines,
                            set_value('line_id'),
                            lang('lbl_line')
                        );
                        ?>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <?php
                            echo lang('lbl_direction', 'direction') . '<br>';
                            echo form_label(form_radio('direction', 1, TRUE) . ' Ida ') . '&nbsp;';
                            echo form_label(form_radio('direction', 2) . ' Vuelta ');
                            ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <?php
                        echo co_form_dropdown(
                            array(
                                'name' => 'status',
                                'class' => 'form-control',
                                'required' => 'required'
                            ),
                            array('T' => lang('active'), 'F' => lang('inactive')),
                            set_value('status'),
                            lang('status')
                        );
                        ?>
                    </div>
                    <div class="col-md-2">
                        <?php
                        echo co_form_input(
                            array(
                                'name' => 'length',
                                'class' => 'form-control'
                            ),
                            set_value('length'),
                            lang('lbl_length')
                        );
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <?php echo lang('locations') ?>
                            </legend>
                            <?php if (isset($cities) && count($cities) > 0): ?>
                                <p>
                                    <?php echo lang('info_field_lenth'); ?>
                                </p>
                                <table class="table table-condensed location-list" id="location_list">
                                    <tr>
                                        <th style="width: 15%">ORDEN</th>
                                        <th style="width: 65%">LOCALIDAD</th>
                                        <th style="width: 15%">DISTANCIA (km)</th>
                                        <th></th>
                                    </tr>
                                    <tr class="location-row" data-index="<?php echo $index; ?>">
                                        <td class="title-<?php echo $index; ?>">
                                            <?php echo lang('lbl_location') . ' 1 '; ?>
                                        </td>
                                        <td>
                                            <?php echo form_dropdown('city_id_' . $index, $cities, '', array('class' => 'form-control')) ?>
                                        </td>
                                        <td>
                                            <?php echo form_input(array('name' => 'length_' . $index, 'type' => 'number', 'class' => 'form-control', 'step' => '0.1')); ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                <input type="button" value="Agregar +" class="btn btn-default add-location" />
                            <?php endif ?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer text-center">
        <?php echo form_submit('save', lang('create'), 'class="btn btn-primary"');
        echo anchor('routes', lang('cancel'), array('class' => 'btn btn-warning'))
            ?>
    </div>
    <?= form_close(); ?>
</div>
<script type="text/javascript">
    var myLabel = myLabel || {};
    myLabel.number_of_cities = <?php echo count($cities); ?>;
    myLabel.location = "Ubicación ";
</script>