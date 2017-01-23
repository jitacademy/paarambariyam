<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {
if($_SESSION["role"] == 1) {
if(isset($_SESSION["uid"]))
{	
$uid = $_GET["uid"];


include "static/head.php";	
include "static/sidebar.php";
include "static/header.php";
include "random.php";


$sql = "SELECT * FROM `users` WHERE `uid`='".$uid."'";

$result = $con->query($sql);
  
if ($result->num_rows > 0) {


    while($row = $result->fetch_assoc()) {
      $uid =  $row["uid"];
	  $refid =  $row["refid"];
	  $username =  $row["username"];
	  $gender =  $row["gender"];
	  $email =  $row["email"];
	  $name =  $row["name"];
	  $fileName =  $row["fileName"];
	  $phone =  $row["phone"];
	  $address1 =  $row["address1"];
	  $address2 =  $row["address2"];
	  $district =  $row["district"];
      $state =  $row["state"];
	  $country =  $row["country"];
	  $pincode =  $row["pincode"];
	  $status = $row["status"];
	  $role = $row["role"];	    
}

    }


?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> View Customer Information</h3>
			</div>
			<span style="float: right;"><a href="customers.php" class="btn btn-warning">Back</a></span>
</div>
             
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">

                      				<div><?php echo $error;?></div><div><?php echo $success;?></div>
						<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php 
							if($image=="")
							{
						 ?>
						 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;">Photo Unavailable</label>
						 <?php
						 }
						 else
						 {
						  ?>
						  <img src="uploads/user/<?php echo $fileName;?>">
						   <?php
						 }						 
						  ?>
                        </div>
                      </div>									
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Full Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php echo $name;?> </label>                          
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">User Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php echo $username;?> </label>                          
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gender 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php if($gender == 'male') echo "Male"; else echo "Female";?> 
                        </label>
                         </div>
                      </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php echo $email;?> </label>
                          
                        </div>
                      </div>
                     
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone Number 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php echo $phone;?> </label>
                          
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address 1
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name" style="text-align: left;width: 100%;"><?php echo $address1;?> </label>
                         
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address 2
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name" style="text-align: left;width: 100%;"><?php echo $address2;?> </label>
                        
                      </div>
					  </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">District 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						   <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: left;width: 100%;"><?php echo $district;?> </label>
                          
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pincode 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php echo $pincode;?> </label>
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: left;width: 100%;"><?php echo $state;?> </label>
                          
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Country 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: left;width: 100%;"><?php echo $country;?> </label>
                        
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reference Code 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php echo $refid;?> </label>

                        </div>
                      </div>
					  <div class="form-group">
					   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role 
                        </label>
						 <div class="col-md-6 col-sm-6 col-xs-12">
						  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;width: 100%;"><?php if($role == 2) echo "User"; else if($role == 3) echo "Distributer";?> </label>
						 </div>
					 </div>
					 <div class="form-group">
					 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status
                        </label>
						 <div class="col-md-6 col-sm-6 col-xs-12">
						  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"  style="text-align: left;width: 100%;"><?php if($status == 1) echo "Active"; else echo "In-Active";?> </label>
						</div>
					 </div>
					
					  
					  
					  
                      <div class="ln_solid"></div>
                      

                    </form>
                  </div>
                </div>
              </div>
            </div>

   </div>
            </div>




<?php
}
include "static/footer.php";

} else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>