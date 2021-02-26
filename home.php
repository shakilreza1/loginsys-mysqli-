<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['mysession'])) 
{
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['mysession']);
$userRow=$query->fetch_array();
$DBcon->close();

?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['email']; ?></title>
<link rel="stylesheet" href="CSS/style.css" type="text/css" />
</head>
<body>
      <div>
         <a href="#">W3Schools.com</a>
        </div>
        <div>
          <ul>
            <li><a href="#">Back to Page</a></li>
            <li><a href="#">jQuery</a></li>
            <li><a href="#">PHP</a></li>
          </ul>
           </div>
           
          <div align="right">
          <ul>
          <li>&nbsp; <?php echo "<b>Welcome</b>". "&nbsp;". $userRow['username']; ?></a></li>
          <li><a href="logout.php?logout">&nbsp; Logout</a></li>
          <!--From this link logout is send ('logout') string to logout.php page  by using (? mark with logout (?logout)) (GET) method-->
          </ul>
        </div>
       
</body>
</html>