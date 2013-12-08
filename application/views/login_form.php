<div id="login_form">
	<h1>Login Form</h1>
    <?php 
		if (isset($msg)){
			echo "<p class='msg'>$msg</p>";
		}
		echo form_open("login/validate_user"); 
		if (isset($msg)){
			echo form_input("email", "", 'placeholder="Email"');
		}
		else{
			echo form_input("email", $this->input->post('email'), 'placeholder="Email"');
		}
		if (isset($msg)){
			echo form_password("password", "", 'placeholder="Password"');
		}
		else{
			echo form_password("password", $this->input->post('password'), 'placeholder="Password"');
		}
		echo form_submit("login", "Login");
		echo anchor("login/signup", "Create Account", 'title="No Account? Create One"');
		echo form_close();
		echo validation_errors('<p class=error>');
		if (isset($error)){
			echo "<p class='error'>$error</p>";
		}
	?>
</div>