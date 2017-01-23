<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {



if($_SESSION["role"] == 1)
{
	$uid = $_SESSION["uid"];
	$role = $_SESSION["role"];
	include "static/head.php";
	include "static/sidebar.php";
	include "static/header.php";
?>
<div class="right_col" role="main">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Coupons List </h2>
					<div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table">					
                      <thead>						
                        <tr>
                          <th>#</th>
                          <th>Coupon Code</th>
						  <th>Coupon Name</th>
						  <th>Status</td>
                          <th>Action</th>						  
                        </tr>
                      </thead>
                      <tbody>
					  <?php
$sql = "SELECT `coupon_id`,`coupon_code`, `coupon_name`, `status` FROM `coupon` ORDER BY `coupon_id` DESC";
$result = $con->query($sql);
if ($result->num_rows > 0) 
{
	$i = 1;
    while($row = $result->fetch_assoc()) 
	{
		$coupon_id = $row['coupon_id'];
       $coupon_code =  $row["coupon_code"];
       $coupon_name = $row["coupon_name"];
       $status = $row["status"];
       
?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $coupon_code; ?></td>
			<td><?php echo $coupon_name; ?></td>
			<td><?php if($status == 1) echo "Active"; else echo "Inactive";?></td>
			<td>
				<a href="view_coup_code.php?coupon_id=<?php echo $coupon_id; ?>" class="btn btn-success">View</a>  
				<?php if($status == 1) 
				{
				?>
				<a href="delete_coup_code.php?coupon_id=<?php echo $coupon_id;?>" class="btn btn-danger" >Delete</a>
				<?php
				}
				else
				{
				?>
				<a href="activate_coup_code.php?coupon_id=<?php echo $coupon_id; ?>" class="btn btn-primary">Activate</a>
				<?php
				}
				?>
				<a href="edit_coup_code.php?coupon_id=<?php echo $coupon_id; ?>" class="btn btn-info">Edit</a>  
			</td>
		</tr>
<?php
	$i++;                        
	}
    }
?>                      </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</div>


<?php
include "static/footer.php";

} else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>
