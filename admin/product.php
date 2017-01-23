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
                    <h2>Product List </h2>
                    
                        
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Product Name</th>
                          <th>Amount</th>
						  <th>Quantity</th>
                          <th>Action</th>
						  <th>Is Feauture</th>
						  <th> <a href="addproduct.php" class="btn btn-warning"> Add Product</a></th>
                        </tr>
                      </thead>
                      <tbody>

<?php

$sql = "SELECT `pid`, `pname`, `saleprice`,`qty`, `isfeatured`, `status` FROM `product`";

$result = $con->query($sql);

if ($result->num_rows > 0) {
   

    while($row = $result->fetch_assoc()) {
		//print_r($row);
       $pid =  $row["pid"];
       $pname = $row["pname"];
       $price = $row["saleprice"];
       $status = $row["status"];
	   $qty = $row["qty"];
	   $feature = $row["isfeatured"];
?>
                        <tr>
                          <td><?php echo $pid; ?></td>
                          <td><?php echo $pname; ?></td>
                          <td><?php echo $price; ?></td>
                          <td><?php echo $qty; ?></td>
                          <td>
							  <a href="viewpro1.php?pid=<?php echo $pid; ?>" class="btn btn-success">View</a> 
							  <a href="editpro_check.php?pid=<?php echo $pid; ?>" class="btn btn-info">Edit</a>
							  <?php 
							  if($status == 1)
							  {
							  ?>
								<a href="deleteprod.php?pid=<?php echo $pid; ?>" class="btn btn-danger">Delete</a>
							  <?php
							  }
							  else
							  {
							  ?>
							  <a href="activateprod.php?pid=<?php echo $pid; ?>" class="btn btn-primary">Activate</a>
							  <?php
							  }
							  ?>
						  </td>
						  <td>
							<input type="checkbox" name="feature" value = "<?php echo $pid; ?>" <?php if($feature == 1) echo "checked = 'checked'"?> class="feuture" id="<?php echo $pid; ?>"/>
						  </td>
                        </tr>
<?php                     
}

    }
?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
</div>
</div>
<script>
$(document).ready(function(){
    $(".feuture").click(function(){
		$val = $(this).attr("value");
		//alert($val);
		if($(this).is(':checked'))
		{
			$.ajax({
			url: "setfeature.php",
			type: "POST",
			data:{pid: $val},
			success: function(response){
				//$("#sub_cat").html(response);
				console.log(response);
			},
			error: function(response){
				console.log("failure");
			}
			});
		}
		else
		{
			$.ajax({
			url: "unsetfeature.php",
			type: "POST",
			data:{pid: $val},
			success: function(response){
				//$("#sub_cat").html(response);
				console.log(response);
			},
			error: function(response){
				console.log("failure");
			}
			});
		}
    });
});
</script>
<?php
include "static/footer.php";

} else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>