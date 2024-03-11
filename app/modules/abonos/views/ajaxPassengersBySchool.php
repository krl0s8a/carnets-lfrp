<?php if (isset($passengers) && !empty($passengers)): ?>
    <p>Si el docente no se encuentra en el listado agregarlo desde aqui <a href="<?= site_url('abonos/addTeacher'); ?>" data-toggle='modal' data-target='#myModal'><i class="fa fa-plus-circle"></i> Aqui</a> </p>
    <table id="PassTable" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 25%">Apellido y Nombre/s</th>
                <th style="width: 18%">Origen</th>
                <th style="width: 18%">Destino</th>
                <th style="width: 10%">Linea</th>
                <th style="width: 10%">Ida</th>
                <th style="width: 10%">Vuelta</th>
                <th style="width: 8%">Descuento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($passengers as $p): ?>
                <?php
                $disabled = is_object($p->exist) ? ' disabled="disabled"' : '';
                ?>
                <tr>			
                    <th>
                        <?php if (is_object($p->exist)): ?>
                            <input type="checkbox" name="update[<?php echo $p->id; ?>]" value="<?php echo $p->exist->id ?>" class="check checkbox">
                        <?php else: ?>
                            <input type="checkbox" name="checked[<?php echo $p->id; ?>]" value="<?php echo $p->id ?>" class="check checkbox" checked="checked">
                        <?php endif; ?>
                    </th>
                    <td>
                        <?php echo $p->last_name . ' ' . $p->first_name ?>
                        <input type="hidden" name="people_id[<?php echo $p->id ?>]" value="<?php echo $p->people_id; ?>">
                        <input type="hidden" name="name_flast[<?php echo $p->id; ?>]" value="<?php echo $p->last_name . ' ' . $p->first_name; ?>">		
                    </td>
                    <td>
                        <?php if ($p->from_default == ''): ?>
                            <?php echo anchor(site_url('abonos/assignTramo/' . $p->id . '/' . $school_id), 'Asignar', array('data-toggle' => 'modal', 'data-target' => '#myModal')); ?>
                        <?php else: ?>
                            <input type="hidden" name="from[<?php echo $p->id; ?>]" value="<?php echo $p->from_default ?>">
                            <input type="hidden" name="name_from[<?php echo $p->id; ?>]" value="<?php echo $p->name_from; ?>">
                            <?php echo $p->name_from; ?>
                        <?php endif; ?>					
                    </td>
                    <td>
                        <?php if ($p->to_default == ''): ?>
                            <a href="<?php echo site_url('abonos/assignTramo/' . $p->id . '/' . $school_id) ?>" data-toggle='modal' data-target='#myModal'>Asignar</a>	
                        <?php else: ?>
                            <input type="hidden" name="to[<?php echo $p->id; ?>]" value="<?php echo $p->to_default ?>">
                            <input type="hidden" name="name_to[<?php echo $p->id; ?>]" value="<?php echo $p->name_to; ?>">
                            <?php echo $p->name_to; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <select name="line[<?php echo $p->id; ?>]" class="form-control" <?php echo $disabled; ?>>
                            <?php foreach ($p->lines as $k => $v): ?>
                                <option value="<?php echo $k; ?>" <?php echo isset($p->exist->line_id) && ($p->exist->line_id == $k) ? 'selected="selected"' : ''; ?>>
                                    <?php echo $v; ?>								
                                </option>	
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="ida[<?php echo $p->id; ?>]" class="form-control" min="0" value="<?php echo isset($p->exist->ida) ? $p->exist->ida : 0; ?>" <?php echo $disabled ?>>
                    </td>
                    <td>
                        <input type="number" name="vta[<?php echo $p->id; ?>]" class="form-control" min="0" value="<?php echo isset($p->exist->vta) ? $p->exist->vta : 0; ?>" <?php echo $disabled ?>>
                    </td>
                    <td>
                        <input type="number" name="discount[<?php echo $p->id; ?>]" class="form-control" min="0" value="<?php echo isset($p->exist->discount) ? $p->exist->discount : 0; ?>" <?php echo $disabled; ?>>
                    </td>	
                    <td>
                        <?php
                        if (isset($p->exist->status)) {
                            switch ($p->exist->status) {
                                case '1':
                                    echo '<h3><span class="green"><i class="fa fa-check"></i></span></h3>';
                                    break;
                                case '2':
                                    echo '<h3><span class="yellow"><i class="fa fa-print"></i></span></h3>';
                                    break;
                                default:
                                    echo '<h3><span class="red"><i class="fa fa-close"></i></span></h3>';
                                    break;
                            }
                        } else {
                            ?>
                            <h3><span class="grey"><i class="fa fa-minus"></i></span></h3>
                            <?php
                        }
                        ?>

                    </td>
                </tr>
            <?php endforeach ?>	
        </tbody>
    </table>	
    <?php
    echo form_submit(array('class' => 'btn btn-primary','name' => 'save'), lang('save'));
    echo anchor('abonos',lang('cancel'), array('class' => 'btn btn-link'));
    ?>
<?php else: ?>
    <div class="alert alert-warning">
        No se registran docentes/alumnos en la escuela seleccionada.
    </div>
<?php endif; ?>

<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/bootstrapValidator.min.js') ?>"></script>