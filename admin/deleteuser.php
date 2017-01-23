<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	if($_SESSION["role"] == 1) 
	{
	include "static/head.php";	
	include "static/sidebar.php";
	include "static/header.php";
	//include "random.php";
	if(isset($_GET['uid']))
	{
		if($_GET['uid'] !="")
		{
			$uid = $_GET['uid'];
			$query_delete_user = "UPDATE `users` SET `status`=2 WHERE `uid`='".$uid."'";
			$query_delete_res = $con->query($query_delete_user);
			if($query_delete_res)
			{
				$success = "You are successfully deleted this user";
			}
			else
			{
				$error = "Sorry there is problem to delete this user".$con->error();				
			}
		}
	}
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Delete Customers</h3>
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
						<div class="alert alert-danger"><?php echo $error;?></div>
					<?php
					}
					if($success !="")
					{
					?>
						<div class="alert alert-success"><?php echo $success;?></div>
					<?php
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

} 
else
{
	header('Location: ./index.php');
}
} 
else 
{
	header('Location: login.php');
}
?>