<?php
include('admin/includes/connect.php');
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
include('admin/includes/connect.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	$pid = $_GET["pid"];
	$userid = $_SESSION["uid"];
	$sql = "UPDATE `whishlist` SET `status`=2 WHERE `pid`=".$pid." AND `uid`='".$userid."'";
	$result = $con->query($sql);
	if($result)
	{
		header('Location:wishlist.php');
	}
	else
	{
		echo $data = $con->error;
		return $data;
	}
}
else
{
	
	return "failure";
}
}
else
{
	header("Location:login.php");
}
?>