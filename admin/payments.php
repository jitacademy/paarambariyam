<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {



 if($_SESSION["role"] == 1) {

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
                    <h2>Distributer Payment List </h2>
                    
                        
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Request ID</th>
                          <th>User ID</th>
						  <th>Amount</th>						  
                          <th>Status</th>
						</tr>
                      </thead>
                      <tbody>

<?php

$sql = "SELECT `rid`, `uid`, `amount`, `status` FROM `requestpayment` ORDER BY rid DESC";

$result = $con->query($sql);

if ($result->num_rows > 0) 
{
	$i=1;
    while($row = $result->fetch_assoc()) {
		//print_r($row);
       $rid =  $row["rid"];
       $uid = $row["uid"];
       $amount = $row["amount"];
       $status = $row["status"];
?>
                        <tr>
							<td><?php echo $i; ?></td>
                          <td><?php echo $rid; ?></td>
                          <td><?php echo $uid; ?></td>
                          <td><?php echo $amount; ?></td>
                          <td>
							  <?php 
							  if($status == 1)
							  {
							  ?>
								<a href="paydistributer.php?rid=<?php echo $rid; ?>" class="btn btn-success">PAY</a>
							  <?php
							  }
							  else if($status == 2)
							  {
							  ?>
							  <a href="#" class="btn btn-primary">COMPLETED</a>
							  <?php
							  }
							  ?>
						  </td>
						  
                        </tr>
<?php
$i++;                
}

    }
	else
	{
		echo "<div class='alert alert-info'>No Rows Selected</div>";
	}
?>
                      </tbody>
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