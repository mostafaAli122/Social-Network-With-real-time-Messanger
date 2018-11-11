<?php
include('classes/DB.php');

if (isset($_POST['createaccount'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	if (!DB::query('SELECT username FROM users WHERE username=:username',array(':username'=>$username))) {
		
		if (strlen($username)>=3&& strlen($username)<=32) {
			
			if (preg_match('/[a-zA-Z0-9_]+/',$username )) {
				if (strlen($password)>=6&& strlen($password)<=60) {
					if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
						if (!DB::query('SELECT email from users where email=:email', array(':email'=>$email) )) {
							$hashedPassword=password_hash($password,PASSWORD_BCRYPT);
							DB::query('INSERT INTO users VALUES (\'\',:username,:password,:email)',array(':username'=>$username, ':password'=>$hashedPassword,':email'=>$email));
							echo "Success !!";
						}
						else{
							echo 'Email in Use!!';
						}
						
						
					}else{
						echo 'Invalid email';
					}
				}
				else {
					echo 'Invalid Password';
				}
				
			}
			
		}else {
			echo'Invalid username';
		}
		

	}
	else {
		echo 'user already exists!';
	}
	
	
}
?>
<h1>Register</h1>
<form action="create-account.php" method="post">
	<input type="text" name="username" value="" placeholder="Username ..."></p>
	<input type="password" name="password" value="" placeholder="Password ..."></p>
	<input type="email" name="email" value="" placeholder="someone@somesite.com"></p>
	<input type="submit" name="createaccount" value="Create Account">

</form>
