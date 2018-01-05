		<h3><?php echo $title; ?></h3>

		<form id="entries_form" action="<?php echo base_url($form_action)?>" method="post">

		<div class="row">
		
			<div class="col-md-12">
			
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
								if(form_error('category_id')){
									echo form_error('category_id');
								}
							?>
							<label class="required" for="category_id">Category</label>
							<?php echo form_dropdown('category_id',$categories,set_value('category_id',($entry->getCategoryID()) ? $entry->getCategoryID() : ''),'id="category_id" class="form-control"'); ?>
						</div>
					</div>			
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php 
								if(form_error('amount')){
									echo form_error('amount');
								}
							?>
							<label class="required" for="amount">Amount</label>
							<input type="text" class="form-control" id="amount" name="amount" value="<?php echo set_value('amount', ($entry->getAmount()) ? $entry->getAmount() : ''); ?>">
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
						<button type="submit" class="btn btn-default">Submit</button>
					</div>
				</div>
				
			</div>

			
		</div>
		
		</form>