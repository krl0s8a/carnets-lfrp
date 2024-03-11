<tr class="location-row" data-index="{INDEX}">
    <td class="title-{INDEX}">
        <?php echo lang('lbl_location') . ' {ORDER} '; ?>
    </td>
    <td>
        <?php echo form_dropdown('city_id_{INDEX}', $cities, '', array('class' => 'form-control select2')) ?>
    </td>
    <td>
        <?php echo form_input(array('type' => 'number', 'step' => '0,1', 'name' => 'length_{INDEX}', 'class' => 'form-control')); ?>
    </td>
    <td><span class="btn btn-danger location-delete">X</span></td>
</tr>