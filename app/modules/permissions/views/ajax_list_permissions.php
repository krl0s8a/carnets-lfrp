<?php
$num_columns = 5;
if (isset($results) && is_array($results) && count($results)) :
    echo form_open($this->uri->uri_string());
    ?>
    <?php foreach ($results as $record) : ?>
        <tr>
            <td class="column-check" style="text-align: center; width: 5%;">
                <input type="checkbox" name="checked[]" id="check-<?php echo $record->permission_id; ?>" class="flat" value="<?php echo $record->permission_id; ?>" />
                <label for="check-<?php echo $record->permission_id; ?>"></label>
            </td>
            <td><?php echo $record->permission_id; ?></td>
            <td><a href='<?php echo site_url(SITE_AREA . "/permissions/edit/{$record->permission_id}"); ?>'><?php e($record->name); ?></a></td>
            <td><?php e($record->description); ?></td>
            <td><?php echo (ucfirst(lang('co_' . $record->status))); ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="<?php echo $num_columns; ?>">
            <?php
            $actions = array(
                '' => 'Seleccione una acción',
                'd' => 'Eliminar seleccionado/s'
            );
            echo form_dropdown('actions', $actions, set_value('actions'), array('id' => 'actions', 'class' => ''));
            ?> 

            <span class="pull-right">
                <span>
                    Mostrando <?php echo count($results); ?> de un total de <?php echo $total_rows; ?> registros.          
                </span>
                <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                    <ul class="pagination" style="margin-top: 2px;margin-bottom: 1px;">
                        <?php if ($selected_link > 1): ?>
                            <li><a href='1'>&laquo;</a></li>
                            <li><a href="<?php echo $selected_link; ?>">&lsaquo;</a></li>
                        <?php else: ?>
                            <li class='previous disabled'><a href='#'>&laquo;</a></li>
                            <li class='previous disabled'><a href='#'>&lsaquo;</a></li>
                            <?php endif; ?>
                            <?php
                            // cantidad de link hacia atras y adelante
                            $cant = 3;
                            // inicio de donde se va a mostrar los links
                            $pagInicio = ($selected_link > $cant) ? ($selected_link - $cant) : 1;
                            //condicion en la cual establecemos el fin de los links
                            $numerolinks = $total_rows / $limit;
                            if ($numerolinks > $cant) {
                                //conocer los links que hay entre el seleccionado y el final
                                $pagRestantes = $numerolinks - $selected_link;
                                // defino el fin de los links
                                $pagFin = ($pagRestantes > $cant) ? ($selected_link + $cant) : $numerolinks;
                            } else {
                                $pagFin = $numerolinks;
                            }
                            for ($i = $pagInicio; $i <= $pagFin; $i++) {
                                if ($i == $selected_link)
                                    echo "<li class='active'><a href='javascript:void(0)'>" . $i . "</a></li>";
                                else
                                    echo "<li><a href='" . $i . "'>" . $i . "</a></li>";
                            }
                            // condicion para mostrar el boton sigueinte y ultimo
                            if ($selected_link < $numerolinks) {
                                echo "<li><a href='" . ($selected_link + 1) . "' >&rsaquo;</a></li>";
                                echo "<li><a href='" . $numerolinks . "'>&raquo;</a></li>";
                            } else {
                                echo "<li class='disabled'><a href='#'>&rsaquo;</a></li>";
                                echo "<li class='disabled'><a href='#'>&raquo;</a></li>";
                            }
                            ?>
                    </ul>
                </div>
            </span>
        </td>
    </tr>
    <?php
    echo form_close();
else :
    ?>
    <tr>
        <td colspan='<?php echo $num_columns; ?>'><?php echo lang('perm_no_records'); ?></td>
    </tr>
<?php
endif;
?>