<table class="table table-condensed">
	<tr>
		<th>Apellido y Nombre</th>
		<th>DNI</th>
		<th>Tipo jugador</th>
		<th>Carnet</th>
		<th></th>
	</tr>
	<?php foreach ($players as $p): ?>
	<tr>
		<td><?= $p->last_name.' '.$p->first_name ?></td>
		<td><?= $p->dni ?></td>
		<td><?php echo isset($p->type_player) ? $type_player[$p->type_player] : '' ?></td>
		<td><?= $p->number ?></td>
		<td>
			<a class='btn btn-danger po-delete-user' id='a__$1' href='<?php echo site_url('teams/delete_by_team') ?>'>Quitar</a>
		</td>
	</tr>
	<?php endforeach ?>
</table>