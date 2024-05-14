<div class="modal-dialog modal-md">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-list"></i> <?= $team->t_name ?>: Lista de jugadores</h4>
		</div>
		<?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'] ?>
        <?php echo form_open('#', $attrib); 
        ?>
		<div class="modal-body">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th style="text-align:left;">Apellido y Nombre</th>
						<th style="text-align:left;">Tipo de jugador</th>
						<th>Carnet</th>
					</tr>
				</thead>				
				<?php if (isset($players) && is_array($players) && !empty($players)): ?>
				<tbody>
					<?php $i=1; foreach ($players as $p): ?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $p->last_name.', '.$p->first_name ?></td>
						<td><?= $type_player[$p->type_player] ?></td>
						<td style="text-align:center;"><?= $p->number ?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
				<?php else: ?>			
				<tfoot>
					<tr><td colspan="4">Sin jugadores agregados</td></tr>
				</tfoot>
				<?php endif ?>				
			</table>
		</div>
		<div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                <?= lang('close') ?>
            </button>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>