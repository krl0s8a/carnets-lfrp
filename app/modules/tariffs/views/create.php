<div class="box">
	<div class="box-header">
		<h2 class="blue"><i class="fa fa-plus"></i>
			<?php echo lang('create_tariff') ?>
		</h2>
	</div>
	<?php
	$attrib = ['data-toggle' => 'validator', 'role' => 'form'];
	echo form_open($this->uri->uri_string(), $attrib);
	?>
	<div class="box-content">
		<div class="row">
			<div class="col-md-3">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						<?php echo lang('lgd_general') ?>
					</legend>
					<div class="form-group all">
						<?php echo lang('lbl_line', 'line_id'); ?>
						<select name="line_id" id="line_id" class="form-control select" required="required"
							style="width:100%">
							<option value="">--Seleccione la linea--</option>
							<?php if (isset($lines) && is_array($lines)): ?>
								<?php foreach ($lines as $line): ?>
									<option value="<?= $line->id ?>">
										<?php echo "[$line->id] " . $line->name; ?>
									</option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
					</div>
					<div class="form-group">
						<?php
						echo lang('lbl_name', 'name');
						echo form_input(
							array(
								'name' => 'name',
								'class' => 'form-control required',
								'required' => 'required'
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
								'value' => date('d/m/Y')
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
								'class' => 'form-control date'
							)
						)
							?>
					</div>
					<div class="form-group">
						<label for="idavuelta">
							<input type="checkbox" name="idavuelta" checked="checked" value="1"> Aplicar precio de
							ida a
							precio de vuelta. Solo completar valores del recorrido de ida.
						</label>
					</div>
				</fieldset>
			</div>
			<div class="col-md-9">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						<?php echo lang('lgd_grid') ?>
					</legend>
					<div id="grid_price" style="width: 100%">Seleccione una linea para establecer precios</div>
				</fieldset>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<?php
		echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"');
		echo anchor('tariffs', lang('cancel'), array('class' => 'btn btn-link'))
			?>
	</div>
	<?php echo form_close(); ?>
</div>