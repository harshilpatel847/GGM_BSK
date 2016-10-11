<?php include "templates/include/header.php" ?>

<div id="start" style="width:100%;">

	<?php if ( isset( $results['errorMessage'] ) ) { ?>
		<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
	<?php } ?>

	<?php if ( isset( $results['statusMessage'] ) ) { ?>
		<div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
	<?php } ?>
	
 	<form method="post">
		<?php if ( !$_POST['fields'] )  { ?>
			<div class="statusMessage"><p>"You have not selected which fields to display. Go back to Admin Home to selected the fields for this registration table."</p></div>
			<br><br>
		<?php }else { 
			$fields = array(); 
			foreach ( $_POST['fields'] as $field ) { 
				$fields[] = $field; 
			};
			foreach ($fields as $field){ ?>
				<input hidden class="text" name="fields[]" value="<?php echo $field; ?>" />
			<?php }} ?>
		<button id="linkbutton" type="submit" formaction="admin.php">Admin Home</button>
		<button id="linkbutton" formaction="admin.php?action=logout">Logout</button>

	<br><br>

	<?php if ( isset( $_POST['fields'] ) ) { ?>
		<p>Click on a column header to sort the table.</p>
		<table>
			<tr style="background:#a9dd7d;">
				<th><button id="linkbutton_small" >Selection</button></th>
				<?php foreach ( $_POST['fields'] as $field ) { if($field == "age") { ?>
					<th><button id="linkbutton_small" >Age</button></th>
				<?php }else { ?>
					<th><button id="linkbutton_small" type="submit" formaction="admin.php?action=customList&amp;ordering=<?php echo $field ?>"><?php echo $field ?></button></th>
				<?php }} ?>
			</tr>
			<?php foreach ( $results['registrants'] as $registrant ) { ?>
			<tr>
				<td><button id="linkbutton_small" type="submit" formaction="admin.php?action=editRegistrant&amp;registrantId=<?php echo $registrant->id?>">View</button></td>
				<?php foreach ( $_POST['fields'] as $field ) { 
					if ( $field == "bday" ){
						echo "<td>" . date('Y-m-d', strtotime(date('m/d/Y',$registrant->$field) . "+1 days")) . "</td>";
					} elseif ( $field == "waiver_signed" ) {
						echo "<td>" . ( $registrant->$field == "1" ? "Yes" : "No" ) . "</td>";
					} elseif ( $field == "paid" ) {
						echo "<td>" . ( $registrant->$field == "1" ? "Paid" : "No" ) . "</td>";
					} elseif ( $field == "age" ) {
						echo "<td>" . date_diff(date_create(date('j M Y', strtotime(date('j M Y',$registrant->bday) . "+1 days"))), date_create('today'))->y . "</td>";
					} else {
						echo "<td>" . $registrant->$field . "</td>";	
					}
				} ?>
			</tr>
			<?php } ?>
		</table>	
		<?php } ?>
	</form>
		
	<br>	
 		  
</div>
 
<?php include "templates/include/footer.php" ?>