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
		if(isset($_SESSION['uid'])){		
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
		$refcode =  $row["refcode"];
		$phone = $row["phone"];
		$fileName = $row["fileName"];
	?>
<?php
	}
}
	}
	else{
	}
		}
		?>
	<section>
		<div class="container-fluid paddingopx " style="background-color:#f5f5f5;">
		<div class="row" >				
		<div class="col-md-12"style="margin-bottom: 30px;">
		<div class="profileviewcenter">
		<h4 class="text-center fontsize24" > Your Account Details</h4>
		<div class="modal-body">
		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
		<div class="form-group">
		<?php
		if($fileName != "")
		{
		?>
		<img src="admin/uploads/user/<?php echo $fileName;?>" class="img-circle" style="margin-left:100px;float:center;"/>
		<?php
		}
		?></div><div style="color:green;"><?php echo $success;?></div>
		<div class="form-group">
		<div class="inputreg">NAME : <?php echo $name;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">EMAIL : 	<?php echo $email;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">PHONE : <?php echo $phone;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">GENDER : <?php echo $gender;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">ADDRESS 1 : <?php echo $address1;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">ADDRESS 2 : <?php echo $address2;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">DISTRICT : <?php echo $district;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">STATE : <?php echo $state;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">COUNTRY : <?php echo $country;?></div>
		</div>
		<div class="form-group">
		<div class="inputreg">PINCODE : <?php echo $pincode;?></div>
		</div>
		<?php
		if($_SESSION["role"]==3){
			?>
		<div class="form-group">
		<div class="inputreg">REFERENCE CODE : <?php echo $refcode;?></div>
		</div>
		<?php }	?>
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