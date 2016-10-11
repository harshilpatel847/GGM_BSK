<?php include "templates/include/header.php" ?>

<div id="start">
	  
	<?php foreach ( $results['scores'] as $score ) { ?>
		<button id="scorebutton" ><?php echo $score->name." = ".$score->score ?></button>
	<?php } ?>	
	
	<?php if ( isset( $results['errorMessage'] ) ) { ?>
			<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
	<?php } ?>
	
	<?php if ( isset( $results['statusMessage'] ) ) { ?>
			<script>alert("<?php echo $results['statusMessage'] ?>");</script>
	<?php } ?>
	
	<form method="post">

		<button id="linkbutton" formaction="admin.php?action=logout">Logout</button>
		
		<br><br><hr><br>
		
		<p>Take attendance for different class groups by selecting the names of the students that are present that day and then clicking "Submit Attendance".</p>
		<button id="linkbutton" type="submit" formaction="admin.php?action=roster&ageGroup=a">Group A</button>
		<button id="linkbutton" type="submit" formaction="admin.php?action=roster&ageGroup=b">Group B</button>
		<button id="linkbutton" type="submit" formaction="admin.php?action=roster&ageGroup=c">Group C</button>
		
		<br><br><hr><br>
		
		<div style="float:left; margin-right:1em;" class="input_field">
			<select multiple  name="fields[]" id="fields" size="22" class="text" />
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("id",$_POST['fields'])){echo "selected";}} ?> value="id" >Unique Id</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("last_modified",$_POST['fields'])){echo "selected";}} ?> value="last_modified" >Last Modified</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("paid",$_POST['fields'])){echo "selected";}} ?> value="paid" >Payment Status</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("waiver_signed",$_POST['fields'])){echo "selected";}} ?> value="waiver_signed" >Liability Waiver</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("f_name",$_POST['fields'])){echo "selected";}} ?> value="f_name" >First Name</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("l_name",$_POST['fields'])){echo "selected";}} ?> value="l_name" >Last Name</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("age",$_POST['fields'])){echo "selected";}} ?> value="age" >Age</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("bday",$_POST['fields'])){echo "selected";}} ?> value="bday" >Birthdate</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("grade",$_POST['fields'])){echo "selected";}} ?> value="grade" >Grade</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("age_group",$_POST['fields'])){echo "selected";}} ?> value="age_group" >Class Group</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("team",$_POST['fields'])){echo "selected";}} ?> value="team" >Team</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("address",$_POST['fields'])){echo "selected";}} ?> value="address" >Address</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("city",$_POST['fields'])){echo "selected";}} ?> value="city" >City</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("zip",$_POST['fields'])){echo "selected";}} ?> value="zip" >Zip Code</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("email",$_POST['fields'])){echo "selected";}} ?> value="email" >Email</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("home_phone",$_POST['fields'])){echo "selected";}} ?> value="home_phone" >Home Phone</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("mobile_phone",$_POST['fields'])){echo "selected";}} ?> value="mobile_phone" >Mobile Phone</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("mother_name",$_POST['fields'])){echo "selected";}} ?> value="mother_name" >Mother's Name</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("father_name",$_POST['fields'])){echo "selected";}} ?> value="father_name" >Father's Name</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("emergency_contact",$_POST['fields'])){echo "selected";}} ?> value="emergency_contact" >Emergency Contact</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("emergency_phone",$_POST['fields'])){echo "selected";}} ?> value="emergency_phone" >Emergency Phone</option>
				<option class="admin" <?php if(isset($_POST['fields'])){if(in_array("medical_conditions",$_POST['fields'])){echo "selected";}} ?> value="medical_conditions" >Medical Conditions</option>
			</select>
		</div>
		<p>Select the columns you want to view from the left (choose multiple by holding down the CTRL key) and then click the button below.</p>
		<button id="linkbutton" type="submit" formaction="admin.php?action=customList">List ONLY Active Registrations</button>		

		<br><br><hr><br>

		<p>This is a full table of all registrations, both active and inactive, with all fields displayed.</p>
		<button id="linkbutton" type="submit" formaction="admin.php?action=listRegistrants">List All Registrations</button>

		<br><br><hr><br>	
		
		<p>Enter a new registration into the system on behalf of a parent or student.</p>
		<button id="linkbutton" type="submit" formaction="admin.php?action=newRegistrant">Add a New Registrant</button>		
	
	</form>	
	
</div>
 
<?php include "templates/include/footer.php" ?>	