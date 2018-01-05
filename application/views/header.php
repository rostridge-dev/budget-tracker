<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $title; ?>: Budget Tracker</title>

		<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap.spacelab.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/bootstrap.budget-tracker.css" rel="stylesheet">
		
	</head>

	<body>
	
		<div id="navbar-user">
			<div class="container">
				<ul class="list-inline pull-right">
					<li><a href="<?php echo base_url(); ?>profile"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $this->session->userdata('firstname'); ?> <?php echo $this->session->userdata('lastname'); ?></a></li>
					<li><a href="<?php echo base_url(); ?>logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
				</ul>
			</div>
		</div>

		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo base_url(); ?>home">Budget Tracker</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url(); ?>entries">List All Entries</a></li>
					</ul>
				</div><!--/.navbar-collapse -->
			</div>
		</nav>

		<div class="container">