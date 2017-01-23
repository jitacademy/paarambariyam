<?php
require "admin/includes/connect.php";
if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"])) {
	header('Location: ./index.php');
} else {
require('header.php');
?>
<body>
  <?php
require('topmenu.php');		
  ?>
  <?php
	if(isset($_SESSION['uid']))
	{		
	$uid = $_SESSION['uid'];
	if($_SERVER["REQUEST_METHOD"]!="POST")
	{
	$sql = "SELECT * FROM `users` WHERE `uid`='$uid'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) 
	{
    while($row = $result->fetch_assoc()) {
      $name =  $row["name"];
	  $gender =  $row["gender"];
	  $email =  $row["email"];
	  $address1 =  $row["address1"];
	  $address2 =  $row["address2"];
	  $district =  $row["district"];
	  $state =  $row["state"];
	  $country =  $row["country"];
	  $pincode =  $row["pincode"];
	  $refid =  $row["refid"];
	  $phone = $row["phone"]; 
?>
<?php
	}
}
	}
	else{
		//print_r($_POST);
	if(isset($_POST['submit'])){
	if(isset($_POST['name']) && isset($_POST['email'])&& isset($_POST['phone']))
	{ 
	//print_r($_POST);
	function test_input($data)
	{
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
	}	
	$name = test_input($_POST['name']);
	$gender = test_input($_POST['gender']);
	$email = test_input($_POST['email']);
	$phone = test_input($_POST['phone']);
	$address1 = $_POST['address1'];
	$address2 = test_input($_POST['address2']);
	$district = test_input($_POST['district']);
	$state = test_input( $_POST['state']);	
	$country = test_input($_POST['country']);
	$pincode = test_input($_POST['pincode']);
	$refid = test_input($_POST['refid']);	
	$success="";
	$error="";
	$status="ok";
	if($name=="" ||  $email=="" ||   $phone==""  )
	{
		echo "YOU MISSED SOME FIELD";
	}	
	else
		{
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$name))
			{
			$error .= "Name field Only letters and whitespace allowed.<br>";
			$status = "NOTOK";
			}	
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$username))
			{
			$error .= "Name field Only letters and whitespace allowed.<br>";
			$status = "NOTOK";
			}
			$sql = "SELECT * FROM `users` WHERE `username`='".$username."'";
			$result = $con->query($sql);
			if ($result->num_rows > 0) 
			{
				$uerror .= "The username already exists.<br>";
				$status = "NOTOK";
			}
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$address1))
			{
			$error .= "Address1 field Only letters and whitespace allowed.<br>";
			$status = "NOTOK";
			}
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$address2))
			{
			$error .= "Address2 field Only letters and whitespace allowed.<br>";
			$status = "NOTOK";
			}
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$refid))
			{
			$error .= "Reference field Only letters and whitespace allowed.<br>";
			$status = "NOTOK";
			}
			if(!is_numeric($phone))
			{
			$error .="Phone No Should Be Numeric.<br>";
			$status="notok";
			}
			if(!is_numeric($pincode))
			{
			$error .="PinCode No Should Be Numeric.<br>";
			$status="notok";
			}
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
			 $error .="please enter email format.<br>";
			 $status="notok";	
			}	
			if($status == "ok")
			{	
				$query="UPDATE `users` SET `refid`='".$refid."',`gender`='".$gender."',`email`='".$email."',`name`='".$name."',`phone`='".$phone."',`address1`='".$address1."',`address2`='".$address2."',`district`='".$district."',`state`='".$state."',`country`='".$country."',`pincode`='".$pincode."',`role`=2,`status`=1 WHERE `uid`='$uid'" ;
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
	}
		}
		?>
	<section>
		<div class="container-fluid paddingopx" style="background-color:#f5f5f5;">
		<div class="row" >			
		<div class="col-md-12"style="margin-bottom: 30px;">
		<div class="col-md-6" style="background-color:white;margin-top:35px;">
		<h4 class="text-center fontsize24" >Update your account </h4>
		<div class="modal-body">
		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
		<div style="color:red;"><?php echo $error;?></div><div style="color:green;"><?php echo $success;?></div>
		<div class="form-group">
		<input type="text" class="form-control inputreg" placeholder="Full name *" name="name" id="name" required="required" value="<?php echo $name?>"/>
		</div>	
		<div class="form-group">
		<input type="email" class="form-control inputreg" placeholder="E-mail id *" name="email" id="email" required="required"value="<?php echo $email?>" /><div style="color:red;"><?php echo $eerror;?></div>
		</div>
		<div class="form-group">
		<input type="text" class="form-control inputreg" placeholder="Mobile *" name="phone" id="phone" required="required" value="<?php echo $phone?>"/><div style="color:red;"><?php echo $perror;?></div>
		</div>	
		<div class="form-group">
		<input type="radio" name="gender"  value="male" checked= 'checked'>Male
		<input type="radio" name="gender"  value="female" >Female
		</div>	
		<div class="form-group">
		<input type="text" class="form-control inputreg" placeholder="Address1" name="address1" id="address1" value="<?php echo $address1?>" />
		</div>
		<div class="form-group">
		<input type="text" class="form-control inputreg" placeholder="Address2" name="address2" id="address2" value="<?php echo $address2?>"/>
		</div>
		<div class="form-group">
		<select class="form-control col-md-7 col-xs-12 inputreg" name="district"  >
        <option value="0">Please Choose your District</option>
		<option value="Thanjavur"<?php if($district == 'Thanjavur') echo "selected= 'selected'";?>>Thanjavur</option>
		<option value="Thiruvarur"<?php if($district == 'Thiruvarur') echo "selected= 'selected'";?>>Thiruvarur </option>
		<option value="Trichy"<?php if($district == 'Trichy') echo "selected= 'selected'";?>>Trichy</option>
		<option value="Madurai"<?php if($district == 'Madurai') echo "selected= 'selected'";?>>Madurai</option>
        </select>		
		</div>	
		<div class="form-group">		
		<select class="form-control col-md-7 col-xs-12 inputreg" name="state"  >
        <option value="0">Please Choose your State</option>
		<option value="Tamilnadu"<?php if($state == 'Tamilnadu') echo "selected= 'selected'";?>>TamilNadu</option>
		<option value="Kerela"<?php if($state == 'Kerela') echo "selected= 'selected'";?>>Kerala </option>
		<option value="Andhra"<?php if($state == 'Andhra') echo "selected= 'selected'";?>>Andhra</option>
		<option value="Karanataka"<?php if($state == 'Karanataka') echo "selected= 'selected'";?>>Karanataka</option>
        </select>			
		</div>
		<div class="form-group">		
		<select class="form-control col-md-7 col-xs-12 inputreg" name="country"  >
        <option value="0">Please Choose your Country</option>
		<option value="India"<?php if($country == 'India') echo "selected= 'selected'";?>>India</option>
		<option value="Usa"<?php if($country == 'Usa') echo "selected= 'selected'";?>>Usa </option>
		<option value="Malaysia"<?php if($country == 'Malaysia') echo "selected= 'selected'";?>>Malaysia</option>
		<option value="Singapore"<?php if($country == 'Singapore') echo "selected= 'selected'";?>>Singapore</option>
        </select>		
		</div>
		<div class="form-group">
		<input type="text" class="form-control inputreg" placeholder="Pin Code" name="pincode" id="pincode" value="<?php echo $pincode?>"/>
		</div>
		<div class="form-group">
		<input type="text" class="form-control inputreg" placeholder="Reference code" name="refid" id="refid" value="<?php echo $refid?>"/>
		</div>
		<input type="submit" class="btn regbtn" value="UPDATE PROFILE" name="submit"/>
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
?>