<?php
//complete form
$error='';
$form = '
<form class="login" METHOD="POST">
	<p class="title">Sign Up</p>
	<p>'.$error.'</p>
	First name 
	<input type="text" placeholder="firstname" id="user" name="firstname" autofocus required/>
		
	Email
	<input type="email" placeholder="email" name="email" required/>
	
	password
	<input type="password" placeholder="*********" name="password" required/>
	
	confirm password
	<input type="password" placeholder="*********" name="confirmpassword" required/>
	
	phone no
	<input type="number" placeholder="phoneno" name="phoneno" required/>
	
	institution
	<select name="institution" id="selectinput" >
	<option value="UNIVERSITY">UNIVERSITY</option>
	<option value="POLYTECHNIC">POLYTECHNIC</option>
	</select>
	
	User type
	<select name="usertype" id="selectinput" >
	<option value="student">Student</option>
	<option value="agent">Agent</option>
	</select>
	
	<center>
	Already a member
	<br><a href="../login">Login</a>
	<br>
	</center>
	
	<input type="submit" id="button" value="Sign Up" name="submit"/>
	</form>
	</div>  
  </body>
</html>
	';

  require('../phpfiles/dbconnect.php');
  // If form submitted, insert values into the database.
if (isset($_REQUEST['email']))
{
  //cleaning input for db upload
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$firstname = stripslashes($_REQUEST['firstname']);
  $firstname = mysqli_real_escape_string($con,$firstname);
  $password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
  $phoneno = stripslashes($_REQUEST['phoneno']);
  $phoneno = mysqli_real_escape_string($con,$phoneno);
  $institution = stripslashes($_REQUEST['institution']);
  $institution = mysqli_real_escape_string($con,$institution);
  $usertype = stripslashes($_REQUEST['usertype']);
  $usertype = mysqli_real_escape_string($con,$usertype);
  $confirmpassword = stripslashes($_REQUEST['confirmpassword']);//confirm password
	$confirmpassword = mysqli_real_escape_string($con,$confirmpassword);
  $trn_date = date("Y-m-d H:i:s");
  
	if($confirmpassword==$password)
	{
		$query = "SELECT * FROM `Sc_users` WHERE email='$email' 
		and phoneno='$phoneno'" ;//query to select input with same details as in db
		$result = mysqli_query($con,$query);
		$rows = mysqli_num_rows($result);
				if($rows==1)//if user already exist
				{
					$error = 'User already registered try another password';
					require('signupheader.php');
					echo $form;
				}else{
					//insert into userprofile//
					$query1 = "INSERT  into `sc_users` 
					(firstname,email,password,phoneno,institution,usertype)
					VALUES 
					('$firstname','$email','".md5($password)."','$phoneno','$institution','$usertype')";
					$result1 = mysqli_query($con,$query1);
					if($result1)
					{
						require('signupheader.php');
						echo "<div class='form'>
						You are registered successfully <a href='../login'>Login</a></div>
						</div>  
						</body>
						</html>";
						die();
					}
				}
	}else{
		require('signupheader.php');
		echo "<div class='form'>
		<b>Password Do not match</b> <a href='index.php'>Try Again</a></div>
		</div>  
		</body>
		</html>";
		die();
	}
}else{
	require('signupheader.php');
	echo $form;
}
?>