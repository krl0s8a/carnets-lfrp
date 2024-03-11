<div class="form-group">
    <?php
    if (is_array($doc) && !empty($doc)) {
        echo '<div class="alert alert-info">Al lado de cada documentación establecer la fecha de vencimiento</div>';
        echo '<ul style="list-style:none;">';
        foreach ($doc as $k => $v) {
            $s = false;
            if (is_array($employee_doc)) {
                $s = array_key_exists($k, $employee_doc);
            }
            ?>
            <li>
                <label>
                    <input type="checkbox" <?php echo $s ? 'checked="checked"' : ''; ?> name="doc_id[<?php echo $k ?>]">
                    <?php echo $v . ' | Vencimieto: '; ?>
                </label>
                <input type="text" class="no-border date"
                    value="<?php echo ($s && $employee_doc[$k] != '0000-00-00') ? formatDate($employee_doc[$k], 'Y-m-d', 'd/m/Y') : ''; ?>"
                    name="due_date[<?php echo $k; ?>]" size="5%" placeholder="dd/mm/aaaa">

                <?php if (isset($employee_doc[$k]) && ($employee_doc[$k] != '0000-00-00') && ($employee_doc[$k]) < date('Y-m-d')): ?>
                    <span class="label label-danger">Vencido</span>
                <?php else: ?>
                    <?php if (isset($employee_doc[$k]) && $employee_doc[$k] != null): ?>
                        <span class="label label-success">Vigente</span>
                    <?php endif ?>
                <?php endif; ?>
            </li>

            <?php
        }
        echo '</ul>';
    } else {
        echo '<p>No se encuentran documentaciones registradas en el sistema, contáctese con el administrador.</p>';
    }
    echo form_button(
        array(
            'type'  => 'submit',
            'name'  => 'update_doc',
            'class' => 'btn btn-primary'
        ),
        '<i class="fa fa-save"></i> ' . lang('save')
    );
    echo anchor(site_url('employees'), lang('cancel'), array('class' => 'btn btn-link'));
    ?>
</div>