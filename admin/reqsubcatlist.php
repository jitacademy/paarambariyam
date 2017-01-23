<?php
require "includes/connect.php";
if(isset($_POST['cat_id']))
{
	if($_POST['cat_id']!="")
	{
		$cat_id=$_POST['cat_id'];
		$query_select_district="SELECT  `subcat_id`, `subcategoryname` FROM `productsubcategory` WHERE `cat_id`=".$cat_id." AND `status` = 1";
		$query_fetch_dis = $con->query($query_select_district);
		if (!$query_fetch_dis)
		{
    		die('Invalid query: ' . $con->error);
		}
		if ($query_fetch_dis->num_rows > 0) 
		{
			$response = NULL;
			while($row = $query_fetch_dis->fetch_assoc()) 
			{
				//print_r($row);
				echo $response ="<option value=".$row['subcat_id'].">".$row['subcategoryname']."</option>";
			}
			return $response;
		} 
		
	}
}
?>