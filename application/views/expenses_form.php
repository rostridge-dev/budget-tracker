		<h2><?php echo $title; ?></h2>

		<form id="entries_form" action="<?php echo base_url($form_action)?>" method="post">

		<div class="row">
		
			<div class="col-md-6">
	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('date')){
									echo form_error('date');
								}
							?>
							<label class="required" for="date">Date</label>
							<input type="text" data-provide="datepicker" class="form-control datepicker" id="date" name="date" value="<?php echo set_value('date', ($entry->getDate()) ? $entry->getDate() : ''); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('time_of_day')){
									echo form_error('time_of_day');
								}
							?>
							<label class="required" for="time_of_day">Time of Day (HH:MM AM/PM)</label>
							<input type="text" class="form-control" id="time_of_day" name="time_of_day" value="<?php echo set_value('time_of_day', ($entry->getTimeOfDay()) ? $entry->getTimeOfDay() : ''); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">		
					<div class="col-md-12">
						<div class="form-group">
							<?php
								if(form_error('type_id')){
									echo form_error('type_id');
								}
							?>
							<label class="required" for="type_id">Run Type</label>
							<?php echo form_dropdown('type_id',$run_types,set_value('type_id',($entry->getTypeID()) ? $entry->getTypeID() : ''),'id="type_id" class="form-control"'); ?>
						</div>
					</div>			
				</div>
				
				<div class="row">		
					<div class="col-md-12">
						<div class="form-group">
							<?php
								if(form_error('route_id')){
									echo form_error('route_id');
								}
							?>
							<label class="required" for="route_id">Route</label>
							<?php echo form_dropdown('route_id',$routes,set_value('route_id',($entry->getRouteID()) ? $entry->getRouteID() : ''),'id="route_id" class="form-control"'); ?>
						</div>
					</div>			
				</div>
				
				<div class="row">		
					<div class="col-md-12">
						<div class="form-group">
							<?php
								if(form_error('shoe_id')){
									echo form_error('shoe_id');
								}
							?>
							<label class="required" for="shoe_id">Shoe</label>
							<?php echo form_dropdown('shoe_id',$shoes,set_value('shoe_id',($entry->getShoeID()) ? $entry->getShoeID() : ''),'id="shoe_id" class="form-control"'); ?>
						</div>
					</div>			
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('distance')){
									echo form_error('distance');
								}
							?>
							<label class="required" for="distance">Distance (km)</label>
							<input type="text" onchange="getPace()" class="form-control" id="distance" name="distance" value="<?php echo set_value('distance', ($entry->getDistance()) ? $entry->getDistance() : ''); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('time')){
									echo form_error('time');
								}
							?>
							<label class="required" for="time">Time (HH:MM:SS)</label>
							<input type="text" onchange="getPace()" class="form-control" id="time" name="time" value="<?php echo set_value('time', ($entry->getTime()) ? $entry->getTime() : ''); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="required" for="pace">Pace</label>
							<input disabled type="text" class="form-control" id="pace" name="pace" value="<?php echo $entry->getPace(); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('quality')){
									echo form_error('quality');
								}
							?>
							<label for="quality">Quality</label>
							<br class="clearfix">
		<?php
			for ($counter = 1; $counter <= 10; $counter++) {
				$checked = "";
				if ($counter == set_value('quality')) {
					$checked = " checked=\"checked\"";
				}
				if ($counter == $entry->getQuality()) {
					$checked = " checked=\"checked\"";
				}
		?>
							<div class="radio-inline">
								<label style="font-weight:normal;"><input type="radio" name="quality" value="<?php echo $counter; ?>"<?php echo $checked; ?>><?php echo $counter; ?></label>
							</div>
		<?php
			}
		?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('effort')){
									echo form_error('effort');
								}
							?>
							<label for="effort">Effort</label>
							<br class="clearfix">
		<?php
			for ($counter = 1; $counter <= 10; $counter++) {
				$checked = "";
				if ($counter == set_value('effort')) {
					$checked = " checked=\"checked\"";
				}
				if ($counter == $entry->getEffort()) {
					$checked = " checked=\"checked\"";
				}
		?>
							<div class="radio-inline">
								<label style="font-weight:normal;"><input type="radio" name="effort" value="<?php echo $counter; ?>"<?php echo $checked; ?>><?php echo $counter; ?></label>
							</div>
		<?php
			}
		?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('weather')){
									echo form_error('weather');
								}
							?>
							<label for="weather">Weather</label>
							<br class="clearfix">
		<?php
			$rows = 0;
			foreach ($weather_types as $weather_id => $weather) {
				$rows++;
				$selectedWeather = $entry->getWeatherIDSArray();
				$checked = "";
				if (set_value('weather[]') != 0) {
					if (in_array($weather_id,set_value('weather[]'))) {
						$checked = " checked=\"checked\"";
					}
				}
				if (array_key_exists($weather_id,$selectedWeather)) {
					$checked = " checked=\"checked\"";
				}
				if ($rows == 4) {
					echo "<br class=\"clearfix\">\n";
				}
		?>
							<div class="checkbox-inline">
								<label style="font-weight:normal;"><input type="checkbox" name="weather[]" value="<?php echo $weather_id; ?>"<?php echo $checked; ?>><?php echo $weather; ?></label>
							</div>
		<?php
			}
		?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('temperature')){
									echo form_error('temperature');
								}
							?>
							<label for="temperature">Temperature (C)</label>
							<input type="text" class="form-control" id="temperature" name="temperature" value="<?php echo set_value('temperature', ($entry->getTemperature()) ? $entry->getTemperature() : ''); ?>">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('notes')){
									echo form_error('notes');
								}
							?>
							<label for="notes">Notes</label>
							<textarea class="form-control" id="notes" name="notes" rows="3"><?php echo set_value('notes', ($entry->getNotes()) ? $entry->getNotes() : ''); ?></textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="action" value="submit">						
						<input type="hidden" id="is_race" name="is_race" value="<?php echo set_value('is_race', ($entry->getIsRace()) ? $entry->getIsRace() : '0'); ?>">
						<button type="submit" class="btn btn-default">Submit</button>
					</div>
				</div>
				
			</div>
			
			<div class="col-md-6">
			
				<div class="row">
					<div class="col-md-12">

						<div id="race-data" class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Race Information</h3>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<?php 
												if(form_error('placement')){
													echo form_error('placement');
												}
											?>
											<label class="required" for="placement">Overall Position</label>
											<input type="text" onchange="getPercentage()" class="form-control" id="placement" name="placement" value="<?php echo set_value('placement', ($entry->getPlacement()) ? $entry->getPlacement() : ''); ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<?php 
												if(form_error('field')){
													echo form_error('field');
												}
											?>
											<label class="required" for="field">Size of Field</label>
											<input type="text" onchange="getPercentage()" class="form-control" id="field" name="field" value="<?php echo set_value('field', ($entry->getField()) ? $entry->getField() : ''); ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="required" for="percentage">Field Placement</label>
											<input disabled type="text" class="form-control" id="percentage" name="percentage" value="<?php echo $entry->getPercentage(); ?>">
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<?php 
												if(form_error('group_min_age')){
													echo form_error('group_min_age');
												}
											?>
											<label for="group_min_age">Age Group Min</label>
											<input type="text" class="form-control" id="group_min_age" name="group_min_age" value="<?php echo set_value('group_min_age', ($entry->getGroupMinAge()) ? $entry->getGroupMinAge() : ''); ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<?php 
												if(form_error('group_max_age')){
													echo form_error('group_max_age');
												}
											?>
											<label for="group_max_age">Age Group Max</label>
											<input type="text" class="form-control" id="group_max_age" name="group_max_age" value="<?php echo set_value('group_max_age', ($entry->getGroupMaxAge()) ? $entry->getGroupMaxAge() : ''); ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<?php 
												if(form_error('group_age_placement')){
													echo form_error('group_age_placement');
												}
											?>
											<label for="group_age_placement">Age Group Position</label>
											<input type="text" class="form-control" id="group_age_placement" name="group_age_placement" value="<?php echo set_value('group_age_placement', ($entry->getGroupAgePlacement()) ? $entry->getGroupAgePlacement() : ''); ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<?php 
												if(form_error('group_age_size')){
													echo form_error('group_age_size');
												}
											?>
											<label for="group_age_size">Age Group Size</label>
											<input type="text" class="form-control" id="group_age_size" name="group_age_size" value="<?php echo set_value('group_age_size', ($entry->getGroupAgeSize()) ? $entry->getGroupAgeSize() : ''); ?>">
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<?php 
												if(form_error('group_gender_placement')){
													echo form_error('group_gender_placement');
												}
											?>
											<label for="group_gender_placement">Gender Group Position</label>
											<input type="text" class="form-control" id="group_gender_placement" name="group_gender_placement" value="<?php echo set_value('group_gender_placement', ($entry->getGroupGenderPlacement()) ? $entry->getGroupGenderPlacement() : ''); ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<?php 
												if(form_error('group_gender_size')){
													echo form_error('group_gender_size');
												}
											?>
											<label for="group_gender_size">Gender Group Size</label>
											<input type="text" class="form-control" id="group_gender_size" name="group_gender_size" value="<?php echo set_value('group_gender_size', ($entry->getGroupGenderSize()) ? $entry->getGroupGenderSize() : ''); ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			
		</div>
		
		</form>