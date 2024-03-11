<div class="box">
	<div class="box-header">
		<h2 class="blue"><i class="fa fa-edit"></i>
			<?php echo lang('edit_tariff') ?>
		</h2>
	</div>
	<?php
	$attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmUpdateTariff'];
	echo form_open($this->uri->uri_string(), $attrib);
	echo form_hidden('route_id', isset($tariff) ? $tariff->route_id : '');
	?>
	<div class="box-content">
		<div class="row">
			<div class="col-md-3">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						<?php echo lang('lgd_general') ?>
					</legend>
					<div class="form-group">
						<?php
						echo lang('lbl_name', 'name');
						echo form_input(
							array(
								'name' => 'name',
								'class' => 'form-control required',
								'required' => 'required',
								'value' => isset($tariff) ? $tariff->name : ''
							)
						);
						?>
					</div>
					<div class="form-group">
						<?php
						echo lang('lbl_start_date', 'start_date');
						echo form_input(
							array(
								'name' => 'start_date',
								'class' => 'form-control date',
								'value' => isset($tariff) ? formatDate($tariff->start_date, 'Y-m-d', 'd/m/Y') : ''
							)
						);
						?>
					</div>
					<div class="form-group">
						<?php
						echo lang('lbl_end_date', 'end_date');
						echo form_input(
							array(
								'name' => 'end_date',
								'class' => 'form-control date',
								'value' => isset($tariff) ? formatDate($tariff->end_date, 'Y-m-d', 'd/m/Y') : ''
							)
						)
							?>
					</div>
					<div class="form-group">
						<?php
						echo lang('status', 'status');
						echo form_dropdown('status', array('T' => lang('active'), 'F' => lang('inactive')), isset($tariff) ? $tariff->status : '', array('class' => 'form-control', 'id' => 'status'));
						?>
					</div>
				</fieldset>
			</div>
			<div class="col-md-9">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						<?php echo lang('lgd_grid') ?>
					</legend>
					<div id="grid_price">
						<?php
						if (isset($arr) && !empty($arr)) {
							foreach ($arr as $k => $v) {
								Template::block('gridPrice' . $k, 'tariffs/grid_price', $v);
							}
						}
						?>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<?php echo form_submit('save', $this->lang->line('update'), 'class="btn btn-primary"');
		echo anchor('tariffs', lang('cancel'), array('class' => 'btn btn-cancel'));
		?>
	</div>
	<?php echo form_close(); ?>
</div>