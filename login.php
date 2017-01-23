<?php
require "admin/includes/connect.php";
if(!isset($_SESSION['uid']) || !isset($_SESSION['uid']))
{
	require('header.php');
if(isset($_POST['email']) && isset($_POST['pass']))
{
	$error = "";
	$status_ok = "OK";
	function test_input($data)
	{
		
		$data = trim($data);
		$data = stripslashes($data);
		return $data;
	}
	$email = test_input($_POST['email']);
	$pass = test_input($_POST['pass']);
	if($email=="" && $pass=="")
	{
		$error .= "Please Fill Email and Password Field";
		$status_ok = "NOTOK";
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	    $error .= "Invalid email format";
		$status_ok = "NOTOK";
	}
	$uname = htmlspecialchars($_POST['email']);
	$password =$_POST['pass'];
	$pass_hash = md5($password);
	if($status_ok == "OK")
	{
		$sql = "SELECT `uid`,  `role`, `status` FROM `users` WHERE `email` = '".$uname."' AND `password` = '".$pass_hash."'";
		$result = $con->query($sql);
		if ($result->num_rows == 1) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$uid =  $row["uid"];
				$role = $row["role"];
				$status =  $row["status"];
				if($status == 1 && $role == 2) 
				{
					$_SESSION["uid"] = $row["uid"];
					$_SESSION["role"] = $row["role"];
					header('Location: index.php');
				}
				else if($status == 1 && $role == 3) 
				{
					$_SESSION["uid"] = $row["uid"];
					$_SESSION["role"] = $row["role"];
					header('Location: index.php');
				}
			}
		}
		else
		{
			$error = "Sorry Your Username or Password Incorrect. <br> Please Try Again.";
		}
	}	
}
?>
  <body>

  <?php
		require('topmenu.php');
		?>
    <div class="container-fluid paddingopx">
	<section>
			<div class="row">
				<div class="col-md-12"style="margin-bottom: 30px; margin-top: 33px;background: #f5f5f5;">
				<div class="loginouter">
					<div class="loginrow" style="text-align: center;">
						<img class="" src="img/smalllogowhite.jpg">
					</div>
					<div class="loginrow">
						<div style="font-size: 20px;text-align: center;padding-bottom: 5px;">Good for Nature, Good for you</div>
						<div style="font-size: 13px; text-align: center; padding-bottom: 5px;">Get started to lead a more organic life style</div>
					</div>
					<?php
					if($error!="")
					{
					?>
					<div class="loginrow">
						<div class="alert-danger padding15px">
							<?php echo $error;?>
						</div>
					</div>
					<?php
					}
					?>
					<form name="loginform" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<div class="fullrowlogin">
							<div class="loginrow">
								<input type="email" name="email" class="logininput" placeholder="Email" />								
							</div>
							<div class="loginrow">
									<input type="password" name="pass" class="logininput" placeholder="Password"/>								
							</div>
							<div class="loginrow" style="text-align: center;">
								<input type="submit" value="LOGIN" name="submit" class="btnsumit" style="width: 100%; padding: 8px;"/>
							</div>
						</div>
					</form>
					<div class="modal-bottom-login">
						<p><a href="forgetpassword.php">Forget password?</a></p>
						<p><span class="modal-login-signp">Dont have an account?  </span><a href="signup.php" class="modal-login-sign">Get started</a></p>
					  </div>
				</div>
				</div>
			</div>
	</section>
	
</div>
<?php
	require('footer.php');
	?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	
	
	<script src="js/price-range.js"></script>
	<script src="js/main.js"></script>
  </body>
</html>
<?php
}
else
{
	header("Location:index.php");
}
?>