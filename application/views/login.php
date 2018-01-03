<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Budget Tracker</title>

		<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap.spacelab.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap.budget-tracker.css" rel="stylesheet">

	</head>
	
	<body>
	
		<div class="container gutter-top">
		
			<div class="row">
				<div class="col-md-12 gutter-top">
				
					<h1>Budget Tracker</h1>
				
<?php
	if (isset($error)) {
		echo $error;
	}
?>
				
					<form action="<?php echo base_url(); ?>login/authenticate" method="post">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="email" class="form-control" id="username" name="username" placeholder="Enter username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						<button type="submit" class="btn btn-default">Login</button>
					</form>
					
				</div>
			</div>
			
		</div>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	</body>
</html>