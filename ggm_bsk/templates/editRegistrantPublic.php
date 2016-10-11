<?php 

include( "templates/include/header.php");

?>

<div id="start">

	<?php 
	if($results['registrants']->waiver_signed == true && $results['registrants']->enrollment_status == true) {
		?>
			<h3 style="margin:0;padding:0;">(Enrolled for the 2015-16 school year!)</h3>
		<?php
	}else { 
		?>
			<h3 style="margin:0;padding:0;color:#FF0000;">(Not Yet Enrolled for 2015-16)</h3>
			<p style="color:#FF0000;">Make sure to check "Agree" for the Liability Waiver at the bottom of the form and that you have paid the registration fee.</p>	
		<?php
	}
	?>	
	<?php if ( isset( $results['errorMessage'] ) ) { ?>
		<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
		<br><br>
	<?php } ?>
	
	<form action="index.php?action=<?php echo $results['formAction']?>" method="post">
								
		<div class="input_field">		 
		<select disabled required name="paid" id="paid" required class="text" />
			<option value="0" <?php if ( !$results['registrants']->paid ) {echo "selected";} ?> >Not Yet Paid</option>
			<option value="1" <?php if ($results['registrants']->paid == "1") {echo "selected";} ?> >Registration Fee Paid</option>				
		</select>
		<p for="paid" class="field_title">Registration Fee for 2015-16</p>
		</div>
		
		<br>
				
		<input type="hidden" class="text" name="registrantId" value="<?php echo $results['registrants']->id ?>"/>
		
		<input type="hidden" class="text" name="reg_type" value="<?php if(!$results['registrants']->reg_type){echo "s";}  ?>" />
		<input type="hidden" class="text" name="last_modified" value="<?php echo date('Y-m-d H:i:s', time()); ?>" />
		<input type="hidden" class="text" name="enrollment_status" value="<?php if(!$results['registrants']->reg_type){echo "0";} ?>" />
				
<!-- 		<div class="input_field">
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
		</div>

		<br>		 -->
		
		<div class="input_field">
		<input type="text" name="f_name" id="f_name" maxlength="255" value="<?php echo $_GET['first'] ?: htmlspecialchars( $results['registrants']->f_name) ?>" class="text" />
		<p for="f_name" class="field_title">First Name</p>
		</div>
		
		<div class="input_field">		
		<input type="text" name="l_name" id="l_name" maxlength="255" value="<?php echo $_GET['last'] ?: htmlspecialchars( $results['registrants']->l_name) ?>" class="text" />
		<p for="l_name" class="field_title">Last Name</p>	
		</div>
		
		<br>

		<div class="input_field">
		<input type="date" name="bday" id="bday" value="<?php echo $_GET['birthdate'] ?: date('Y-m-d', strtotime(date('m/d/Y',$results['registrants']->bday) . "+1 days")) ?>" class="text" />
		<p for="bday" class="field_title">Birthdate (<?php echo ($_GET['first'] ?: htmlspecialchars( $results['registrants']->f_name)) . " is " . date_diff(date_create($_GET['birthdate'] ?: date('Y-m-d', strtotime(date('m/d/Y',$results['registrants']->bday) . "+1 days"))), date_create('today'))->y; ?> years old)</p>
		</div>

		<div class="input_field">
		<select required class="text" name="grade" id="grade" />
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
		<input type="text"  name="address" id="address" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->address )?>" class="text" />
		<p for="address" class="field_title">Address</p>		
		</div>
		
		<br>		
		
		<div class="input_field">
		<input type="text"  name="city" id="city" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->city )?>" class="text" />
		<p for="city" class="field_title">City</p>				
		</div>
		
		<div class="input_field">		
		<input type="text"  name="zip" id="zip" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->zip )?>" class="text" />
		<p for="zip" class="field_title">Zip</p>				
		</div>
		
		<br>		
		
		<div class="input_field">
		<input type="tel"  name="home_phone" id="home_phone" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->home_phone )?>" class="text" />
		<p for="home_phone" class="field_title">Home Phone</p>				
		</div>
		
		<div class="input_field">		
		<input type="tel"  name="mobile_phone" id="mobile_phone" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->mobile_phone )?>" class="text" />
		<p for="mobile_phone" class="field_title">Mobile Phone</p>				
		</div>
		
		<br>		
				
		<div class="input_field_full">
		<input type="email"  name="email" id="email" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->email )?>" class="text" />
		<p for="email" class="field_title">Email</p>				
		</div>
		
		<br>		
		
		<div class="input_field">
		<input type="text"  name="mother_name" id="mother_name" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->mother_name )?>" class="text" />
		<p for="mother_name" class="field_title">Mother's Name</p>				
		</div>
		
		<div class="input_field">		
		<input type="text"  name="father_name" id="father_name" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->father_name )?>" class="text" />
		<p for="father_name" class="field_title">Father's Name</p>				
		</div>
		
		<br>				
		
		<div class="input_field">
		<input type="text"  name="emergency_contact" id="emergency_contact" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->emergency_contact )?>" class="text" />
		<p for="emergency_contact" class="field_title">Emergency Contact</p>
		</div>
		
		<div class="input_field">		
		<input type="tel"  name="emergency_phone" id="emergency_phone" maxlength="255" value="<?php echo htmlspecialchars( $results['registrants']->emergency_phone )?>" class="text" />
		<p for="emergency_phone" class="field_title">Emergency Phone</p>				
		</div>
		
		<br><br>		
		
		<div class="input_field_full">
		<input type="text" name="medical_conditions" id="medical_conditions" class="text" value="<?php echo htmlspecialchars( $results['registrants']->medical_conditions )?>" />
		<p for="medical_conditions" class="field_title">Medical Conditions</p>
		</div>
		
		<br><br>
		
		<div class="input_field_full">
		<div name="liability_waiver" id="liability_waiver"  class="text">
		<h6>Liability Waiver and Consent Form</h6>
		<p>I hereby waive and release indemnify, hold harmless and forever discharge Gayatri Gyan Mandir, a nonprofit organization and its agents, officers, directors, affiliates, successors and assigns, from any and all claims, demands, debts, contracts, expenses, causes of action, lawsuits, damages and liabilities, of every kind and nature, whether known or unknown, in law or equity, that I or my child ever had or may have, arising from or in any way related to my child's participation in any of the events or activities conducted by, on the premises of, or for the benefit of, Gayatri Gyan Mandir, provided that this waiver of liability does not apply to any acts of gross negligence, or intentional, willful or wanton misconduct.</p>
		<br>
		<p>I have read, understand, and fully agree to the terms of this WAIVER AND RELEASE. I understand and confirm that by agreeing to this WAIVER AND RELEASE, my child and I have given up considerable future legal rights and agreed to this Agreement freely, voluntarily, under no duress or threat of duress, without inducement, promise or guarantee being communicated to me. Checking the box below is proof of my intention to execute a complete and unconditional WAIVER AND RELEASE of all liability to the full extent of the law.</p> 
		<br>
		</div>
		<p for="liability_waiver" class="field_title">Liability Waiver</p>
		</div>
		
		<br>
		
		<div class="input_field">
		
			<input hidden type="checkbox" name="waiver_signed" id="waiver_signed" value="<?php echo $results['registrants']->waiver_signed ?>" <?php if($results['registrants']->waiver_signed=="1"){echo "checked";} ?> /><label for="waiver_signed"></label><h4>I have read and understand the terms of the liability waiver.</h4>
		</div>
		<br><br><br><br>		

		<button id="linkbutton" type="submit" name="saveChanges">Save Changes</button>
		<button id="linkbutton" type="button" onclick="location='index.php?action=viewRegistrant&registrantId=<?php echo $results['registrants']->id ?>'">Cancel</button>
	

	</form>		

</div>

 <?php
 
 include( "templates/include/footer.php");
 
 ?>