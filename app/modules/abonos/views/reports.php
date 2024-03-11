<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-reports"></i><?= lang('reports'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-md-12">
                <p class="introtext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores beatae assumenda rem sint doloribus ab dignissimos, temporibus! Itaque dolore a esse at ea! At quos, ex inventore recusandae itaque sapiente.</p>				
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-inline')); ?>
                <div class="form-group">
                    <?php
                    echo form_label(lang('lbl_month'), 'month');
                    echo form_dropdown('month', months(), date('m'), array('class' => 'form-control'));
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('lbl_year'), 'year');
                    echo form_dropdown('year', years(), date('Y'), array('class' => 'form-control'));
                    ?>
                </div>
                <button type="submit" name="generate" class="btn btn-primary"><?= lang('btn_report') ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
        <?php if (isset($records) && !empty($records) && is_array($records)): ?>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Institución</th>
                                <th>Localidad</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($record as $r): ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>	
                            <?php endforeach ?>						
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>				
            </div>	
        <?php endif ?>				
    </div>
</div>					