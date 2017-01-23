<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {

if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";

include "random_images_rename1.php";

if(isset($_POST['submit']))
{
	if(isset($_POST['pname']) && isset($_POST['description'])&& isset($_POST['price'])&& isset($_POST['damount']) && isset($_POST['cat_id']) && isset($_POST['subcat_id']) && isset($_POST['qty']) && isset($_POST['samount'])
	&& isset($_POST['available']) && isset($_POST['weight']) && isset($_POST['pcode']) && isset($_POST['brand']) && isset($_POST['mandate']) && isset($_POST['expdate']))
{
	
//print_r($_POST);exit;
	
	function test_input($data)
{
	
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}	
	$error="";
	$pname = test_input($_POST['pname']);
	$description = test_input($_POST['description']);
	$price = test_input($_POST['price']);
	$damount = test_input($_POST['damount']);
	$prod_cat_id = test_input($_POST['cat_id']);
	$subcat_id = test_input($_POST['subcat_id']);
	$qty =test_input( $_POST['qty']);
	$available =test_input( $_POST['available']);
	$samount = test_input($_POST['samount']);
	if($_POST['weight'] !="")
	{
		$weight =test_input($_POST['weight']);
	}
	if($_POST['litre'] !="")
	{
		$litre =test_input($_POST['litre']);
	}
	$pcode =test_input( $_POST['pcode']);
	$brand =test_input( $_POST['brand']);
	$mandate =test_input( $_POST['mandate']);
	$expdate =test_input( $_POST['expdate']);
	$ptype = test_input($_POST['ptype']);
	
	$success="";
	
	$status="ok";
	if($pname=="" || $description=="" || $price=="" || $prod_cat_id=="" || $subcat_id=="" || $damount=="" || $samount == "" || $qty=="" || $available == "" || $pcode=="" || $brand=="" || $mandate == "" || $expdate == "" || $ptype == "")
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
			if(!is_numeric($samount))
			{
			$error .="Sale amount Should Be Numeric.<br>";
			$status="notok";
			}
			if(!is_numeric($prod_cat_id))
			{
			$error .="Category Should Be Numeric.<br>";
			$status="notok";
			}
			if(!is_numeric($subcat_id))
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
				if($weight!="")
				{
				$query = "INSERT INTO `product`(`cat_id`,`subcat_id`,`pname`,`description`,`image`,`price`,`saleprice`,`damount`,`qty`,`available`,`weight`,`product_type`,`pcode`,`brand`,`mandate`,`expdate`,`image1`,`image2`,`status`) 
				VALUES ('".$prod_cat_id."','".$subcat_id."','".$pname."','".$description."','".$image."','".$price."',".$samount.",'".$damount."','".$qty."','".$available."','".$weight."',".$ptype.",'".$pcode."','".$brand."','".$mandate."','".$expdate."','".$image1."','".$image2."',1)";
				}
				else if($litre != "")
				{
					$query = "INSERT INTO `product`(`cat_id`,`subcat_id`,`pname`,`description`,`image`,`price`,`saleprice`,`damount`,`qty`,`available`,`litre`,`product_type`,`pcode`,`brand`,`mandate`,`expdate`,`image1`,`image2`,`status`) 
				VALUES ('".$prod_cat_id."','".$subcat_id."','".$pname."','".$description."','".$image."','".$price."',".$samount.",'".$damount."','".$qty."','".$available."','".$litre."',".$ptype.",'".$pcode."','".$brand."','".$mandate."','".$expdate."','".$image1."','".$image2."',1)";
				}
				$result = mysqli_query($con, $query);
				
				if($result)
				{
				
					 $success = "Your information saved successfully";
					
				}
				else
				{
					 $error = "Sorry your information not saved".mysql_error();
				
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
                <h3>Add Products</h3>
              </div>
</div>
             
            <div class="clearfix"></div>
            <div class="row">
              
                  <div class="x_content">
                    <br />
					<?php if($error != "")
					{
					?>
						<div class="alert-danger" style="padding: 19px; margin-bottom: 16px; font-size: 20px;"><?php echo $error;?></div>
					<?php
					}
					?> 
					<div><?php echo $error;?></div>
					
					<?php if($success != "")
					{
					?>
						<div class="alert-success" style="padding: 19px; margin-bottom: 16px; font-size: 20px;"><?php echo $success;?></div>
					<?php
					}
					?>                    
					<form id="demo-form2" name="demo-form2" class="form-horizontal form-label-left" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="pname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $pname;?>"placeholder="Product Name">
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
                          <input type="text" name="price" required="required" class="form-control col-md-7 col-xs-12"value="<?php echo $price;?>" placeholder="Product Price">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Discount Amount 
                       </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="damount"  class="form-control col-md-7 col-xs-12"value="<?php echo $damount;?>" placeholder="Discount Amount">
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
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="image">
                        </div>
                      </div>
					  					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image1</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="image1">
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image2</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="image2">
                        </div>
                      </div>
					  				                     
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
							{
								while($row = $result->fetch_assoc()) 
								{
								   $cat_id =  $row["cat_id"];
								   $catname = $row["catname"];
								   $status = $row["status"];								   
								   if($status==1)
								   {								   
						  ?>						  
									<option value="<?php echo $cat_id;?>" <?php if($cat_id == $prod_cat_id) echo "selected = 'selected'"; else echo "";?>><?php echo $catname; ?></option>
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
                          <option value="<?php echo $sub_cat_id;?>" <?php if($subcat_id == $sub_cat_id) echo "selected = 'selected'"; else echo "";?>> <?php echo $sub_catname; ?></option>
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
							<option value="1"<?php if($available == 1) echo "selected= 'selected'";?>>Available</option>
							<option value="2"<?php if($available == 2) echo "selected= 'selected'";?>>Not Available</option>
                           </select>
                        </div>
                      </div>
				
					  <div class="form-group" id="ptype">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Choose Product type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="ptype" required="required" value="<?php echo $ptype;?>" id="chpdty">
							<option>Choose Product Type</option>
							<option value="1"<?php if($ptype == 1) echo "selected= 'selected'";?>>Weight</option>
							<option value="2"<?php if($ptype == 2) echo "selected= 'selected'";?>>Litre</option>
                           </select>
                        </div>
                      </div>
					  <div class="form-group" id = "weight" style="display: none;">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Weight (in kgs)</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="weight" value="<?php echo $weight;?>" placeholder="Product weight">
                        </div>
                      </div>
					  <div class="form-group" id="litre" style="display: none;">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Litre</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="litre" value="<?php echo $weight;?>" placeholder="Product weight">
                        </div>
                      </div>
					  
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
					  
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="product.php" class="btn btn-primary">Cancel</a>
                          <input type="submit" name="submit" class="btn btn-success" value="submit">
                        </div>
                      </div>

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
	$("#ptype").change(function(){
		$val = $("#chpdty option:selected").val();
		if($val == 1)
		{
			$("#weight").css("display", "block");
			$("#litre").css("display", "none");
		}
		else
		{
			$("#litre").css("display", "block");
			$("#weight").css("display", "none");
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