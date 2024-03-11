<?php echo '<tr>'; ?>
    <td><input class="check checkbox" type="checkbox" name="checked[]" checked="ckecked" value="<?php echo $st->id; ?>"></td>';
    <td><input type="text" name="number_abono[]" class="form-control"></td>';
    <td><input type="text" name="code[]" class="form-control"></td>';
    <td>
        <?php echo $st->last_name . ' ' . $st->first_name; ?>
        <input type="hidden" name="name_full[]" value="<?php echo $st->last_name . ' ' . $st->first_name; ?>">
    </td>';
    <td>
        <?php
        echo form_dropdown('from[]', $cities, $st->ffrom, array('class' => 'form-control from', 'id' => 'from_' . $st->id));
        ?>
    </td>';
    <td><?php echo form_dropdown('to[]', $cities, $st->tto, array('class' => 'form-control to', 'id' => 'to_' . $st->id)) ?></td>';
    <td><?php echo form_dropdown('line[]', $lines, '', array('class' => 'form-control line', 'id' => 'line_' . $st->id)) ?></td>';
    <td><input type="number" name="ida[]" min="0" value="0" class="form-control"></td>';
    <td><input type="number" name="vta[]" min="0" value="0" class="form-control"></td>';
    <td><input type="number" name="discount[]" min="0" value="0" class="form-control"></td>';
    <td><i class="fa fa-trash del-row"></i></td>';
<?php echo '</tr>'; ?>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/js/bootstrapValidator.min.js') ?>"></script>