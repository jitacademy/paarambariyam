<?php
include('admin/includes/connect.php');
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$pid = $_POST["pid"];
	$userid= $_POST["userid"];
	$sql = "INSERT INTO `whishlist`(`uid`, `pid`, `status`) VALUES ('".$userid."',".$pid.",1)";
	$result = $con->query($sql);
	if($result)
	{
		echo $data = $pid;
		return $data;
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
	header("login.php");
}
?>