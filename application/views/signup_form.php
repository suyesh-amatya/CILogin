<div id="signup_form">
    <h1>Sign Up Form</h1>
    
        <?php
            echo form_open("login/signup_member"); 
			echo form_input("first_name", $this->input->post('first_name'), 'placeholder="First Name"');
			echo form_input("last_name", $this->input->post('last_name'), 'placeholder="Last Name"');
            echo form_input("email", $this->input->post('email'), 'placeholder="Email"');
            echo form_password("password", $this->input->post('password'), 'placeholder="Password"');
			echo form_password("repassword", $this->input->post('repassword'), 'placeholder="Re-Password"');
            echo form_submit("signup", "Sign Up");
            echo form_close();
            echo validation_errors('<p class=error>');
			if (isset($error)){
				echo "<p class='error'>$error</p>";
			}
        ?>
 </div>