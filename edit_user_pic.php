<?php
require "admin/includes/connect.php";
if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"]))
{
	header('Location: ./index.php');
} 	else {
	require('header.php');
	if(isset($_SESSION['uid'])){
	$uid  = $_SESSION['uid'];
	//$did  = $_SESSION['did'];
	$sql = "SELECT * FROM `users` WHERE `uid`='$uid'";
	$result = $con->query($sql); 
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc())
		{
		$uid =  $row["uid"];
		$_SESSION["fileName"] = $row["fileName"];
		$image = $_SESSION["fileName"];
		}
	}
?>
<body>
<?php
	require('topmenu.php');		
?>
<?php		
//print_r($_POST);
//print_r($_FILES);
if(isset($_POST['submit']))
{
		$success="";
		$error="";
		$status="ok";		
		if ($_FILES['fileName']['size'] == 0 && $_FILES['fileName']['name'] == "")
		{
			$image = $_SESSION["fileName"];
		}
		else
		{
			include "random_images.php";
		}			
		if($status == "ok")
		{	
		$query="UPDATE `users` SET `fileName`='".$image."',`status`=1  WHERE `uid`='$uid'" ;
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
?>	
<section>
	<div class="container-fluid paddingopx" style="background-color:#f5f5f5;">
			<div class="row row2">
			<div class="col-md-12"style="margin-bottom: 30px;">
			<h4 class="text-center fontsize24" >Update your Profile Picture <span style="float:right"><a href="myaccount.php" class="btn btn-success">BACK</a></span></h4>
			<div style="margin: auto; width: 50%; border: 1px none black; background: white none repeat scroll 0% 0%; padding: 45px; border-radius: 13px;">
			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
				<div style="color:red;"><?php echo $error;?></div><div style="color:green;"><?php echo $success;?></div>
				<div class="form-group">
				<?php 
				if($image !="")
				{
				?>
				<div><img src="admin/uploads/user/<?php echo $image;?>" class="img-circle" style="margin-left:100px;float:center;"/></div>
				<?php
				}
				?>
				<label>Upload image</label>
				<input  class="form-control" type="file"  name="fileName" style="margin-bottom: 25px;"/>
				</div>	
				<input type="submit" class="btn regbtn" value="UPDATE PICTURE" name="submit" />
			</form>
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