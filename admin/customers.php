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
                    <h2>Customers List </h2>
                    
                    <span style="float: right; margin-right: 20px;"><a href="addcustomers.php" class="btn btn-warning">Add Customers</a></span>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>User Id</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Distributer</th>
						  <th>Action</th>
						 
                        </tr>
                      </thead>
                      <tbody>

<?php

$sql = "SELECT * FROM `users` WHERE `role` != 1";

$result = $con->query($sql);

if ($result->num_rows > 0) {
   

    while($row = $result->fetch_assoc()) {
       $uid =  $row["uid"];
       $name = $row["name"];
       $phone = $row["phone"];
       $email = $row["email"];
       $district= $row["district"];
       $role= $row["role"];
       $status =  $row["status"];
?>
                        <tr>
                          <th scope="row"><?php echo $uid; ?></th>
                          <td><?php echo $name; ?></td>
                          <td><?php echo $phone; ?></td>
                          <td><?php echo $email; ?></td>
                          <td><?php if($status == 1) echo "Active"; else if($status == 2) echo "InActive"; ?></td>
						  <td><input type="checkbox" name="add_dist" value = "<?php echo $uid; ?>" <?php if($role == 3) echo "checked = 'checked'"?> class="distributer" id="<?php echo $uid; ?>"/></td>
                          <td><a href="viewus1.php?uid=<?php echo $uid; ?>" class="btn btn-success">View</a><a href="edit_customer.php?uid=<?php echo $uid; ?>" class="btn btn-primary">Edit</a><a href="deleteuser.php?uid=<?php echo $uid; ?>" class="btn btn-danger">Delete</a></td>
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
    $(".distributer").click(function(){
		$val_dist = $(this).attr("value");
		//alert($val);
		if($(this).is(':checked'))
		{
			$.ajax({
			url: "setdistributer.php",
			type: "POST",
			data:{uid: $val_dist},
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
			url: "unsetdistributer.php",
			type: "POST",
			data:{uid: $val_dist},
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