<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i> General </h2>
    </div>
    <?php echo form_open('matchday/actions', array('id' => 'action-form')); ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-4">
                <?php
                echo co_form_input(
                    array(
                        'name' => 'm_name',
                        'id' => 'm_name',
                        'class' => 'form-control required'
                    ),
                    set_value('m_name', $matchday->m_name),
                    'Nombre de la jornada'
                );  
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Equipo local</th>
                            <th style="text-align:left;">Equipo visitante</th>
                            <th style="text-align:left;">Fecha</th>
                            <th style="text-align:left;">Hora</th>
                            <th style="text-align:left;">Cancha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($matches as $match): ?>
                         <tr>
                            <td><?= $match->team1 ?></td>
                            <td><?= $match->team2 ?></td>
                            <td><?= formatDate($match->m_date,'Y-m-d','d/m/Y') ?></td>
                            <td><?= $match->m_time ?></td>
                            <td><?= $match->v_name ?></td>
                            <td style="text-align: center;">
                                <a href="<?php echo site_url('matchday/print_game_sheet/'.$match->id) ?>" title="Imprimir planilla de juego"><i class="fa fa-print"></i></a>
                                <a href="#" title="Plantilla equipo local"><i class="fa fa-users"></i></a>
                                <a href="#" title="Plantilla equipo visitante"><i class="fa fa-users"></i></a>
                            </td>
                        </tr>   
                        <?php endforeach ?>                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>
    <div class="box-footer">
        <?php
        echo anchor('matchday', 'Volver', array('class' => 'btn btn-link')); 
        ?>
    </div>
    <?php echo form_close(); ?>
</div>