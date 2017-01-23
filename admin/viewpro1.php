<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";

include "random_images_rename1.php";
if(isset($_GET['pid'])){
$pid = $_GET['pid'];
 $sql = "SELECT * FROM `product` WHERE `pid`='$pid'";
$result = $con->query($sql);
 
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) 
	{
		//print_r($row); 
       $pid =  $row["pid"];
	  $cat_id =  $row["cat_id"];
	  $sub_cat_id = $row["subcat_id"];
	  $pname =  $row["pname"];
	  $description =  $row["description"];
	  $price =  $row["price"];
	  $damount =  $row["damount"];
	  $qty =  $row["qty"];
	  $nofview =  $row["nofview"];
	  $available =  $row["available"];
	  $weight =  $row["weight"];
	  $litre = $row["litre"];
	  $pcode =  $row["pcode"];
	  $brand =  $row["brand"];
      $mandate =  $row["mandate"];
	  $expdate =  $row["expdate"];
	  $image =  $row["image"];
	  $image1 =  $row["image1"];
	  $image2 =  $row["image2"];
	  $samount = $row["saleprice"];
	  $prod_view = $row["prod_views"];	                          
}
    }
}
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>View Product</h3>
              </div>			  
			  <span style="float: right;"><a href="product.php" class="btn btn-warning">Back</a></span>
</div>
             
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $pname;?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Description 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left; width: 100%;"><?php echo $description;?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $price;?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Discount Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $damount;?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sale Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $samount;?></label>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="uploads/product/<?php echo $image;?>" style="width: 350px; height: 250px;">
                        </div>
                      </div>
					  					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image1</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="uploads/product/<?php echo $image1;?>" style="width: 350px; height: 250px;">
						  </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image2</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="uploads/product/<?php echo $image2;?>" style="width: 350px; height: 250px;">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Category Name
                        </label>
						<?php
						$cat_name_query = "SELECT  `catname` FROM `productcategory` WHERE `cat_id` = ".$cat_id."";
						$cat_name_query_run = $con->query($cat_name_query);
						$cat_name = $cat_name_query_run->fetch_assoc();
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $cat_name['catname'];?></label>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Sub Category Name</label>
						<?php
						$sub_cat_name_query = "SELECT `subcategoryname`FROM `productsubcategory` WHERE `subcat_id`=".$sub_cat_id."";
						$sub_cat_name_query_run = $con->query($sub_cat_name_query);
						$sub_cat_name = $sub_cat_name_query_run->fetch_assoc();
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $sub_cat_name['subcategoryname'];?></label>
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Qty</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $qty;?></label>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Code</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $pcode;?></label>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Available</label>
					  <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php if($available==1) echo "Available"; else "Not Available";?></label>
                        </div>
                      </div>
				
					  <?php
						if($weight !="")
						{
					  ?>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Weight</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $weight;?></label>
                        </div>
                      </div>
					  <?php
						}
						else
						{
					  ?>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Litre</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $litre;?></label>
                        </div>
                      </div>
					  <?php
						}
					  ?>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Brand Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $brand;?></label>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manf Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $mandate;?></label>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Exp Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $expdate;?></label>
                        </div>
                      </div>
					  
					   <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No of Times Views</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" style="text-align: left;"><?php echo $prod_view;?></label>
                        </div>
                      </div>
					  <div class="ln_solid"></div>
					  <div style="text-align: center;">
						<a href="product.php" class="btn btn-warning" >Back</a>
						<a href="index.php" class="btn btn-info" >Home</a>
					</div>
                    </form>
                  </div>
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