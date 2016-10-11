<?php 
include( "templates/include/header.php");
?>

<div id="start">
	
	<?php if($results['registrants']->waiver_signed == true && $results['registrants']->enrollment_status == true) { ?>
			<h3 style="margin:0;padding:0;">(Enrolled for the 2015-16 school year!)</h3>
	<?php }else { ?>
			<h3 style="margin:0;padding:0;color:#FF0000;">(Not Yet Enrolled for 2015-16)</h3>
			<p style="color:#FF0000;">Make sure to check "Agree" for the Liability Waiver at the bottom of the form and that you have paid the registration fee.</p>	
	<?php } ?>	

	<form id="editRegistrantPublic" action="index.php?action=<?php echo $results['formAction']?>" method="post">
		<div class="status">
		<?php
		  if ( isset( $_GET['status'] ) ) {
			if ( $_GET['status'] == "registrationEdited" ) $results['statusMessage'] = "Your registration information has been updated";
			if ( $_GET['status'] == "registrationAdded" ) $results['statusMessage'] = "Thank you for registering!";
			?><script>alert("<?php echo $results['statusMessage'] ?>");</script><?php 
		  }else {
			$results['statusMessage'] = "This is the registration information for " . $results['registrants']->f_name . " " . $results['registrants']->l_name;  
		  }   
		?>	
		</div>
		
		
		<div class="input_field">		 
		<select disabled required name="paid" id="paid" required class="text" style="background:<?php if ( !$results['registrants']->paid ) {echo "F5A9A9";} ?>" />
			<option value="0" <?php if ( !$results['registrants']->paid ) {echo "selected";} ?> >Not Yet Paid</option>
			<option value="1" <?php if ($results['registrants']->paid == "1") {echo "selected";} ?> >Registration Fee Paid</option>				
		</select>
		<p for="paid" class="field_title">Registration Fee for 2015-16</p>
		</div>
		
<!-- 		<br>

		<div class="input_field">
		<select disabled required class="text" name="age_group" id="age_group" />
			<option value="a" <?php if ($results['registrants']->age_group == "a") {echo "selected";} ?> >Group A (>5 years)</option>
			<option value="b" <?php if ($results['registrants']->age_group == "b") {echo "selected";} ?> >Group B (6-10 years)</option>
			<option value="c" <?php if ($results['registrants']->age_group == "c") {echo "selected";} ?> >Group C (10-15 years)</option>
			<option value="d" <?php if ($results['registrants']->age_group == "d") {echo "selected";} ?> >Group D (15+ years)</option>
			<option value="unassigned" <?php if ($results['registrants']->age_group == "unassigned" || !isset($results['registrants']->age_group)) {echo "selected";} ?> >Unassigned</option>				
		</select>
		<p for="age_group" class="field_title">Class Group</p>
		</div>			
		
		<div class="input_field">		
		<select disabled required class="text" name="team" id="team" />
			<?php foreach ( $results['scores'] as $score ) { ?>
				<option value="<?php echo $score->id ?>" <?php if ($results['registrants']->team == $score->id) {echo "selected";} ?> ><?php echo $score->id.") ".$score->name ?></option>
			<?php } ?>
			<option value="unassigned" <?php if ($results['registrants']->team == "unassigned" || !isset($results['registrants']->team)) {echo "selected";} ?> >Unassigned</option>				
		</select>
		<p for="team" class="field_title">Team (To be assigned by teacher)</p>
		</div> -->

		<br>

		<div class="input_field">
		<input disabled type="text" name="f_name" id="f_name" maxlength="255" value="<?php echo $_GET['first'] ?: htmlspecialchars( $results['registrants']->f_name) ?>" class="text" />
		<p for="f_name" class="field_title">First Name</p>
		</div>
		
		<div class="input_field">		
		<input disabled type="text" name="l_name" id="l_name" maxlength="255" value="<?php echo $_GET['last'] ?: htmlspecialchars( $results['registrants']->l_name) ?>" class="text" />
		<p for="l_name" class="field_title">Last Name</p>	
		</div>
		
		<br>		
		
		<div class="input_field">
		<input disabled type="date" name="bday" id="bday" maxlength="255" value="<?php echo date('Y-m-d', strtotime(date('m/d/Y',$results['registrants']->bday) . "+1 days")) ?>" class="text" />
		<p for="bday" class="field_title">Birthdate (<?php echo $results['registrants']->f_name . " is " . date_diff(date_create(date('Y-m-d', strtotime(date('m/d/Y',$results['registrants']->bday) . "+1 days"))), date_create('today'))->y; ?> years old)</p>
		</div>	

		<div class="input_field">
		<select disabled required class="text" name="grade" id="grade" />
			<option value="k" <?php if ($results['registrants']->grade == "k") {echo "selected";} ?> >Kindergarten</option>
			<option value="1" <?php if ($results['registrants']->grade == "1") {echo "selected";} ?> >1st Grade</option>
			<option value="2" <?php if ($results['registrants']->grade == "2") {echo "selected";} ?> >2nd Grade</option>
			<option value="3" <?php if ($results['registrants']->grade == "3") {echo "selected";} ?> >3rd Grade</option>
			<option value="4" <?php if ($results['registrants']->grade == "4") {echo "selected";} ?> >4th Grade</option>
			<option value="5" <?php if ($results['registrants']->grade == "5") {echo "selected";} ?> >5th Grade</option>
			<option value="6" <?php if ($results['registrants']->grade == "6") {echo "selected";} ?> >6th Grade</option>
			<option value="7" <?php if ($results['registrants']->grade == "7") {echo "selected";} ?> >7th Grade</option>
			<option value="8" <?php if ($results['registrants']->grade == "8") {echo "selected";} ?> >8th Grade</option>
			<option value="9" <?php if ($results['registrants']->grade == "9") {echo "selected";} ?> >9th Grade</option>
			<option value="10" <?php if ($results['registrants']->grade == "10") {echo "selected";} ?> >10th Grade</option>
			<option value="11" <?php if ($results['registrants']->grade == "11") {echo "selected";} ?> >11th Grade</option>
			<option value="12" <?php if ($results['registrants']->grade == "12") {echo "selected";} ?> >12th Grade</option>
			<option value="Not Selected" <?php if ($results['registrants']->grade == "Not Selected" || !isset($results['registrants']->grade)) {echo "selected";} ?> >Not Selected</option>				
		</select>
		<p for="grade" class="field_title">Grade in school</p>
		</div>	
		
		<br>		
				
		<div class="input_field_full">		
		<input disabled type="text"  name="address" id="address" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->address )?>" class="text" />
		<p for="address" class="field_title">Address</p>		
		</div>
		
		<br>		
		
		<div class="input_field">
		<input disabled type="text"  name="city" id="city" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->city )?>" class="text" />
		<p for="city" class="field_title">City</p>				
		</div>
		
		<div class="input_field">		
		<input disabled type="text"  name="zip" id="zip" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->zip )?>" class="text" />
		<p for="zip" class="field_title">Zip</p>				
		</div>
		
		<br>		
		
		<div class="input_field">
		<input disabled type="text"  name="home_phone" id="home_phone" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->home_phone )?>" class="text" />
		<p for="home_phone" class="field_title">Home Phone</p>				
		</div>
		
		<div class="input_field">		
		<input disabled type="text"  name="mobile_phone" id="mobile_phone" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->mobile_phone )?>" class="text" />
		<p for="mobile_phone" class="field_title">Mobile Phone</p>				
		</div>
		
		<br>		
				
		<div class="input_field_full">
		<input disabled type="email"  name="email" id="email" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->email )?>" class="text" />
		<p for="email" class="field_title">Email</p>				
		</div>
		
		<br>		
		
		<div class="input_field">
		<input disabled type="text"  name="mother_name" id="mother_name" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->mother_name )?>" class="text" />
		<p for="mother_name" class="field_title">Mother's Name</p>				
		</div>
		
		<div class="input_field">		
		<input disabled type="text"  name="father_name" id="father_name" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->father_name )?>" class="text" />
		<p for="father_name" class="field_title">Father's Name</p>				
		</div>
		
		<br>				
		
		<div class="input_field">
		<input disabled type="text"  name="emergency_contact" id="emergency_contact" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->emergency_contact )?>" class="text" />
		<p for="emergency_contact" class="field_title">Emergency Contact</p>
		</div>
		
		<div class="input_field">		
		<input disabled type="text"  name="emergency_phone" id="emergency_phone" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->emergency_phone )?>" class="text" />
		<p for="emergency_phone" class="field_title">Emergency Phone</p>				
		</div>
		
		<br><br>	
		
		<div class="input_field_full">		
		<input disabled type="text" name="medical_conditions" id="medical_conditions" placeholder="Medical Conditions" class="text" onfocus="placeholder=''; if (this.value == 'Medical Conditions') {this.value = ''}" onblur="if (this.value == '') {this.value = 'Medical Conditions';}" value="<?php echo htmlspecialchars( $results['registrants']->medical_conditions )?>" />
		<p for="medical_conditions" class="field_title">Medical Conditions</p>
		</div>

		<br><br>

		<div class="input_field">
		<select disabled required name="waiver_signed" id="waiver_signed" required class="text" style="background:<?php if ($results['registrants']->waiver_signed == "0") {echo "#F5A9A9";} ?>" />
			<option value="0" <?php if ($results['registrants']->waiver_signed == "0") {echo "selected";} ?> >Incomplete</option>
			<option value="1" <?php if ($results['registrants']->waiver_signed == "1") {echo "selected";} ?> >Complete</option>				
		</select>
		<p for="waiver_signed" class="field_title">Liability Waiver</p>
		</div>

		<br><br><br><br>
		
		<button id="linkbutton" type="submit" formaction="index.php?action=editRegistrantPublic&registrantId=<?php echo $results['registrants']->id ?>">Edit Registration</button>		
		<button id="linkbutton" type="button" onclick="location='.'">Cancel</button>		
		
	</form>


<!-- Calendar
	<div class="grid responsive">
		<div class="row cells3">
			<div class="cell">
				<div data-role="calendar" data-week-start="7" data-multi-select="true" id="c1"></div>
				<br />
				<div class="align-center"><button class="button" onclick="get_dates()">Get selected dates</button></div>
				<script>
					function get_dates(){
						var result = $("#c1").calendar('getDates');
						alert(result);
					}
				</script>
			</div>
		</div>	
	</div>
End of Calendar -->
	
 </div>

 <?php
 
 include( "templates/include/footer.php");
 
 ?>