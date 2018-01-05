			<div class="row">
				<div class="col-xs-12">
					<form action="<?php echo base_url(); ?>entries/add" method="get"><p class="text-center"><button class="btn btn-default navbar-btn" type="submit">Add New Expense Entry</button></p></form>
				</div>
			</div>
			
			<div class="row gutter-bottom">
				<div class="col-xs-12">
					<h3 class="text-center">Summary for <?php echo date("F Y"); ?></h3>
				</div>
			</div>
		
<?php
	foreach ($budget_allowances as $category) {
		if ($category->getValue() > 0) {
			$value = round($budget_totals[$category->getID()] / $category->getValue() * 100,2);
			$suffix = " remaining";
			if ($value > 100) {
				$value = 100;
				$suffix = " overdrawn";
			}
			$textStyle = "text-success";
			$barStyle = "progress-bar-success";
			$message =  "$".number_format(round($category->getValue() - $budget_totals[$category->getID()],2),2).$suffix;
			if (($value > 70) && ($value <= 90)) {
				$textStyle = "text-warning";
				$barStyle = "progress-bar-warning";
			}
			if ($value > 90) {
				$textStyle = "text-danger";
				$barStyle = "progress-bar-danger";
			}
?>

			<div class="row gutter-bottom">
				<div class="col-xs-7">
					<p class="no-margins"><?php echo $category->getName() ?></p>
				</div>
				<div class="col-xs-5">
					<p class="text-right no-margins <?php echo $textStyle; ?>"><?php echo $message; ?></p>
				</div>
				<div class="col-xs-12">
					<div class="progress">
						<div class="progress-bar <?php echo $barStyle; ?>" role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value; ?>%;"></div>
					</div>
				</div>
			</div>
		
<?php
		}
	}
?>