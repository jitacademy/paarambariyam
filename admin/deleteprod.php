<?php
require "includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	if($_SESSION["role"] == 1) 
	{
		include "static/head.php";
		include "static/sidebar.php";
		include "static/header.php";
		if($_GET['pid']!="")
		{
			$pid = $_GET['pid'];
			$del_prod_query = "UPDATE `product` SET `status`=2 WHERE `pid` = ".$pid."";
			$del_prod_query_run = $con->query($del_prod_query);
			if($del_prod_query_run)
			{
				$success_delete = "You have Deleted Product Successfully";
			}
			else
			{
				echo "Sorry".$con->error;
			}
		}
	}
}
?>
<div class="right_col" role="main" style="padding: 134px 15px 18px 15px;">
	<div class="alert alert-success">
		<?php echo $success_delete;?>		
	</div>
	<a href="product.php" class="btn btn-warning" >Back</a>
	<a href="index.php" class="btn btn-info" >Home</a>
</div>
<?php
	include "static/footer.php";
?>