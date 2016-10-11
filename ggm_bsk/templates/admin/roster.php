<?php include "templates/include/header.php" ?>

<div id="start">

	<?php foreach ( $results['scores'] as $score ) { ?>
		<button id="scorebutton" ><?php echo $score->name." = ".$score->score ?></button>
	<?php } ?>		
	
	<form method="post">
		<button id="linkbutton" type="submit" formaction="admin.php">Admin Home</button>
		<button id="linkbutton" type="button"><?php echo date("l F j, Y") ?></button>
		<button id="linkbutton" type="submit" formaction="admin.php?action=roster&ageGroup=<?php echo $_GET['ageGroup'] ?>&logbook=takeAttendance">Take Attendance</button>
		<button id="linkbutton" type="submit" formaction="admin.php?action=roster&ageGroup=<?php echo $_GET['ageGroup'] ?>&logbook=checkinHomework">Check-in Homework</button>
	</form> 
	  
	<?php if ( isset( $results['errorMessage'] ) ) { ?>
			<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
	<?php } ?>
 
	<?php if ( isset( $results['statusMessage'] ) ) { ?>
			<div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
	<?php } ?>
			
	<form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
		
		<?php if ( $_GET['logbook']=="checkinHomework" ) { ?>
			<div class="input_field">
				<input required type="text" name="homework[number]" class="text" />
				<p for="homework[number]" class="field_title">Assignment Number</p>
			</div>	
		<?php } ?>
		
		<table>
			<tr style="background:#a9dd7d;">
				<th id="hide_on_mobile">Row</th>
				<th>Points</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Age</th>
				<?php if ($_GET['logbook']=="takeAttendance" ){ ?>
					<th>Attendance</th>
				<?php } ?>
				<?php if ($_GET['logbook']=="checkinHomework" ){ ?>
					<th>Homework</th>
				<?php } ?>				
				<th id="hide_on_mobile">Team</th>	
			</tr>
		<?php $rowNum = 1; ?> 
		<?php foreach ( $results['registrants'] as $registrant ) { ?>
			<tr onClick="(student[<?php echo $rowNum-1; ?>].checked) = !(student[<?php echo $rowNum-1; ?>].checked)">
				<td id="hide_on_mobile"><?php echo $rowNum; ?></td>
				<td id="show_on_mobile">
					<button id="linkbutton_small" style="width:2em" type="submit" name="points[<?php echo $registrant->team ?>]" value="1">+</button>
					<button id="linkbutton_small" style="width:2em" type="submit" name="points[<?php echo $registrant->team ?>]" value="0">-</button>
				</td>
				<td id="show_on_mobile" style="text-transform: capitalize;"><?php echo $registrant->f_name?></td>
				<td id="show_on_mobile" style="text-transform: capitalize;"><?php echo $registrant->l_name?></td>
				<td id="show_on_mobile"><?php echo date_diff(date_create(date('j M Y', strtotime(date('j M Y',$registrant->bday) . "+1 days"))), date_create('today'))->y; ?></td>
				<?php if ($_GET['logbook']=="takeAttendance"){ ?>
				<td id="show_on_mobile">
					<input hidden type="checkbox" id="student" name="attendance[<?php echo $registrant->id?>]" value="1" /><label for="attendance[<?php echo $registrant->id?>]"></label>
				</td>
				<?php } ?>
				<?php if ($_GET['logbook']=="checkinHomework"){ ?>
				<td id="show_on_mobile">
					<input hidden type="checkbox" id="student" name="homework[<?php echo $registrant->id?>]" value="1" /><label for="homework[<?php echo $registrant->id?>]"></label>
				</td>
				<?php } ?>
				<td id="hide_on_mobile"><?php echo $registrant->team; ?></td>
			</tr> 
		<?php $rowNum++; ?>
		<?php } ?>
		</table>
		<?php if ($_GET['logbook']=="takeAttendance"){ ?>
			<br><br>
			<button id="linkbutton" type="submit" name="takeAttendance">Submit Attendance</button>		
		<?php } ?>
		<?php if ($_GET['logbook']=="checkinHomework"){ ?>
			<br><br>
			<button id="linkbutton" type="submit" name="checkinHomework">Check-in Homework</button>		
		<?php } ?>
		<input type="hidden" name="points[ageGroup]" value="<?php echo $_GET['ageGroup'] ?>" />
	</form>
		
 </div>
 
<?php include "templates/include/footer.php" ?>