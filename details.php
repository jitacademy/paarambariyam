<?php
//date_default_timezone_set("Asia/Calcutta");
require "admin/includes/connect.php";
require "admin/includes/core.php";
require "admin/includes/cart.php";
require('header.php');
?> 
 <body>

    <div class="container-fluid paddingopx">
	<?php
	require('topmenu.php');
	?>
	<?php
	
	$pid=$_GET['pid'];
	$sql="SELECT * FROM `product` WHERE `pid`='".$pid."'";

$result = $con->query($sql);

if ($result->num_rows > 0) 
{
	$qry_sele = "SELECT `prod_views` FROM `product` WHERE `pid`=".$pid."";
	$qry_sele_res = $con->query($qry_sele);
	$qry_sele_row = $qry_sele_res->fetch_assoc();
	$pre_val = $qry_sele_row['prod_views'];
	$new_val = $pre_val +1;
	$qry_update_view = "UPDATE `product` SET `prod_views`=".$new_val." WHERE `pid`=".$pid."";
	$qry_update_view_run = $con->query($qry_update_view);
    while($row = $result->fetch_assoc())
	{
		//print_r($row);
		$subcat_id = $row["subcat_id"];
       $pcode =  $row["pcode"];
       $brand = $row["brand"];
       $mandate = $row["mandate"];
	   //$date=date_create($mandate);
	   //echo date_format($date,"d-m-Y");exit;
       $expdate = $row["expdate"];
       $image1= $row["image1"];
       $image2= $row["image2"];
       $image =  $row["image"];
	   $qty =  $row["qty"];
	   $available =  $row["available"];
	   $weight =  $row["weight"];
	   $litre = $row["litre"];
	   $price =  $row["price"];
	   $pname =  $row["pname"];
	   $description =  $row["description"];
	}
	
?>
	<div class="jumbotron">
	<div class="detailtitle">
		<h2 style="width:60%"><?php echo $pname;?> <span style="font-size: 16px;">(<?php echo $pcode;?>)</span></h2>	
<p style=" font-size:16px;" class="text-muted">HOME/asdlasdklsa/</p>		
	</div>
	
	<div style="background-color:white;" class="container">
	<div class="row">
	<div class="col-md-12" style="padding: 14px 14px 14px 0px;">	
	<div class="col-md-6">
		<img style="padding-top:15px;width:500px;height:350px;"src="admin/uploads/product/<?php echo $image;?>"/>
	</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-8">
						<p>Price</p>
						<img src="img/ic_home_rs_red_16_px.png"><?php echo $price;?>
						<div style="margin-top:50px;">
						<table>
							<tr>
								<td>Product Code<td>
								<td style="padding: 0px 10px;">:</td>
								<td><?php echo $pcode;?></td>
							</tr>
							<tr>
								<td>Brand<td>
								<td style="padding: 0px 10px;">:</td>
								<td><?php echo $brand;?></td>
							</tr>
							<tr>
								<td>Manufacture Date<td>
								<td style="padding: 0px 10px;">:</td>
								<td><?php echo $mandate;?></td>
							</tr>
							<tr>
								<td>Expiry Date<td>
								<td style="padding: 0px 10px;">:</td>
								<td><?php echo $expdate;?></td>
							</tr>
						</table>
						
						</div>
						</div>
						<div class="col-md-4">
							<img style="width:150px;height:100px;" src="admin/uploads/product/<?php echo $image1;?>"><img style="width:150px;height:100px;" src="admin/uploads/product/<?php echo $image2;?>">
						</div>
						<div class="row">
						<div class="col-md-12">
						
							<div class="row">
								<div class="col-md-4">
								<p>Available</p>
									<div class="btn-group">
										 <div style="border:1px solid #F2EEE8;padding:5px 60px 5px 60px;background-color:#F2EEE8;">
										<span>
											<?php 
											if($available ==1)
											{
												echo "YES";
											}
											else
											{
												echo "NO";
											}
											?>
										</span> 
										</div>
										
									</div>
								</div>
								<?php
								if($weight !="")
								{
								?>
								<div class="col-md-4">
								<p>Weight</p>
									<div class="btn-group">
										 
										<div style="border:1px solid #F2EEE8;padding:5px 60px 5px 60px;background-color:#F2EEE8;">
										<span>
											<?php echo $weight;?>
										</span> 
										</div>
									</div>
								</div>
								<?php
								}
								?>
								<?php
								if($litre !="")
								{
								?>
								<div class="col-md-4">
								<p>Litre</p>
									<div class="btn-group">
										 
										<div style="border:1px solid #F2EEE8;padding:5px 60px 5px 60px;background-color:#F2EEE8;">
										<span>
											<?php echo $litre;?>
										</span> 
										</div>
									</div>
								</div>
								<?php
								}
								?>
								<div class="col-md-4">
								<p>Quantity</p>
									<div class="btn-group">
										 
										<div style="border:1px solid #F2EEE8;padding:5px 60px 5px 60px;background-color:#F2EEE8;">
										<span>
											<?php echo $qty;?>
										</span> 
										</div>
									</div>
								</div>
							</div>
							</br>
							<div class="row">
								<div class="col-md-6">
									<?php 
										$uid = $_SESSION['uid'];
										$query = "SELECT COUNT(*) AS count FROM `whishlist` WHERE `uid`='".$uid."' AND `pid`=".$pid." AND  `status`=1";
										$result_wish = $con->query($query);
										$no_rows = $result_wish->fetch_assoc();
										$no_rows['count'];
									?>
									<button style="background-color:gray; width:100%;" type="button" <?php if(!isset($_SESSION["uid"])) { echo "data-toggle='modal' data-target='#myModal' class='btn btn-default'"; ?>  <?php } else { echo "class='addwishlist'"; }?> <?php if($no_rows['count'] == 1) echo "disabled=disabled"; ?> value="<?php echo $pid;?>" id="addwishlist<?php echo $pid;?>">
										<img src="img/ic_home_popular_add_cart.png"> <span style="color:white;font-size:18px;">  ADD TO WISHLIST</span>
									</button>
								</div>
							
								<div class="col-md-6">
									 <form method= "GET" action="<?php echo $current_file; ?>">
									<input type="hidden" value = "<?php echo $pid; ?>" name="pid">	
									<input type="hidden" value = "<?php echo $pid; ?>" name="Status">	
									<button type="submit"  style="background-color:#3aaaa3;width:100%;"type="button" class="btn btn-default">
									<img src="img/ic_home_popular_cart.png">   <span style="color:white;font-size:18px;">  ADD TO CART</span>
									</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					</div>
					
				</div>

	</div>
	</div>
	</div>
	</div>
	
	
	
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	
	<div class="tabbable" id="tabs-540588">
	
				<ul class="nav nav-tabs  ">
					<li class="active">
						<a href="#panel-590340" data-toggle="tab" class = "tabmenudefault" >ABOUT</a>
					</li>
					
					
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-590340">
						<div class="padding140">
							<div class="col-md-12">
								<div style="color: #999999;font-size:16px;font-family: opensans-light;    text-align: justify;" class="row text-left">
									</br></br>
									<?php echo $description;?>
									
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
	</div>
	</div>
	</div>
	<div class="container">
			<div class="col-md-12 page-header">
			
				<div class="row padding40pxtb">
				
				<h3 style="margin-left:30px;">Related products</h3>
				<?php	
								$sql = "SELECT * FROM `product` WHERE `subcat_id`=".$subcat_id." AND `status` = 1 ORDER BY `pid` DESC LIMIT 4";

								$result = $con->query($sql);
								if ($result->num_rows > 0) 
								{
									while($row = $result->fetch_assoc())
									{
									   $catid =  $row["cat_id"];
									   $pid =  $row["pid"];
									   $image =  $row["image"];
									   $pname =  $row["pname"];
									   $price =  $row["price"];
									//echo $catid;
									?>
					<div class="col-md-3">
										<div class="hovereffect">
											<img class="img-responsive" src="admin/uploads/product/<?php echo $image;?>" alt="" width="285px" style="height: 165px;">
											<img class="img-responsive" src="img/ic_home_popular_new.png" alt="" style="position: absolute;top: 30px;">
											<div class="overlay">
												<div class="floatleft paddingri5px">
													
													<form method= "POST" action="<?php echo $current_file; ?>">
													<input type="hidden" value = "<?php echo $pid; ?>" name="pid">
													<button type="submit" style="border: 0; background: transparent">
													<img class="imgbright1" src="img/ic_home_popular_cart.png"/>
													</button>
													</form>
												</div>
												<div class="floatleft paddingri5px">
													<?php 
														$uid = $_SESSION['uid'];
														$query = "SELECT COUNT(*) AS count FROM `whishlist` WHERE `uid`='".$uid."' AND `pid`=".$pid." AND  `status`=1";
														$result_wish = $con->query($query);
														$no_rows = $result_wish->fetch_assoc();
														$no_rows['count'];
													?>
													<button type="button" <?php if(!isset($_SESSION["uid"])) { echo "data-toggle='modal' data-target='#myModal'";} else { echo "class='addwishlist'"; }?>  <?php if($no_rows['count'] == 1) echo "disabled=disabled"; ?> style="border: none; background: none;" value="<?php echo $pid;?>" id="addwishlist<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_add_cart.png" /></button>
												</div>
												<div class="floatleft paddingri5px">
													<a href="details.php?pid=<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_view_details.png"/></a>
												</div>
											</div>
										</div>
										<div class="text-center"><a href="details.php?pid=<?php echo $pid?>"style="color:#333;text-decoration:none;">
							<p><?php echo $pname;?></p>
							<?php 
							$query_cat = "SELECT `catname` FROM `productcategory` WHERE `cat_id`=".$catid."";
							$query_cat_result = $con->query($query_cat);
							$query_cat_row = $query_cat_result->fetch_assoc();
							?>
							<p><?php echo $query_cat_row['catname'];?></p>
							<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/><span style="color:#d84a37;"><?php echo $price;?></span> 
							</div></a>
									</div>
							<?php
									}
								}
							?>
		
		
		
				</div>
			</div>

		</div>


			<div class="container">
			<div class="col-md-12 page-header">
				<div class="row padding40pxtb">
				<h3 style="margin-left:30px;">People also search for</h3>
					<?php	
								$sql = "SELECT * FROM `product` WHERE `status` = 1 ORDER BY `prod_views` DESC LIMIT 4";

								$result = $con->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) 
									{
										$catid =  $row["cat_id"];
									   $pid =  $row["pid"];
									   $image =  $row["image"];
									   $pname =  $row["pname"];
									   $price =  $row["price"];
									//echo $catid;
									?>
									<div class="col-md-3">
										<div class="hovereffect">
											<img class="img-responsive" src="admin/uploads/product/<?php echo $image;?>" alt="" width="285px" style="height: 165px;">
											<img class="img-responsive" src="img/ic_home_popular_new.png" alt="" style="position: absolute;top: 30px;">
											<div class="overlay">
												<div class="floatleft paddingri5px">
													
													<form method= "POST" action="<?php echo $current_file; ?>">
													<input type="hidden" value = "<?php echo $pid; ?>" name="pid">
													<button type="submit" style="border: 0; background: transparent">
													<img class="imgbright1" src="img/ic_home_popular_cart.png"/>
													</button>
													</form>
												</div>
												<div class="floatleft paddingri5px">
													<?php 
														$uid = $_SESSION['uid'];
														$query = "SELECT COUNT(*) AS count FROM `whishlist` WHERE `uid`='".$uid."' AND `pid`=".$pid." AND  `status`=1";
														$result_wish = $con->query($query);
														$no_rows = $result_wish->fetch_assoc();
														$no_rows['count'];
													?>
													<button type="button" <?php if(!isset($_SESSION["uid"])) { echo "data-toggle='modal' data-target='#myModal'";} else { echo "class='addwishlist'"; }?>  <?php if($no_rows['count'] == 1) echo "disabled=disabled"; ?> style="border: none; background: none;" value="<?php echo $pid;?>" id="addwishlist<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_add_cart.png" /></button>
												</div>
												<div class="floatleft paddingri5px">
													<a href="details.php?pid=<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_view_details.png"/></a>
												</div>
											</div>
										</div>
										<div class="text-center"><a href="details.php?pid=<?php echo $pid?>"style="color:#333;text-decoration:none;">
							<p><?php echo $pname;?></p>
							<?php 
							$query_cat = "SELECT `catname` FROM `productcategory` WHERE `cat_id`=".$catid."";
							$query_cat_result = $con->query($query_cat);
							$query_cat_row = $query_cat_result->fetch_assoc();
							?>
							<p><?php echo $query_cat_row['catname'];?></p>
							<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/><span style="color:#d84a37;"><?php echo $price;?></span> 
							</div></a>
									</div>
									<?php
									}
									}
									?>
		
		
				</div>
			</div>

		</div>
	
	<?php
	}
	else
	{
		echo '<div class="prodnotfound">The Requested Product is not found Please Visit our <a href="index.php">Home Page</a></div>';		
	}
	require('footer.php');
	?>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>