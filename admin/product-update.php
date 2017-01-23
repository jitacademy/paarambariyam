<?php
			include "includes/connect.php";
			
			
			$sql1 = "SELECT * FROM `product` WHERE `pid`='117'";
			$result1 = $con->query($sql1);
			 
			if ($result1->num_rows > 0) 
			{	
				while($row = $result1->fetch_assoc()) {
				    $pimage =  $row["image"];
					
				}
				
				
				
				$query1="UPDATE `product` SET `image`='".$image."' WHERE `pid`='117'";
				$result2 = mysqli_query($con, $query1);
				
				if($result2)
				{
				
					 $success = "Your information saved successfully";
					
				}
				else
				{
					 $error = "Sorry your information not saved".mysql_error();
				
				}
				
			}
			?>
			
			
			<div class="page-title">
              <div class="title_left">
                <h3>Update Product Images</h3>
              </div>
			</div>
			
			<form id="demo-form3" name="demo-form3" class="form-horizontal form-label-left" method="post" action="" enctype="multipart/form-data">
			<div><?php echo $error;?></div><div><?php echo $success;?></div>
			<div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="file" name="image" >
						  <img src="uploads/product/<?php echo $image;?>"/>
                        </div>
                      </div>
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="addproduct.php" class="btn btn-primary">Cancel</a>
                          <input type="submit" name="productupdate" class="btn btn-success" value="productupdate">
                        </div>
                      </div>
					  <div class="ln_solid"></div>
			</form>
			