<div class="row">
	<div class="col-lg-12" style="max-width: 1010px;">	
		<input type="hidden" name="tramos[]" value="<?php echo $route->id; ?>">
		<?php $sentido = ($route->direction == 1) ? ' (Ida)':' (Vuelta)'; ?>	
		<label>Recorrido: <?php echo $route->name.$sentido; ?></label>
		<div class="pj-location-grid">
			<?php
			$col_width = 85;
			$number_of_locations = count($location_arr); 
			if($number_of_locations > 0){
				?>
				<div class="pj-first-column">
					<table cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr class="title-head-row">
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($location_arr as $k => $v){
								if($k <= ($number_of_locations - 2)){
									?>
									<tr class="title-row" lang="<?php echo $v->city_id; ?>">
										<td><?php echo $v->name?></td>
									</tr>
									<?php
								}
							} 
							?>
						</tbody>
					</table>
				</div>
				<div class="pj-location-column">
					<div class="wrapper1">
				    	<div class="div1-compare" style="width: <?php echo $col_width * $number_of_locations; ?>px;"></div>
					</div>
					<div class="wrapper2">
						<div class="div2-compare" style="width: <?php echo $col_width * $number_of_locations; ?>px;">
							<table cellpadding="0" cellspacing="0" border="0" class="display" id="compare_table" width="<?php echo $col_width * $number_of_locations; ?>px">
			    				<thead>
									<tr class="content-head-row">
										<?php
										$j = 1;
										foreach($location_arr as $v){
											if($j > 1){
												?>
												<th class="<?php echo $j == 2 ? 'first-col' : null;?>" width="<?php echo $col_width;?>px">
													<?php echo $v->name; ?>
												</th>
												<?php
											}
											$j++;
										} 
										?>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach($location_arr as $k => $row){
									if($k <= ($number_of_locations - 2)){
										?>
										<tr class="content_row_<?php echo $row->city_id; ?>">
											<?php
											$j = 1;
											foreach($location_arr as $col){
												if($j > 1){
													$pair_id = $row->city_id . '_' . $col->city_id;
													?>
													<td class="<?php echo $j == 2 ? 'first-col' : null;?>" >
														<?php
														if($col->order > $row->order){ 
															echo '<div class="input-group">';
															echo form_input(array(
																'class' => 'form-control input-sm',
																'name' => 'price_'.$pair_id.'_'.$route->id,
																'value' => isset($price_arr[$pair_id]) ? $price_arr[$pair_id] : ''
															));
															echo '<span class="input-group-addon">$</span>';											
														}else{
															echo '&nbsp;';
														} 
														?>
													</td>
													<?php
												}
												$j++;
											} 
											?>
										</tr>
										<?php
									}
								} 
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<?php
			} 
			?>
		</div>
	</div>
</div>