
<?php 
include( "templates/include/header.php");
?>

<div id="start">

	<div class="text_block" style="text-align:left;">
		<p style="font-weight:600; font-size:2em;">Start Date: September 6th, 2015 @ 11:00am</p>		
		<p>Location: Gayatri Gyan Mandir</p>		
		<br>		
		<p>Ages: 5-18</p>		
		<br>		
		<p>Non-refundable registration fee: $40</p>		
		<br>		
		<p style="font-weight:600; font-size:2em;">Please Make Checks Payable to: Gayatri Gyan Mandir</p>		
		<br>		
		<p>Checks can be given to:  </p>		
		<br>		
		<p style="font-weight:600; font-size:2em;">Gayatri Gyan Mandir</p>
		<p style="font-weight:600; font-size:2em;">5N 371 IL Route 53 (Rohwling RD )</p>
		<p style="font-weight:600; font-size:2em;">Itasca, IL 60143</p>		
		<br><br>		
		<p>Registration is confirmed only after payment is made in full. </p>		
		<br>		
		<p>For further questions please E-mail or Call: </p>		
		<br>		
		<p style="font-weight:600; font-size:2em;">ggmbsk@gmail.com or call - (630) 250-8400</p>		
		<br>		
		<p>Please submit the required questions and sign the attached Legal Waiver form.</p>		
		<br>
		<p>Thank you,</p> 
		<p>Gayatri Pariwar Youth, Chicago</p>
	</div>

	<div class="status">
	<?php if ( isset( $_GET['status'] ) ) {
		if ( $_GET['status'] == "registrationEdited" ) $results['statusMessage'] = "Your registration information has been updated";
		if ( $_GET['status'] == "registrationAdded" ) $results['statusMessage'] = "Thank you for registering!";
	?>
		<script>alert("<?php echo $results['statusMessage'] ?>");</script>
	<?php }else {
		$results['statusMessage'] = "This is the registration information for " . $results['registrants']->f_name . " " . $results['registrants']->l_name;  
	} ?>	
	</div>

	
	<form action="index.php?action=begin" method="post">
		
		<input type="hidden" name="begin" value="true" />

		<?php if ( isset( $results['errorMessage'] ) ) { ?>
		<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
		<?php } ?>
		
		<div class="input_field">
			<input type="text" class="text" name="full_name" placeholder="first & last" onfocus="if (this.placeholder == 'first & last') {this.placeholder = '';}" onblur="if (this.placeholder == '') {this.placeholder = 'first name & last name';}" />
			<p class="field_title">Full Name</p>
		</div>
		
		<br><br>
		
		<div class="input_field">
			<input type="date" class="text" name="birthdate" placeholder="mm/dd/yyyy" onfocus="if (this.placeholder == 'mm/dd/yyyy') {this.placeholder = '';}" onblur="if (this.placeholder == '') {this.placeholder = 'mm/dd/yyyy';}" />
			<p class="field_title">Birthdate</p>
		</div>
		
		<br><br>
		
		<button id="linkbutton" type="submit" name="begin">Start</button>
	
	</form>

</div>	
	
<?php
include( "templates/include/footer.php");
?>