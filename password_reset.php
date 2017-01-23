<?php
require "admin/includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	header('Location: ./index.php');
}
else
{	
	if(isset($_GET['email']) && $_GET['forgetpass'])
	{
		$email  = $_GET['email'];
		$forgetpass  = $_GET['forgetpass'];
		$sql = "SELECT * FROM `users` WHERE email='$email' AND forgetpass='$forgetpass'";
		$result = $con->query($sql);	 
			if ($result->num_rows > 0) 
			{
				while($row = $result->fetch_assoc()) {
				   $email =$row["email"];
				   $forgetpass =$row["forgetpass"];
			
			}
			
		
		}	
else{
header('Location: ./index.php');
}
require('header.php');
require('topmenu.php');
?>
<body>
	<section>
	<div class="container-fluid paddingopx" style="background-color:#f5f5f5;">
	<div class="row" >			
	<div class="col-md-12"style="margin-bottom: 30px;">							
	<div class="col-md-6" style="background-color:white;margin-top:35px;">
	<h4 class="text-center fontsize24" >Update your account Password </h4>
	<div class="modal-body">
	<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="pass_success.php" method="POST">
	<div style="color:green;"><?php echo $success;?></div>		
	<div class="form-group">
	<input type="password" class="form-control inputreg" placeholder="New Password *" name="newpassword" id="newpassword" required="required" value="<?php echo $newpassword?>"/>			
	</div>
	<input type="hidden" name="email" value="<?php echo $email;?>"/>
	<div style="color:red;"><?php echo $passerror;?></div>
	<div class="form-group">
	<input type="password" class="form-control inputreg" placeholder="Confirm Password *" name="confirmpassword" id="confirmpassword" required="required" value="<?php echo $confirmpassword?>"/>
	</div>		
	<input type="submit" class="btn regbtn" value="UPDATE PASSWORD" name="submit"/>
	</form>
	</div>
	</div>
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