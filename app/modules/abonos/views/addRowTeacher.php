<tr>			
    <th>
        <?php echo form_checkbox('checkedd[]', 1, TRUE, array('class' => 'check')); ?>
    </th>	
    <th>
        <?php echo form_input(array('name' => 'number_abono[]', 'class' => 'form-control', 'min' => '1', 'value' => $number_abono)); ?>
    </th>
    <td>
        <?php echo form_dropdown('checked[]', $passengers, '', array('class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo form_dropdown('from[]', $cities, '', array('class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo form_dropdown('to[]', $cities, '', array('class' => 'form-control')); ?>
    </td>
    <td>
        <?php echo form_input(array('name' => 'ida[]', 'class' => 'form-control', 'type' => 'number', 'min' => '1', 'value' => '1')); ?>
    </td>
    <td>
        <?php echo form_input(array('name' => 'vta[]', 'class' => 'form-control', 'type' => 'number', 'min' => '1', 'value' => '1')); ?>
    </td>
    <td>
        <?php echo form_input(array('name' => 'discount[]', 'class' => 'form-control', 'type' => 'number', 'min' => '0', 'value' => '0')); ?>
    </td>	
    <td>
        <span class="btn btn-sm btn-danger del-row">
            <i class="fa fa-close"></i>
        </span>
    </td>	
</tr>