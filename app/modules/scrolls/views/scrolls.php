<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">Los siguientes rollos de boletos se cargan en el sistema para ser usados.</div>
            <div class="panel-body" style="padding: 5px;">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nro Serie</th>
                            <th>Nro boleto Desde</th>
                            <th>Nro boleto Hasta</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>                
                    <tbody>
                        <?php 
                        $i = 1;
                        while ($rollos > 0) {                               
                            ?>
                            <tr>
                                <td>Rollo <?php echo $i++; ?></td>
                                <td>
                                    <input type="text" class="form-control no-border" value="<?php echo $serie; ?>" style="text-align: center;" name="serial[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control no-border" value="<?php echo complete_digits($inicial,5); ?>" style="text-align: center;" name="ffrom[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control no-border" value="<?php echo complete_digits($inicial + $boletos - 1,5); ?>" style="text-align: center;" name="tto[]">
                                </td>  
                                <td>
                                    <input type="text" class="form-control no-border" value="<?php echo $boletos; ?>" style="text-align: center;" name="quantity[]">
                                </td>        
                            </tr>
                            <?php
                            $inicial = $inicial + $boletos; 
                            $rollos--;
                        }                        
                        ?>                    
                    </tbody>
                </table>
            </div>
        </div>                        
    </div>
</div>              
<div class="form-group">
    <?php echo form_submit('save', $this->lang->line('btn_create'), 'class="btn btn-primary"'); ?>
</div> 