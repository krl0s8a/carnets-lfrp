<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('create_scroll'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">La cantidad de Boletos por rollo esta establecida segun el tipo de boleto seleccionado.</p>
                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form','id' => 'frmLoad'];
                echo form_open($this->uri->uri_string(), $attrib)
                ?>
                <div class="row">   
                    <!-- Tipo boleto -->
                    <div class="col-md-3">  
                        <?php 
                        echo co_form_dropdown(
                            array(
                                'name' => 'ticket_id',
                                'class' => 'form-control',
                                'id' => 'ticket_id'
                            ),
                            $type_tickets,
                            '',
                            lang('field_ticket_type')
                        );
                        ?>
                    </div>
                    <!-- Cantidad de boletos por rollo -->
                    <div class="col-md-2"> 
                        <?php 
                        echo co_form_number(
                            array(
                                'name' => 'tickets_scroll',
                                'id' => 'tickets_scroll',
                                'class' => 'form-control',
                                'min' => 1,
                                'readonly' => 'readonly'
                            ),
                            set_value('tickets_scroll',isset($ticket) ? $ticket->quantity : 1000),
                            lang('field_tickets_scroll')
                        );
                        ?>
                    </div>
                    <!-- Nro serie -->
                    <div class="col-md-2">
                        <?php 
                        echo co_form_number(
                            array(
                                'name' => 'serial_prev',
                                'id' => 'serial',
                                'class' => 'form-control'
                            ),
                            set_value('serial'),
                            lang('field_serial')
                        );
                        ?>
                    </div>
                    <!-- Nro de boleto -->                
                    <div class="col-md-2">  
                        <?php 
                        echo co_form_number(
                            array(
                                'name' => 'ticket_prev',
                                'id' => 'ticket',
                                'class' => 'form-control',
                                'value' => 1,
                                'min' => 1
                            ),
                            set_value('ticket'),
                            lang('field_ticket')
                        );
                        ?> 
                    </div>
                    <!-- Cantidad de rollos -->
                    <div class="col-md-2">  
                        <?php 
                        echo co_form_number(
                            array(
                                'name' => 'quantity_prev',
                                'class' => 'form-control',
                                'min' => 1 
                            ),
                            set_value('quantity',100),
                            lang('field_quantity_scrolls')
                        );
                        ?>
                    </div>
                    
                    <div class="col-md-1">
                        <div class="form-group">
                            <button id="prev" class="btn btn-success" style="margin-top: 30px;" title="Continuar">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>                    
                </div>  
                <div id="scrolls"></div>                
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>