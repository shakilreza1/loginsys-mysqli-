<?php
session_start();

// If mysession is not empty then he/she will stay in home.php(Main Page). Means he/she still login there & no need to login or register again. 
if (isset($_SESSION['mysession'])!="") 
{
	header("Location: home.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
 {
	
	$uname = strip_tags($_POST['username']);
	$email = strip_tags($_POST['email']);
	$phone = strip_tags($_POST['phone']);
	$upass = strip_tags($_POST['password']);
	
	$uname = $DBcon->real_escape_string($uname);
	$email = $DBcon->real_escape_string($email);
	$phone = $DBcon->real_escape_string($phone);
	$upass = $DBcon->real_escape_string($upass);
	
	$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
	
	$check_email = $DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
	$count=$check_email->num_rows;
	
	if ($count==0) 
	{
		
		$query = "INSERT INTO tbl_users(username,email,phone,password) VALUES('$uname','$email','$phone','$hashed_password')";

		if ($DBcon->query($query)) 
		{
			$msg = "<div>
						<h5>Successfully registered !</h5>
					</div>";
		}
		else 
		{
			$msg = "<div>
						<span>Error while registering !</span>
					</div>";
		}
		
	}
	 else
	 {
		
		
		$msg = "<div>
					<span>Sorry email already taken&nbsp;&#33;&#33;</span>
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
        <h2>Register</h2>
    </div>
    <form method="post" id="register-form">

        <?php
		if (isset($msg))
		 {
			echo $msg;
		}
		?>

            <!-- ====================================== -->
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="btn-signup">Register</button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>Not yet a member? </p>
                </div>
                <div class="col-md-1">
                    <p class="center">
                    <a href="index.php"><strong></strong><strong></strong>Sign In</a>
                    </p>
                </div>
                <div class="col-md-5"></div>
            </div>
            <!-- ====================================== -->

    </form>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>