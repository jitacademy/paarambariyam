<?php
require "admin/includes/connect.php";
if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"])) 
{
	header('Location: ./index.php');
}
else
{	
if(isset($_SESSION['uid']) )
{
	 $uid  = $_SESSION['uid'];
	//$did  = $_SESSION['did'];	
	require('header.php');
?>
<body>
<?php
	require('topmenu.php');	
?>
<?php
if(isset($_POST['submit'])){
if(isset($_POST['password']) && isset($_POST['newpassword'])&& isset($_POST['confirmpassword']))
{	  
	//print_r($_POST);
	function test_input($data)
	{	
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
	}	
	$password = test_input($_POST['password']);
	$repassword = md5($_POST['password']);
	$newpassword = test_input($_POST['newpassword']);
	$confirmpassword = test_input($_POST['confirmpassword']);
	$passwordupdate = md5($confirmpassword);
	$success="";
	$error="";
	$status="ok";
	if($repassword=="" ||  $newpassword=="" ||   $confirmpassword==""  )
	{
		echo "YOU MISSED SOME FIELD";
	}	
	else
		{		
			$sql = "SELECT * FROM `users` WHERE `uid`='$uid'";
			$result = $con->query($sql);	 
			if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc()) {
				   $oldpassword =$row["password"];
			
			}}
			if ($oldpassword != $repassword) {
			$error .="Error... Invalid Password";
			$status = "NOTOK";
			}
			if ($newpassword != $confirmpassword) {
			$passerror .="Error... Passwords do not match";
			$status = "NOTOK";
			}	
			if($status == "ok")
			{	
				$query="UPDATE `users` SET `password`='".$passwordupdate."',`role`=2,`status`=1 WHERE `uid`='$uid'" ;
				$result = mysqli_query($con, $query);
				if($result)
				{
					 $success = "Your information saved successfully";	
				}
				else
				{
					 $error = "Sorry your information not saved".mysql_error();
				}
			}			
		}
}
else
{
	echo "PLEASE FILL ALL DETAILS";
}
}	
?>		
	<section>
	<div class="container-fluid paddingopx " style="background-color:#f5f5f5;">
	<div class="row" >			
	<div class="col-md-12"style="margin-bottom: 30px;">							
	<div class="col-md-6" style="background-color:white;margin-top:35px;">
	<?php
	if($success == "")
	{
	?>
	<h4 class="text-center fontsize24" >Update your account Password </h4>
	<div class="modal-body">
	<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
	<div style="color:red;"><?php echo $error;?></div><div style="color:green;"><?php echo $success;?></div>
	<div class="form-group">
	<input type="password" class="form-control inputreg" placeholder="Old Password *" name="password" id="password" required="required" value="<?php echo $password?>"/>
	</div>		
	<div class="form-group">
	<input type="password" class="form-control inputreg" placeholder="New Password *" name="newpassword" id="newpassword" required="required" value="<?php echo $newpassword?>"/>			
	</div>
	<div style="color:red;"><?php echo $passerror;?>
	<div class="form-group">
	<input type="password" class="form-control inputreg" placeholder="Confirm Password *" name="confirmpassword" id="confirmpassword" required="required" value="<?php echo $confirmpassword?>"/>
	</div>		
	<input type="submit" class="btn regbtn" value="UPDATE PASSWORD" name="submit"/>
	</form>
	</div>
	</div>
	<?php
	}
	else
	{
	?>
	<div class="container">
	<div style="color:green;"><?php echo $success;?></div>
	<a href="index.php"><button type="button" class="btn btn-success">HOME</button></a>
	</div>
	
	<?php
	}
	?>
	</div>
	</div>
	</div>
	</section>
	<div>
	<?php
	require('footer.php');
	?>
	</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php

}
}
?>