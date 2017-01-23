<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {

if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";

//include "random_images_rename1.php";


if(isset($_POST['submit'])){
if(isset($_POST['pname']) && isset($_POST['description'])&& isset($_POST['price'])&& isset($_POST['damount']) && isset($_POST['cat_id']) && isset($_POST['subcat_id']) && isset($_POST['qty'])
	&& isset($_POST['available']) && isset($_POST['pcode']) && isset($_POST['brand']) && isset($_POST['mandate']) && isset($_POST['expdate']))
{
	 
	//print_r($_POST);
	function test_input($data)
	{
		
		$data = trim($data);
		$data = stripslashes($data);
		return $data;
	}
	function generateFileName()
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789_";
		$name = "";
		for($i=0; $i<12; $i++)
		$name.= $chars[rand(0,strlen($chars))];
		return $name;
	}
	$error="";
	$pid = $_POST['pid'];
	$pname = test_input($_POST['pname']);
	$description = test_input($_POST['description']);
	$price = test_input($_POST['price']);
	$damount = test_input($_POST['damount']);
	$prod_cat_id = test_input($_POST['cat_id']);
	$prod_sub_id = test_input($_POST['subcat_id']);
	$qty =test_input( $_POST['qty']);
	$available =test_input( $_POST['available']);
	$weight =test_input( $_POST['weight']);
	$litre = test_input($_POST['litre']);
	$pcode =test_input( $_POST['pcode']);
	$brand =test_input( $_POST['brand']);
	$mandate =test_input( $_POST['mandate']);
	$expdate =test_input( $_POST['expdate']);
	$samount = test_input($_POST['samount']);
	$stat = $_POST['stat'];
	$success="";
	$status="ok";
	if($pname=="" || $description=="" || $price=="" || $prod_cat_id=="" || $prod_sub_id=="" || $damount=="" || $samount == "" || $qty=="" || $available == "" || $pcode=="" || $brand=="" || $mandate == "" || $expdate == "")
	{
		$error .= "YOU MISSED SOME FIELD";
	}	
	else
		{
			
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$pname))
			{
				$error .= " Product Name field Only letters and whitespace allowed.<br>";
				$status = "notok";
			}	
			
			if(!preg_match("/^[a-zA-Z0-9 ]*$/",$brand))
			{
				$error .= "Brand Name  field Only letters and whitespace allowed.<br>";
				$status = "notok";
			}
			if(!is_numeric($price))
			{
				$error .="Price Should Be Numeric.<br>";
				$status="notok";
			}
			if(!is_numeric($damount))
			{
				$error .="Discount Price Should Be Numeric.<br>";
				$status="notok";
			}
			if(!is_numeric($prod_cat_id))
			{
				$error .="Category Should Be Numeric.<br>";
				$status="notok";
			}
			if(!is_numeric($prod_sub_id))
			{
				$error .="SubCategory Should Be Numeric.<br>";
				$status="notok";
			}
			if(!is_numeric($qty))
			{
				$error .="Quantity Should Be Numeric.<br>";
				$status="notok";
			}
			if(!is_numeric($pcode))
			{
				$error .="Product code Should Be Numeric.<br>";
				$status="notok";
			}
			if($status == "ok")
			{ 
				if($_FILES['image1']['name']!="")
				{
					
					$fileName = generateFileName();
					$imageFileType = pathinfo($_FILES["image1"]["name"],PATHINFO_EXTENSION);
					$target_dir = "uploads/product/";
					$target_file = $target_dir . $fileName.".".$imageFileType;
					if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) 
					{
						$image1 =  $fileName.".".$imageFileType;
					}
					else
					{
						$error .="Error in upload of first image";
					}
				}
				else
				{
					$image1 = $_POST['image1'];
				}
				if($_FILES['image2']['name']!="")
				{
					
					$fileName = generateFileName();
					$imageFileType = pathinfo($_FILES["image2"]["name"],PATHINFO_EXTENSION);
					$target_dir = "uploads/product/";
					$target_file = $target_dir . $fileName.".".$imageFileType;
					if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file)) 
					{
						$image2 =  $fileName.".".$imageFileType;
					}
					else
					{
						$error .="Error in upload of first image";
					}
				}
				else
				{
					$image2 = $_POST['image2'];
				}
				if($_FILES['image3']['name']!="")
				{
					
					$fileName = generateFileName();
					$imageFileType = pathinfo($_FILES["image3"]["name"],PATHINFO_EXTENSION);
					$target_dir = "uploads/product/";
					$target_file = $target_dir . $fileName.".".$imageFileType;
					if (move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file)) 
					{
						$image3 =  $fileName.".".$imageFileType;
					}
					else
					{
						$error .="Error in upload of first image";
					}
				}
				else
				{
					$image3 = $_POST['image3'];
				}
				$query = "UPDATE `product` SET `cat_id`=".$prod_cat_id.",`subcat_id`=".$prod_sub_id.",`pname`='".$pname."',`description`='".$description."',`image`='".$image1."',`metaname`='".$metaname."',`metades`='".$metadescip."',`metatag`='".$metatag."',`price`='".$price."',`saleprice`='".$saleprice."',`damount`='".$damount."',`qty`='".$qty."',`status`=".$stat.",`available`='".$available."',`weight`='".$weight."', `litre` = '".$litre."',`pcode`='".$pcode."',`brand`='".$brand."',`mandate`='".$mandate."',`expdate`='".$expdate."',`image1`='".$image2."',`image2`='".$image3."' WHERE `pid` = ".$pid."";
				$result = mysqli_query($con, $query);
				if($result)
				{
				
					$success="Your information Updated Successflly";
					
				}
				else
				{
					$error .= "Sorry your information not saved".mysql_error();
				
				}
				
			}			
		}
		
}
else
{
	echo "PLEASE FILL ALL DETAILS";
}
}


?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Edit Products</h3>
              </div>
			  <span style="float: right;"><a href="product.php" class="btn btn-warning">Back</a></span>
			</div>
			
			            
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
					
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
                    <div><?php echo $error;?></div>
					<?php
					if($success!="")
					{
						echo '<div style="font-size: 20px; color: green; padding: 26px; background: lightgreen;">'.$success.'</div>';
						echo '<div style="margin-top: 29px;"><a href="viewpro1.php?pid='.$pid.'" style="padding: 10px; background: burlywood; color: black; ">View Product</a></div>';
					}
					?>
					<?php
					if($_GET['pid'] !="")
					{
					$pid = $_GET['pid'];
					?> 
					<?php
						$select_query = "SELECT * FROM `product` WHERE `pid`=".$pid." AND `status`=1";
						$select_run = $con->query($select_query);
						if($select_run->num_rows == 1)
						{
							$row = $select_run->fetch_assoc();
							$pname = $row['pname'];
							$description = $row['description'];
							$price = $row['price'];
							$samount = $row["saleprice"];
							$damount = $row['damount'];
							$image1 = $row['image'];
							$image2 = $row['image1'];
							$image3 = $row['image2'];
							$prod_cat_id = $row['cat_id'];
							$prod_sub_id = $row['subcat_id'];
							$qty = $row['qty'];
							$pcode = $row['pcode'];
							$available = $row['available'];
							$weight = $row['weight'];
							$litre = $row['litre'];
							$brand = $row['brand'];
							$mandate = $row['mandate'];
							$expdate = $row['expdate'];
							$stat = $row['status'];
						}
					?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="pname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $pname;?>"placeholder="Product Name">
						  <input type="hidden" name="pid" value="<?php echo $pid;?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Product Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea  name="description" required="required" rows = "10" class="form-control col-md-7 col-xs-12" value="" placeholder="Product Description"><?php echo $description;?>
</textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="price" required="required" class="form-control col-md-7 col-xs-12"value="<?php echo $price;?>"placeholder="Product Price">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Discount Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="damount"  class="form-control col-md-7 col-xs-12"value="<?php echo $damount;?>" placeholder="Product Amount">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sale Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="samount"  class="form-control col-md-7 col-xs-12"value="<?php echo $samount;?>" placeholder="Product Sale Amount">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="image1">
						  <input type="hidden" name="image1" value="<?php echo $image1;?>">
                        </div>
                      </div>
					  	<?php
						if($image1 !="")
						{
						?>
						<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img  class="form-control col-md-7 col-xs-12" src="uploads/product/<?php echo $image1;?>" style="width: 350px; height: 200px;">
                        </div>
                      </div>
						<?php						
						}
						?>						
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image1</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="image2">
						  <input type="hidden" name="image2" value="<?php echo $image2;?>">
                        </div>
                      </div>
					  <?php
						if($image2 !="")
						{
						?>
						<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img  class="form-control col-md-7 col-xs-12" src="uploads/product/<?php echo $image2;?>" style="width: 350px; height: 200px;">
                        </div>
                      </div>
						<?php						
						}
						?>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image2</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="image3">
						  <input type="hidden" name="image3" value="<?php echo $image3;?>">
                        </div>
                      </div>
					  	<?php
						if($image3 !="")
						{
						?>
						<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img  class="form-control col-md-7 col-xs-12" src="uploads/product/<?php echo $image3;?>" style="width: 350px; height: 200px;">
                        </div>
                      </div>
						<?php						
						}
						?>			                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Category <span class="required">*</span>
                        </label>																	
						
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="cat_id" class="form-control col-md-7 col-xs-12" name="cat_id" required="required" value="<?php echo $cat_id;?>">
						  <option value="">--- Select Category ---</option>
						  <?php
						  
						  $sql = "SELECT * FROM `productcategory` WHERE `status` = 1";
						  $result = $con->query($sql);

							if ($result->num_rows > 0) 
							{	while($row = $result->fetch_assoc()) {
								$cat_id =  $row["cat_id"];
								$catname = $row["catname"];
								$status = $row["status"];
								if($status==1)
								{
							?>						  
                          <option value="<?php echo $cat_id;?>" <?php if($cat_id == $prod_cat_id) echo "selected = 'selected'"; else echo "";?>> <?php echo $catname; ?></option>
                          <?php
								   }
								}
							}
						  ?>
                           </select>
                        </div>
                      </div>
					  
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Sub Category <span class="required">*</span>
                        </label>																	
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="subcat_id" value="<?php echo $subcat_id;?>" required="required" id="sub_cat">		  
                            <?php echo $sql_sub = "SELECT * FROM `productsubcategory` WHERE `cat_id`=".$prod_cat_id." AND `status`=1";
						  $result_sub = $con->query($sql_sub);

							if ($result_sub->num_rows > 0) {
							   

								while($row1 = $result_sub->fetch_assoc()) {
								   $sub_cat_id =  $row1["subcat_id"];
								   $sub_catname = $row1["subcategoryname"];
								   
								   if($status==1){
								   
						  ?>						  
                          <option value="<?php echo $sub_cat_id;?>" <?php if($prod_sub_id == $sub_cat_id) echo "selected = 'selected'"; else echo "";?>> <?php echo $sub_catname; ?></option>
                          <?php
								   }
								}
							}?>                      
                           </select>
                        </div>
                      </div>
					  
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Qty</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="qty"value="<?php echo $qty;?>"placeholder=" Product Quantity">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Code</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="pcode" value="<?php echo $pcode;?>"placeholder="Product Code">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Available<span class="required">*</span>
                        </label>
					  <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="available" required="required" value="<?php echo $available;?>" >
							<option value="1" <?php if($available == 1) echo "selected= 'selected'";?>>Available</option>
							<option value="2" <?php if($available == 2) echo "selected= 'selected'";?>>Not Available</option>
                           </select>
                        </div>
                      </div>
						<?php
						if($weight != "")
						{
						?>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Weight</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="weight" value="<?php echo $weight;?>" placeholder="Product weight">
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
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="litre" value="<?php echo $litre;?>" placeholder="Product in Litre">
                        </div>
                      </div>
						<?php 
						}
						?>
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Brand Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="brand"value="<?php echo $brand;?>" placeholder="Product Brand">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Manf Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="date" name="mandate"value="<?php echo $mandate;?>" placeholder="Manufacture Date">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Exp Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="date" name="expdate"value="<?php echo $expdate;?>" placeholder="Expire Date">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control col-md-7 col-xs-12" name="stat">
						<option value="1" <?php if($stat == 1) echo "selected = 'selected'";?>>Active</option>
						<option value="2" <?php if($stat == 2) echo "selected = 'selected'";?>>In Active</option>
						</select>
						</div>
                      </div>
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="product.php" class="btn btn-primary">Cancel</a>
                          <input type="submit" name="submit" class="btn btn-success" value="submit">
                        </div>
                      </div>
					<?php
			}
			
?>
                    </form>
                  </div>
                </div>
              </div>
            </div>

   </div>
            </div>
<!--Ajax code-->
<script>
$(document).ready(function(){
    $("#cat_id").change(function(){
		//alert("hai");
		$.ajax({
		url: "reqsubcatlist.php",
		type: "POST",
		data:{cat_id: $("#cat_id option:selected").val()},
		success: function(response){
			$("#sub_cat").html(response);
			console.log(response);
        },
		error: function(response){
            console.log("failure");
        }
		});
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