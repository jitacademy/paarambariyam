<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{	
	if($_SESSION["role"] == 1) 
	{

		if(isset($_POST['pid']))
		{
			if($_POST['pid']!="")
			{
				$pid=$_POST['pid'];
				$query_update_feature="UPDATE `product` SET `isfeatured`=1 WHERE `pid`=".$pid."";
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