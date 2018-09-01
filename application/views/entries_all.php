<?
if (!empty($users)) {
	foreach($users as $userID=>$userName) {
		$userEntries = 0;
?>

		<div class="row">
		
			<div class="col-md-12">
				<h4>Entries for <?php echo $userName; ?></h4>
				<table class="table table-responsive table-striped table-hover">
					<thead>
						<tr>
							<td><small class="text-muted">Date</small></td>
							<td><small class="text-muted">Category</small></td>
							<td><small class="text-muted">Amount</small></td>
							<td>&nbsp;</td>
						</tr>
					</thead>
					<tbody>
<?
		if (!empty($entries)) {
			foreach($entries as $id=>$entry) {
				if ($entry->getUserID() == $userID) {
					$userEntries++;
?>
						<tr>
							<td><p><small><a href="<?php echo base_url("entries/edit/".$entry->getID()); ?>"><?php echo $entry->getDate(); ?></small></p></a></td>
							<td><p><small><?php echo $categories[$entry->getCategoryID()]; ?></small></p></td>
							<td><p><small>$<?php echo number_format($entry->getAmount(),2); ?></small></p></td>
							<td><p class="text-right"><a class="text-danger" href="<?php echo base_url("entries/delete/".$entry->getID()); ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></p></td>
						</tr>
<?
				}
			}
		} else {
?>
						<tr>
							<td colspan="4"><p class="text-center">There are no entries entered into the system. Please add at least one entry.</p></td>
						</tr>
<?	
		}
		if ($userEntries == 0) {
?>
						<tr>
							<td colspan="4"><p class="text-center">There is no data for this user over the last 100 entries.</p></td>
						</tr>
<?				
		}
?>

					</tbody>
				</table>
<?
	}
}
?>
			</div>
		</div>