<table class="table table-condensed">
	<tr>
		<th><?php echo lang('lbl_full_name') ?></th>
		<th><?php echo lang('lbl_dni') ?></th>
		<th><?php echo lang('lbl_type_player') ?></th>
		<th><?php echo lang('lbl_number') ?></th>
		<th></th>
	</tr>
	<?php foreach ($players as $p): ?>
	<tr>
		<td><?= $p->last_name.' '.$p->first_name ?></td>
		<td><?= $p->dni ?></td>
		<td><?php echo isset($p->type_player) ? $type_player[$p->type_player] : '' ?></td>
		<td><?= $p->number ?></td>
		<td>
			<span title="Eliminar" class='btn-link delete-player-team' id="<?php echo $p->season_id.'-'.$p->team_id.'-'.$p->player_id ?>"><i class="fa fa-trash"></i></span>
				&nbsp;
			<a href="<?php echo site_url('teams/edit_player_of_team/'.$p->season_id.'/'.$p->team_id.'/'.$p->player_id) ?>" id="edit-player-team" class="external" data-toggle="modal"data-target="#myModal"><i class="fa fa-edit"></i></a>
		</td>
	</tr>
	<?php endforeach ?>
</table>