<?php
session_start();
require_once 'dbconnect.php';

// If mysession is not empty then it will go direct to home.php(Main Page).
if (isset($_SESSION['mysession'])!="")
 {
	header("Location: home.php");
	exit;
}

if (isset($_POST['btn-login']))
 {
	
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['password']);
	
	$email = $DBcon->real_escape_string($email);
	$password = $DBcon->real_escape_string($password);
	
	$query = $DBcon->query("SELECT user_id, email, password FROM tbl_users WHERE email='$email'");
	$row=$query->fetch_array();
	
	$count = $query->num_rows; // if email/password are correct returns must be 1 row
	
	if (password_verify($password, $row['password']) && $count==1) 
	{
		$_SESSION['mysession'] = $row['user_id'];
		header("Location: home.php");
	}
	 else 
	 {
		$msg = "<div>
					<span>Invalid Useremail or Password&nbsp;&#33;&#33;</span>
				</div>";
	}
	$DBcon->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

 <!-- External Style CSS-->
 <link rel="stylesheet" type="" href="style.css">
 <link rel="stylesheet" type="text/css" href="CSS/newstyle.css">
 


 
 
<title>Registration</title>
</head>
<body style="background-image: url(media/beach.jpg);
    background-position:top center;
    background-repeat: no-repeat;
    background-size: cover;">
        
    
   
    <div class="header">
		<h2>Login</h2>
	</div>
      
       <form  method="post" id="login-form">
      
        <?php
		if(isset($msg))
		{
            echo $msg;
       }
		?>
        <!-- ===================== -->
        <div class="input-group">
			<label>Username</label>
			<input type="email" name="email" placeholder="Email address" required>
		</div>
		
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" placeholder="Password" required>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="btn-login" id="btn-login">Login</button>
		</div>
		<div class="row">
		<div class="col-md-6">
		<p>Not yet a member? </p>
		</div>
		<div class="col-md-1">
		<p class="center">
			<a href="register.php"><strong></strong><strong></strong>Sign up</a>
		</p>
       </div>
       </div>
       <div class="col-md-5"></div>
       
        <!-- ===================== -->
      </form>

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>