<?php include "templates/include/header.php" ?>

<div id="start" style="width:100%;">

	<form method="post">
		<button id="linkbutton" type="submit" formaction="admin.php">Admin Home</button>

	</form>
	  
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

 <br>
 
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
<?php } ?>
 
		  
<br>
			<p>Click on a column header to sort the table.</p>
      <table>
        <tr style="background:#a9dd7d;cursor:pointer;">
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=id'">Unique ID</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=enrollment_status'">Enrollment Status</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=last_modified'">Last Modified</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=paid'">Paid?</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=waiver_signed'">Waiver</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=f_name'">First Name</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=l_name'">Last Name</th>
			<th>Age</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=bday'">Birthdate</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=grade'">Grade</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=age_group'">Class Group</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=team'">Team</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=address'">Address</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=city'">City</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=zip'">Zip</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=home_phone'">Home Phone</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=mobile_phone'">Mobile Phone</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=mother_name'">Mother's Name</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=father_name'">Father's Name</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=emergency_contact'">Emergency Contact</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=emergency_phone'">Emergency Phone</th>
			<th onclick="location='admin.php?action=listRegistrants&amp;ordering=medical_conditions'">Medical Conditions</th>
        </tr>
	<?php $rowNum = 1; ?>
	<?php foreach ( $results['registrants'] as $registrant ) { ?>
		<tr onclick="location='admin.php?action=editRegistrant&amp;registrantId=<?php echo $registrant->id?>'">
			<td><?php echo $registrant->id ?></td>
			<td><?php echo ($registrant->enrollment_status==0 ? "Inactive" : "Active") ?></td>
			<td><?php echo $registrant->last_modified ?></td>
			<td><?php echo ($registrant->paid == 0 ? "No" : "Paid") ?></td>         
			<td><?php echo ($registrant->waiver_signed == 0 ? "No" : "Yes") ?></td>
			<td><?php echo $registrant->f_name ?></td>
			<td><?php echo $registrant->l_name ?></td>
			<td><?php echo date_diff(date_create(date('j M Y', strtotime(date('j M Y',$registrant->bday) . "+1 days"))), date_create('today'))->y; ?></td>
			<td><?php echo date('Y-m-d', strtotime(date('m/d/Y',$registrant->bday) . "+1 days")) ?></td>
			<td><?php echo $registrant->grade ?></td>
			<td><?php echo $registrant->age_group ?></td>
			<td><?php echo $registrant->team ?></td>
			<td><?php echo $registrant->address ?></td>
			<td><?php echo $registrant->city ?></td>
			<td><?php echo $registrant->zip ?></td>
			<td><?php echo $registrant->home_phone ?></td>
			<td><?php echo $registrant->mobile_phone ?></td>
			<td><?php echo $registrant->mother_name ?></td>
			<td><?php echo $registrant->father_name ?></td>
			<td><?php echo $registrant->emergency_contact ?></td>
			<td><?php echo $registrant->emergency_phone ?></td>
			<td><?php echo $registrant->medical_conditions ?></td>
		</tr>
		<?php $rowNum++; ?>
	<?php } ?>
	
      </table>
 
	<form method="post">
		<button id="linkbutton" formaction="admin.php?action=logout">Logout</button>
	</form>
	
	
 </div>
 
<?php include "templates/include/footer.php" ?>