<?php
session_start();
require('../phpfiles/dbconnect.php');//DBCONNECTION

if (isset($_POST['email']))
{
    // removes backslashes
	$email = stripslashes($_REQUEST['email']);
    //escapes special characters in a string
	$email = mysqli_real_escape_string($con,$email);	
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
	$query = "SELECT * FROM `sc_users` WHERE Email='$email' and Usertype='student' and Password='".md5($password)."'";	
	$query1 = "SELECT * FROM `sc_users` WHERE Email='$email' and Usertype='agent' and password='".md5($password)."'";
	
	FUNCTION error(){
	echo '<form class="login" METHOD="POST"  >
    <p class="title">Log in</p>
    <p class="title" style="color:red;">Wrong user and password combination</p>
    Email
	<input type="text" placeholder="email" name="email" required/>
	
	password
	<input type="password" placeholder="*********" name="password"/>
	<center>
	<a href="#">Forgot Password</a>
	<br>
	Not yet a member
	<br><a href="../signup">Signup</a>
	<br>
	</center>
    <input type="submit" id="button" value="Login"/>
	</form>
	<footer><a target="blank" href="#">A FINIFY PRODUCTION</a></footer>
	</div>
	</body>
	</html>';
	}
	
	$result = mysqli_query($con,$query) ;
	$result1 = mysqli_query($con,$query1);
	$rows = mysqli_num_rows($result) ;
	$rows1 = mysqli_num_rows($result1) ;
	if($rows==1)
	{
		$_SESSION['studentemail'] = $email;
		// Redirect user to index.php
		header("Location:../studenthome");
	}else if($rows1==1){
		$_SESSION['agentemail'] = $email;
		// Redirect user to index.php
		header("Location:../agenthome");
	}else{
		require('header.php');
		error();
	}
}else{

	require('header.php');
?>
	<form class="login" METHOD="POST">
		<p class="title">Log in</p>
		Email
		<input type="text" placeholder="email" name="email" required/>
		
		password
		<input type="password" placeholder="*********" name="password"/>
		<center>
		<a href="#">Forgot Password</a>
		<br>
		Not yet a skulcrib member
		<br><a href="../signup">Signup</a>
		<br>
		</center>
		<input type="submit" id="button" value="Login"/>
	</form>
	<footer><a target="blank" href="#">A FINIFY PRODUCTION</a></footer>
</div>
</body>
</html>
<?php } ?>
