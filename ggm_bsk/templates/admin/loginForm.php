<?php include "templates/include/header.php" ?>

<div id="start"> 

    <form action="admin.php?action=login" method="post">
        <input type="hidden" name="login" value="true" />
 
		<?php if ( isset( $results['errorMessage'] ) ) { ?>
				<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
		<?php } ?>

		<div class="input_field">
			<input type="text" class="text" name="username" value="User Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User Name';}" >
			<p>Login</p>
		</div>
		
		<br><br>
		
		<div class="input_field">
			<input type="password" name="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
			<p>Password</p>
		</div>
		
		<br><br>
		
		<button id="linkbutton" type="submit" name="login">Login</button>

    
	</form>	
</div> 

<?php include "templates/include/footer.php" ?>