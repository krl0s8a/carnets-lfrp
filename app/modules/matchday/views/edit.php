<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i> General </h2>
    </div>
    <?php echo form_open('matchday/actions', array('id' => 'action-form')); ?>
    <div class="box-content">
        <div class="row">
            <div class="col-md-3">
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
                            <th>#</th>
                            <th style="text-align:right;">Equipo local</th>
                            <th>Resultado</th>
                            <th style="text-align:left;">Equipo visitante</th>
                            <th style="text-align:left;">Estado</th>
                            <th style="text-align:left;">Fecha</th>
                            <th style="text-align:left;">Hora</th>
                            <th style="text-align:left;">Cancha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($matches as $match): ?>
                        <?php if ($match->team1_id > 0 && $match->team2_id > 0): ?>
                         <tr>
                            <td><?= $i++; ?></td>
                            <td style="text-align:right;">
                                <?php 
                                if ($match->team1_id > 0) {
                                    echo anchor(site_url('matchday/players_by_team/'.$match->team1_id.'/'.$match->m_id), $match->team1, array('data-toggle' => 'modal','data-target' => '#myModal','title' => 'Lista de jugadores')); 
                                } else {
                                    echo '---';
                                }                                
                                ?>                                    
                            </td>
                            <td style="text-align:center;">
                                <?php 
                                if ($match->m_played == 0) {
                                    echo '---';
                                } else {
                                    echo $match->score1.' - '.$match->score2;
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                if ($match->team2_id > 0) {
                                    echo anchor(site_url('matchday/players_by_team/'.$match->team2_id.'/'.$match->m_id), $match->team2, array('data-toggle' => 'modal','data-target' => '#myModal','title' => 'Lista de jugadores')); 
                                } else {
                                    echo '---';
                                }                                
                                ?>      
                            </td>
                            <td>
                                <?php echo ($match->m_played == 0) ? 'Calendario' : 'Jugado'; ?>
                            </td>
                            <td><?= formatDate($match->m_date,'Y-m-d','d/m/Y') ?></td>
                            <td><?= $match->m_time ?></td>
                            <td><?= $match->v_name ?></td>
                            <td style="text-align: center;">
                                <a href="<?php echo site_url('matchday/print_game_sheet/'.$match->id) ?>" title="Imprimir planilla de juego"><i class="fa fa-print"></i></a>
                            </td>
                        </tr>      
                        <?php endif ?>                         
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
        echo form_button(
            array(
                'name' => 'save',
                'type' => 'submit',
                'class' => 'btn btn-primary'
            ),
            '<i class="fa fa-save"></i> '.lang('save')
        );

        echo form_button(
            array(
                'name' => 'saveandclose',
                'type' => 'submit',
                'class' => 'btn btn-default'
            ),
            '<i class="fa fa-save"></i> '.lang('saveandclose')
        );
        
        echo anchor('matchday', '<i class="fa fa-close"></i> '.lang('close'), array('class' => 'btn btn-default')); 
        ?>
    </div>
    <?php echo form_close(); ?>
</div>