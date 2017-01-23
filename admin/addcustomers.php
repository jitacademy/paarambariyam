<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {
if($_SESSION["role"] == 1) {
$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";	
include "static/sidebar.php";
include "static/header.php";
include "random.php";


if(isset($_POST['submit'])){

if(isset($_POST['name']) && isset($_POST['username'])&& isset($_POST['gender'])&& isset($_POST['email'])&& isset($_POST['password']) && isset($_POST['phone'])&& isset($_POST['address1'])&& isset($_POST['address2'])
	&& isset($_POST['district'])&& isset($_POST['state'])&& isset($_POST['country'])&& isset($_POST['pincode'])&& isset($_POST['refid']))
{
	//print_r($_POST);
	if($_FILES['fileName']['name']!="")
	{
		include "random_images_rename.php";
	}
	function test_input($data)
	{	
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
	}	
	$name = test_input($_POST['name']);
	$username = test_input($_POST['username']);
	$gender = $_POST['gender'];
	$email = test_input($_POST['email']);
	$password = $_POST['password'];
	$repassword = md5($password);
	//$fileName = ($_POST['fileName']);
	
	$phone = test_input($_POST['phone']);
	$address1 = test_input($_POST['address1']);
	$address2 = test_input($_POST['address2']);
	$district = $_POST['district'];
	$state =  $_POST['state'];	
	$country = $_POST['country'];
	$pincode = test_input($_POST['pincode']);
	$refid =test_input( $_POST['refid']);
	$rand = randomString(6);
	$refcode = randomString(8);
	$error="";
	$status="ok";
	if($name=="" || $username=="" || $gender=="" || $email=="" ||  $password==""||   $phone==""  || $refid==""  )
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
				$error .= "User Name field Only letters and whitespace allowed.<br>";
				$status = "NOTOK";
			}	
			if(!is_numeric($phone))
			{
			$error .="Phone No Should Be Numeric.<br>";
			$status="notok";
			}
			if($pincode != "")
			{
				if(!is_numeric($pincode))
				{
				$error .="Pincode No Should Be Numeric.<br>";
				$status="notok";
				}
			}
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
			 $error .="please enter email format.<br>";
			 $status="notok";	
			}	
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$address1))
			{
				$error .= "Address 1 field Only letters and whitespace allowed.<br>";
				$status = "NOTOK";
			}	
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$address2))
			{
				$error .= "Address 2 field Only letters and whitespace allowed.<br>";
				$status = "NOTOK";
			}	
			if(!preg_match("/^[a-zA-Z0-9]*$/",$refid))
			{
				$error .= " Reference id field Only letters and numbers allowed.<br>";
				$status = "NOTOK";
			}
			$sql = "SELECT * FROM `users` WHERE `username`='".$username."'";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				$uerror .= "The username already exists.<br>";
				$status = "NOTOK";
			}
			$sql = "SELECT * FROM `users` WHERE `email`='".$email."'";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				$eerror .= "The email already exists.<br>";
				$status = "NOTOK";
			}
			$sql = "SELECT * FROM `users` WHERE `phone`='".$phone."'";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				$perror .= "The phone no already exists.<br>";
				$status = "NOTOK";
			}
			
			if($status == "ok")
			{ 
				  
				
			
				$query = "INSERT INTO `users`(`uid`,`refid`,`refcode`, `username`, `password`,`fileName`,`email`, `name`, `gender`,`phone`, `address1`, `address2`, `district`, `state`, `country`, `pincode`, `regtime`, `lastlogin`, `role`, `status`) VALUES ('".$rand."','".$refid."','".$refcode."','".$username."','".$repassword."','".$image."','".$email."','".$name."','".$gender."','".$phone."','".$address1."','".$address2."','".$district."','".$state."','".$country."','".$pincode."',CURTIME(),CURTIME(),2,1)";
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

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Customers</h3>
              </div>
</div>
            <span style="float: right;"><a href="customers.php" class="btn btn-warning">Back</a></span>
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
					<?php
					if($error !="")
					{
					?>
						<div style="color:red;"><?php echo $error;?></div>
					<?php
					}
					if($success !="")
					{
					?>
						<div style="color:green;"><?php echo $success;?></div>
					<?php
					}
					?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Full Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $name?>"placeholder="Name">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="username" required="required" class="form-control col-md-7 col-xs-12"value="<?php echo $username?>"placeholder="Username"><div style="color:red;"><?php echo $uerror;?></div>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gender <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" name="gender" required="required" value="male" <?php if($gender == 'male') echo "checked= 'checked'";?>>Male
						  <input type="radio" name="gender" required="required" value="male" <?php if($gender == 'female') echo "checked= 'checked'";?>>Female

                        </div>
                      </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $email?>"placeholder="E-mail"><div style="color:red;"><?php echo $eerror;?></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" name="password" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $password?>"placeholder="Password">
                        </div>
                      </div>

                      

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="fileName">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="phone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $phone?>"placeholder="Phone Number"><div style="color:red;"><?php echo $perror;?></div>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address 1
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="address1"  class="form-control col-md-7 col-xs-12"value="<?php echo $address1?>"placeholder="Address 1">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address 2
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="address2"  class="form-control col-md-7 col-xs-12"value="<?php echo $address2?>" placeholder="Address 2">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pincode 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="pincode"  class="form-control col-md-7 col-xs-12" value="<?php echo $pincode?>"placeholder="Pincode">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">District 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="district"  >
                          <option value="0">Please Choose your District</option>
						<option value="Thanjavur"<?php if($district == 'Thanjavur') echo "selected= 'selected'";?>>Thanjavur</option>
						<option value="Thiruvarur"<?php if($district == 'Thiruvarur') echo "selected= 'selected'";?>>Thiruvarur </option>
						<option value="Trichy"<?php if($district == 'Trichy') echo "selected= 'selected'";?>>Trichy</option>
						<option value="Madurai"<?php if($district == 'Madurai') echo "selected= 'selected'";?>>Madurai</option>
						  
						  
                           </select>
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="state"  >
                          <option value="0">Please Choose your State</option>
												<option value="Tamilnadu"<?php if($state == 'Tamilnadu') echo "selected= 'selected'";?>>TamilNadu</option>
						<option value="Kerela"<?php if($state == 'Kerela') echo "selected= 'selected'";?>>Kerala </option>
						<option value="Andhra"<?php if($state == 'Andhra') echo "selected= 'selected'";?>>Andhra</option>
						<option value="Karanataka"<?php if($state == 'Karanataka') echo "selected= 'selected'";?>>Karanataka</option>
                           </select> 
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="country"  >
                          <option value="0">Please Choose your Country</option>
						<option value="Tamilnadu"<?php if($country == 'Tamilnadu') echo "selected= 'selected'";?>>India</option>
						<option value="Usa"<?php if($country == 'Usa') echo "selected= 'selected'";?>>Usa </option>
						<option value="Malaysia"<?php if($country == 'Malaysia') echo "selected= 'selected'";?>>Malaysia</option>
						<option value="Singapore"<?php if($country == 'Singapore') echo "selected= 'selected'";?>>Singapore</option>
						  
						  
                           </select>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reference Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="refid" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $refid?>"placeholder="Reference Code">
                        </div>
                      </div>
					  
					  
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="addproduct.php" class="btn btn-primary">Cancel</a>
                          <input type="submit" class="btn btn-success" name="submit" value="Submit">
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

   </div>
            </div>




<?php
include "static/footer.php";

} else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>