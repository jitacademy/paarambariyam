<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {
if($_SESSION["role"] == 1) {

include "static/head.php";	
include "static/sidebar.php";
include "static/header.php";
include "random.php";


if(isset($_POST['submit'])){
	//print_r($_POST);

if(isset($_POST['name']) && isset($_POST['username'])&& isset($_POST['gender'])&& isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['role']) && isset($_POST['status']) && isset($_POST['username1']) && isset($_POST['email1']) && isset($_POST['phone1'])&& isset($_POST['uid']))
{
	//print_r($_POST);
	if($_FILES['fileName']['name']!="")
	{
		include "random_images_rename.php";
	}
	else
	{
		$image = $_POST['image'];
	}
	function test_input($data)
	{	
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
	}	
	$uid = test_input($_POST['uid']);
	$name = test_input($_POST['name']);
	$username = test_input($_POST['username']);
	$username1 = test_input($_POST['username1']);
	$email1 = test_input($_POST['email1']);
	$phone1 = test_input($_POST['phone1']);
	$gender = $_POST['gender'];
	$email = test_input($_POST['email']);
	if($password != "")
	{
		$password = $_POST['password'];
		$password = md5($password);
	}
	else
	{
		$password = $_POST['password1']	;
	}
	//$fileName = ($_POST['fileName']);
	
	$phone = test_input($_POST['phone']);
	if($_POST['address1'] !="")
	{
		$address1 = test_input($_POST['address1']);
	}
	if($_POST['address2'] !="")
	{
		$address2 = test_input($_POST['address2']);
	}
	if($_POST['district'] !="")
	{
		$district = $_POST['district'];
	}
	if($_POST['state'] !="")
	{
		$state =  $_POST['state'];
	}
	if($_POST['country'] !="")
	{
		$country = $_POST['country'];
	}
	if($_POST['pincode'] !="")
	{
		$pincode = test_input($_POST['pincode']);
	}
	if($_POST['refid'] !="")
	{
		$refid =test_input( $_POST['refid']);
	}
	$u_status = $_POST['status'];
	$role = $_POST['role'];
	$error="";
	$status="ok";
	if($name=="" || $username=="" || $gender=="" || $email=="" || $phone=="")
	{
		$error .= "YOU MISSED SOME FIELD";
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
			$error .= "Phone No Should Be Numeric.<br>";
			$status = "notok";
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
			if(!preg_match("/^[a-zA-Z0-9]*$/",$refid))
			{
				$error .= " Reference id field Only letters and numbers allowed.<br>";
				$status = "NOTOK";
			}
			if($username != $username1)
			{
				$sql = "SELECT * FROM `users` WHERE `username`='".$username."'";
				$result = $con->query($sql);
				if ($result->num_rows > 0) 
				{
					$uerror .= "The username already exists.<br>";
					$status = "NOTOK";
				}
				else if(strlen($username) < 6)
				{
					$uerror .= "The username must contain 6 characters.<br>";
					$status = "NOTOK";
				}
			}
			if($email != $email1)
			{
				$sql = "SELECT * FROM `users` WHERE `email`='".$email."'";
				$result = $con->query($sql);

				if ($result->num_rows > 0) 
				{
					$eerror .= "The email already exists.<br>";
					$status = "NOTOK";
				}
			}
			if($phone != $phone1)
			{
				$sql = "SELECT * FROM `users` WHERE `phone`='".$phone."'";
				$result = $con->query($sql);

				if ($result->num_rows > 0) 
				{
					$perror .= "The phone no already exists.<br>";
					$status = "NOTOK";
				}
			}
			//echo status;
			//echo $error;
			if($status == "ok")
			{ 
				  
				
			
				$query = "UPDATE `users` SET `refid`='".$refid."',`username`='".$username."',`gender`='".$gender."',`password` = '".$password."',`email`='".$email."',`name`='".$name."',`fileName`='".$image."',`phone`='".$phone."',`address1`='".$address1."',`address2`='".$address2."',`district`='".$district."',`state`='".$state."',`country`='".$country."',`pincode`='".$pincode."',`role`=".$role.",`status`=".$u_status." WHERE `uid`='".$uid."'";
				$result = mysqli_query($con, $query);
				
				if($result)
				{
					
					$success = "Your information Updated successfully";
					
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
                <h3>Edit Customers</h3>
              </div>
</div>
            <span style="float: right;"><a href="customers.php" class="btn btn-warning">Back</a></span>
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
                    
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
						<div class="alert alert-success"><?php echo $success;?></div>
					<?php
					}
					?>
					<?php
					//print_r($_POST);
					if($success == "" )
					{
					?>
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
					<?php
						if(isset($_GET['uid']))
						{
						$uid = $_GET['uid'];
						$query_cus = "SELECT `uid`, `refid`, `username`, `gender`, `password`, `email`, `name`, `fileName`, `phone`, `address1`, `address2`, `district`, `state`, `country`, `pincode`, `role`, `status` FROM `users` WHERE `uid`= '".$uid."'";
						$query_cus_res = $con->query($query_cus);
						if($query_cus_res->num_rows == 1)
						{							
							$row = $query_cus_res->fetch_assoc();
							$uid = $row['uid'];
							$name = $row['name'];
							$username = $row['username'];
							$gender = $row['gender'];
							$email = $row['email'];
							$phone = $row['phone'];
							$password = $row['password'];
							$image = $row['fileNames'];
							$address1 = $row['address1'];
							$address2 = $row['address2'];
							$pincode = $row['pincode'];
							$district = $row['district'];
							$state = $row['state'];
							$country = $row['country'];
							$refid = $row['refid'];
							$status = $row['status'];
							$role = $row['role'];
							
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
						  <input type="hidden" name="username1" value="<?php echo $username;?>">
						   <input type="hidden" name="uid" value="<?php echo $uid;?>">
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
						  <input type="hidden" name="email1" value="<?php echo $email;?>">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="password" class="form-control col-md-7 col-xs-12" value="" placeholder="Password"><div style="color:red;"><?php echo $eerror;?></div>
						  <div style="background: blanchedalmond; padding: 1px;"><strong>Note:</strong>Please enter your password if you want to change otherwise leave this field it will store old Password</div>
						  <input type="hidden" name="password1" value="<?php echo $password;?>">
						</div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<?php
						if($image != "")
						{
						?>
						<img src="uploads/user/<?php echo $image;?>" width="256px" height="256px">
						<?php
						}
						?>
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="fileName">
						  <input type="hidden" name="image" value="<?php echo $image;?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="phone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $phone;?>"placeholder="Phone Number"><div style="color:red;"><?php echo $perror;?></div>
						  <input type="hidden" name="phone1" value="<?php echo $phone;?>">
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
                         <input type="text" name="district"  class="form-control col-md-7 col-xs-12" value="<?php echo $district?>"placeholder="Enter your District name">
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						 <input type="text" name="state"  class="form-control col-md-7 col-xs-12" value="<?php echo $state?>"placeholder="Enter your State name"> 
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="country"  class="form-control col-md-7 col-xs-12" value="<?php echo $country;?>"placeholder="Enter your Country name"> 
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reference Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="refid" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $refid?>"placeholder="Reference Code">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="role" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $role?>">
						    <option>Please choose user Role</option>
							<option value="3" <?php if($role ==3) echo "selected='selected'"; else echo "";?>>Distributer</option>
							<option value="2" <?php if($role ==2) echo "selected='selected'"; else echo "";?> >User</option>
						  </select>
                        </div>
                      </div>
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="status" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $status?>">
						    <option>Please choose user status</option>
							<option value="1" <?php if($status == 1) echo "selected='selected'"; else echo "";?>>Active</option>
							<option value="2" <?php if($status == 2) echo "selected='selected'"; else echo "";?> >InActive</option>
						  </select>
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
					<?php
					
					}
					
					?>
					
					<?php
						}
					else
					{
					?>
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
					
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
						  <input type="hidden" name="username1" value="<?php echo $username;?>">
						  <input type="hidden" name="uid" value="<?php echo $uid;?>">
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
						  <input type="hidden" name="email1" value="<?php echo $email;?>">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="password" class="form-control col-md-7 col-xs-12" value="" placeholder="Password"><div style="color:red;"><?php echo $eerror;?></div>
						  <div style="background: blanchedalmond; padding: 1px;"><strong>Note:</strong>Please enter your password if you want to change otherwise leave this field it will store old Password</div>
						  <input type="hidden" name="password1" value="<?php echo $password;?>">
						</div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<?php
						if($image != "")
						{
						?>
						<img src="uploads/user/<?php echo $image;?>" width="256px" height="256px">
						<?php
						}
						?>
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="fileName">
						  <input type="hidden" name="image" value="<?php echo $image;?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="phone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $phone;?>"placeholder="Phone Number"><div style="color:red;"><?php echo $perror;?></div>
						  <input type="hidden" name="phone1" value="<?php echo $phone;?>">
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
                         <input type="text" name="district"  class="form-control col-md-7 col-xs-12" value="<?php echo $district?>"placeholder="Enter your District name">
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						 <input type="text" name="state"  class="form-control col-md-7 col-xs-12" value="<?php echo $state?>"placeholder="Enter your State name"> 
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="country"  class="form-control col-md-7 col-xs-12" value="<?php echo $country;?>"placeholder="Enter your Country name"> 
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reference Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="refid" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $refid?>"placeholder="Reference Code">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="role" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $role?>">
						    <option>Please choose user Role</option>
							<option value="3" <?php if($role ==3) echo "selected='selected'"; else echo "";?>>Distributer</option>
							<option value="2" <?php if($role ==2) echo "selected='selected'"; else echo "";?> >User</option>
						  </select>
                        </div>
                      </div>
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="status" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $status?>">
						    <option>Please choose user status</option>
							<option value="1" <?php if($status == 1) echo "selected='selected'"; else echo "";?>>Active</option>
							<option value="2" <?php if($status == 2) echo "selected='selected'"; else echo "";?> >InActive</option>
						  </select>
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
					<?php
					}
					}
					?>
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