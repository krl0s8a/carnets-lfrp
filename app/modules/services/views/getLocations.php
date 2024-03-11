<?php
if(count($location_arr) > 0){
	// $time_format = $tpl['option_arr']['o_time_format'];
	// if((strpos($tpl['option_arr']['o_time_format'], 'a') > -1 || strpos($tpl['option_arr']['o_time_format'], 'A') > -1)){
	$time_format = "H:i";
	// }
	// $week_start = isset($tpl['option_arr']['o_week_start']) && in_array((int) $tpl['option_arr']['o_week_start'], range(0,6)) ? (int) $tpl['option_arr']['o_week_start'] : 0;
	// $jqDateFormat = pjUtil::jqDateFormat($tpl['option_arr']['o_date_format']);
	// $jqTimeFormat = pjUtil::jqTimeFormat($tpl['option_arr']['o_time_format']);
	$jqTimeFormat = 'HH:mm';
	$jqDateFormat = 'dd/mm/yy';
	
	echo '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed">';
		echo '<thead>';		
			echo '<tr>';
				echo '<td style="width:5%">#</td>';
				echo '<td style="width:55%">Localidad</td>';
				echo '<td style="width:20%">Hora llegada</td>';
				echo '<td style="width:20%">Hora partida</td>';
			echo '</tr>';
		echo '<thead>';
		$i = 1;
		echo '<tbody>';
		foreach($location_arr as $k => $v){
			$arrival_hour = $arrival_minute = null;
			$departure_hour = $departure_minute = null;
			$arrival_time = null;
			$departure_time = null;

			if (isset($sl_arr)) {
				if (isset($sl_arr[$v->city_id])) {
					if (!empty($sl_arr[$v->city_id]->departure_time) && ($sl_arr[$v->city_id]->departure_time != '00:00:00')) {
						list($departure_hour, $departure_minute,) = explode(":", $sl_arr[$v->city_id]->departure_time);
						$departure_time = date($time_format, strtotime(date('Y-m-d'). ' '. $sl_arr[$v->city_id]->departure_time));
					}
					if(!empty($sl_arr[$v->city_id]->arrival_time) && ($sl_arr[$v->city_id]->arrival_time != '00:00:00')){
			 			list($arrival_hour, $arrival_minute,) = explode(":", $sl_arr[$v->city_id]->arrival_time);
			 			$arrival_time = date($time_format, strtotime(date('Y-m-d'). ' '. $sl_arr[$v->city_id]->arrival_time));
			 		}
				}
			}
			?>			
			
			<?php
			echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td><label class="title">'.$v->city_name.'</label></td>';		
				if ($i == 1) {
					echo '<td></td>';
				}		
				if ($k > 0) {
					echo '<td>';
						echo form_input(array(
							'type' => 'time',
							'name' => 'arrival_time_'.$v->city_id,
							'value' => $arrival_time,
							'data-date-format' => 'hh:ii',
							'class' => 'form-control',
							'style' => 'text-align:center',
							'placeholder' => 'hh:mm'
						));
					echo '</td>';
				}
				if ($k < count($location_arr) - 1) {
					echo '<td>';
						echo form_input(array(
							'type' => 'time',
							'name' => 'departure_time_'.$v->city_id,
							'value' => $departure_time,
							'data-date-format' => 'hh:ii',
							'class' => 'form-control',
							'style' => 'text-align:center',
							'placeholder' => 'hh:mm'
						));
					echo '</td>';
				}								
				
			echo '</tr>';
			$i++;
		}
		echo '</tbody>';
	echo '</table>';
}
?>