		<h2><?php echo $title; ?></h2>

		<form id="profile_form" action="<?php echo base_url($form_action)?>" method="post">
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php 
						if(form_error('username')){
							echo form_error('username');
						}
					?>
					<label class="required" for="username">Email</label>
					<input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', ($user->getUsername()) ? $user->getUsername() : ''); ?>">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php 
						if(form_error('firstname')){
							echo form_error('firstname');
						}
					?>
					<label class="required" for="firstname">First Name</label>
					<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo set_value('firstname', ($user->getFirstname()) ? $user->getFirstname() : ''); ?>">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php 
						if(form_error('lastname')){
							echo form_error('lastname');
						}
					?>
					<label class="required" for="lastname">Last Name</label>
					<input type="text" class="form-control" id="firstname" name="lastname" value="<?php echo set_value('lastname', ($user->getLastname()) ? $user->getLastname() : ''); ?>">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php 
						if(form_error('password')){
							echo form_error('password');
						}
					?>
					<label for="password">New Password</label>
					<input type="password" class="form-control" id="password" name="password" value="">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="action" value="submit">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
		</form>