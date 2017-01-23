<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{	
	if($_SESSION["role"] == 1) 
	{
		if(isset($_POST['uid']))
		{
			if($_POST['uid']!="")
			{
				$uid=$_POST['uid'];
				$query_update_feature="UPDATE `users` SET `role`=2 WHERE `uid`='".$uid."'";
				$query_update_feature_run = $con->query($query_update_feature);
				if (!$query_update_feature_run)
				{
					die('Invalid query: ' . $con->error);
				}
				else
				{
					echo $response = "success";			
					return $response;
				} 
				
			}
		}
	}
}
?>