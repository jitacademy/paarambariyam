<?php
include("admin/includes/connect.php");

require('header.php');
require('topmenu.php');


?>
  <body>

    <div class="container-fluid paddingopx">
	<section>
		<div class="container" style="padding-top:60px;">
			<div class="row">	
				<?php
				if(isset($_POST['subcat_id']))
				{
					$sql = "SELECT * FROM productsubcategory WHERE subcat_id = '".$_POST['subcat_id']."'";
					$result = $con->query($sql);
					if ($result->num_rows > 0) 
					{
						while($row = $result->fetch_assoc()) 
						{
						   $subcatid =  $row["subcat_id"];
						   $subcatname=  $row["subcategoryname"];
						   $subcatstatus =  $row["status"];
						   
						}
					}
					?>
					<h2 style="text-transform: uppercase;"><?php echo $subcatname; ?></h2>	
				<?php
				}
				else if(isset($_POST['brand']))
				{
				?>
					<h2 style="text-transform: uppercase;"><?php echo $_POST['brand']; ?></h2>	
				<?php
				}
				else
				{
				?>
				<h2 style="text-transform: uppercase;">Catagory List</h2>
				<?php
				}
				?>
				<div class="col-sm-3">
				
				
				<!--<h4 class="text-muted">507 item(s) sorts by <a style="color:#3aaaa3">Name</a>  <img src="img/ic_list_short_1.png"></h4>-->
					<div class="left-sidebar" style="padding-top: 30px;width: 100%;">
						
						
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						
							<div>
								<div>
									<h4 class="h44">
									<p style="background-color:#cccccc;height:60px;padding: 20px;margin-top:-25px;">CATEGORIES</p>
										
									</h4>
								</div>								
							</div>							
							<?php
							$sql1 = "SELECT `cat_id`, `catname`, `catimage`, `status` FROM `productcategory` WHERE `status` = 1";
							$result_sql = $con->query($sql1);
							while($row = $result_sql->fetch_assoc())
							{
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $row['cat_id'];?>">
											<span class="pull-right">+</span>
											<?php echo $row['catname'];?>
										</a>
									</h4>
								</div>
								<span>
								<div id="<?php echo $row['cat_id'];?>" class="panel-collapse collapse" style="background-color:#f9f4f4; color: #696763;">
									<div class="panel-body">
										<ul style="list-style-type:none">
											<?php
											$sql2 = "SELECT `subcat_id`, `cat_id`, `subcategoryname`, `status` FROM `productsubcategory` WHERE `cat_id`=".$row['cat_id']." AND `status` = 1";
											$result_sql2 = $con->query($sql2);
											while($row1 = $result_sql2->fetch_assoc())
											{
											?>
											<li>
												<div class="panel-heading">
												<h4 class="panel-title">
												<form method= "POST" action="list-item.php">
													<button type="submit" value="<?php echo $row1['subcat_id']; ?>" name="subcat_id" class="contentlista" style="border: 0; background: transparent; color: rgb(58, 170, 163);"><?php echo $row1['subcategoryname'];?></button>
												</h4>
												</div>
											</li>
											<?php
											}
											?>
										</ul>
									</div>
								</div>
								</span>
							</div>
							<?php
							}
							?>
							<div class="brands_products">
							<div>
								<div>
									<h4 class="h44">
										<p style="background-color:#cccccc;height:60px;padding: 20px;">BRANDS</p>
									</h4>
								</div>
								
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<ul class="nav nav-pills nav-stacked">
									<?php
									$query_brand = "SELECT DISTINCT `brand` FROM `product` WHERE `status` = 1 ORDER BY `pid` DESC LIMIT 5";
									$query_brand_res = $con->query($query_brand);
									if($query_brand_res->num_rows > 0)
									{
										while($row_brand = $query_brand_res->fetch_assoc())
										{
											$new_brand = $row_brand['brand'];
									?>
										<li>
											<form method= "POST" action="list-item.php">
												<button type="submit" name="brand" value="<?php echo $new_brand;?>" style="border: 0; background: transparent; text-transform: uppercase; padding: 6px 38px 6px 0px;">
													<p style="margin:0px 0px 0px 30px;color:#696763;"><?php echo $new_brand; ?></p>
												</button>
											</form>
										</li>
									<?php
										}
									}
									?>										
									</ul>									
								</div>								
							</div>							
						</div>
						</div><!--/category-products-->
						<div class="brands_products"><!--brands_products-->
							<div style="padding-top: 20px;">
									<h4>
										
											<p style="background-color:white;height:35px;margin-top:-25px;padding:14px 0px 2px 20px;">FEATURED ITEMS</p>
										
									</h4>
								</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<ul class="nav nav-pills nav-stacked">
								<?php
									$query_new = "SELECT `pid`, `cat_id`, `subcat_id`, `pname`, `image`, `price` FROM `product` WHERE `status` = 1 AND `isfeatured` = 1 ORDER BY `pid` DESC LIMIT 5";
									$query_new_res = $con->query($query_new);
									if($query_new_res->num_rows > 0)
									{
										while($row_new = $query_new_res->fetch_assoc())
										{
											$new_pname = $row_new['pname'];
											$new_pid = $row_new['pid'];
											$new_price = $row_new['price'];
											$new_image = $row_new['image'];
									?>
										<li>
											<a href="details.php?pid=<?php echo $new_pid;?>"> 
												<p><span style="color:#696763;"><?php echo $new_pname;?></span></p>
												<span><img style="border:1px solid #D5D4D1; width:100px;" src="admin/uploads/product/<?php echo $new_image;?>"/>
												<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/>
												<span style="color:#696763;"><?php echo $new_price;?></span> 
												</span>
											</a>
										</li>
									<?php
										}
									}
									?>
								</ul>
									
								</div>
								
							</div>
						</div>
						
						<div class="brands_products" style="padding-top:30px;"><!--brands_products-->
							<div style="padding-top: 20px;">
									<h4>
										
											<p style="background-color:white;height:35px;margin-top:-25px;padding:14px 0px 2px 20px;">NEWLY ADDED ITEMS</p>
										
									</h4>
								</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<ul class="nav nav-pills nav-stacked">
									<?php
									$query_new = "SELECT `pid`, `cat_id`, `subcat_id`, `pname`, `image`, `price` FROM `product` WHERE `status` = 1 ORDER BY `pid` DESC LIMIT 3";
									$query_new_res = $con->query($query_new);
									if($query_new_res->num_rows > 0)
									{
										while($row_new = $query_new_res->fetch_assoc())
										{
											$new_pname = $row_new['pname'];
											$new_pid = $row_new['pid'];
											$new_price = $row_new['price'];
											$new_image = $row_new['image'];
									?>
										<li>
											<a href="details.php?pid=<?php echo $new_pid;?>"> 
												<p><span style="color:#696763;"><?php echo $new_pname;?></span></p>
												<span><img style="border:1px solid #D5D4D1; width:100px;" src="admin/uploads/product/<?php echo $new_image;?>"/>
												<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/>
												<span style="color:#696763;"><?php echo $new_price;?></span> 
												</span>
											</a>
										</li>
									<?php
										}
									}
									?>										
								</ul>									
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right" style="padding-top:125px;">
							
							<div class="col-md-12">
								<div class="row">
								<?php
								
									if(isset($_POST['subcat_id']) || isset($_POST['brand']) || isset($_POST['catid']))
									{
										$subcat_id  = $_POST['subcat_id'];
										$catid  = $_POST['catid'];
								if(isset($_POST['subcat_id'])){
								$sql = "SELECT * FROM product WHERE subcat_id = '".$_POST['subcat_id']."' AND `status` = 1";													
								$result = $con->query($sql);                                                                      
								if ($result->num_rows > 0) 
								{
									while($row = $result->fetch_assoc()) {
									   $cat_id =  $row["cat_id"];
									   $pid =  $row["pid"];
									   $image =  $row["image"];
									   $pname =  $row["pname"];
									   $price =  $row["price"];
									   $subcategoryname =  $row["subcategoryname"];
								?>
									<div class="col-md-4">
										<div class="hovereffect">
											<img class="img-responsive" src="admin/uploads/product/<?php echo $image;?>" alt="" width="257" style="height: 165px;">
											<img class="img-responsive" src="img/ic_home_popular_new.png" alt="" style="position: absolute;top: 30px;">
											<div class="overlay">
												<div class="floatleft paddingri5px">
													<form method= "POST" action="<?php echo $current_file; ?>">
<input type="hidden" value = "<?php echo $pid; ?>" name="pid">
<input type="hidden" value = "<?php echo $_POST['subcat_id']; ?>" name="subcat_id">
<button type="submit" style="border: 0; background: transparent">
<img class="imgbright1" src="img/ic_home_popular_cart.png"/>
</button>
</form>
												</div>
												<?php 
													$uid = $_SESSION['uid'];
													$query = "SELECT COUNT(*) AS count FROM `whishlist` WHERE `uid`='".$uid."' AND `pid`=".$pid." AND  `status`=1";
													$result_wish = $con->query($query);
													$no_rows = $result_wish->fetch_assoc();
													$no_rows['count'];
												?>
												<div class="floatleft paddingri5px">
													<button type="button" <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["did"])) { echo "data-toggle='modal' data-target='#myModal'";} else { echo "class='addwishlist'"; }?>  <?php if($no_rows['count'] == 1) echo "disabled=disabled"; ?> style="border: none; background: none;" value="<?php echo $pid;?>" id="addwishlist<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_add_cart.png" /></button>
												</div>
												<div class="floatleft paddingri5px">
													<a href="details.php?pid=<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_view_details.png"/></a>
												</div>
											</div>
										</div>
										<div class="text-center"><a href="details.php?pid=<?php echo $pid;?>"style="color:#333;text-decoration:none;">
							<p><?php echo $pname; ?></p>
						
							<p><?php echo $subcatname; ?></p>
							
							<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/><span style="color:#d84a37;"><?php echo $price;?></span></a> 
							</div></a>
									</div>
									
										
								<?php } }} ?>
								
								<?php
								if(isset($_POST['catid'])){
								$sql = "SELECT * FROM product WHERE cat_id = '".$_POST['catid']."' AND `status` = 1";													
								$result = $con->query($sql);                                                                      
								if ($result->num_rows > 0) 
								{
									while($row = $result->fetch_assoc()) {
									   $cat_id =  $row["cat_id"];
									   $pid =  $row["pid"];
									   $image =  $row["image"];
									   $pname =  $row["pname"];
									   $price =  $row["price"];
									   $subcategoryname =  $row["subcategoryname"];
								?>
									<div class="col-md-4">
										<div class="hovereffect">
											<img class="img-responsive" src="admin/uploads/product/<?php echo $image;?>" alt="" width="257" style="height: 165px;">
											<img class="img-responsive" src="img/ic_home_popular_new.png" alt="" style="position: absolute;top: 30px;">
											<div class="overlay">
												<div class="floatleft paddingri5px">
													<form method= "POST" action="<?php echo $current_file; ?>">
<input type="hidden" value = "<?php echo $pid; ?>" name="pid">
<input type="hidden" value = "<?php echo $_POST['catid']; ?>" name="catid">
<button type="submit" style="border: 0; background: transparent">
<img class="imgbright1" src="img/ic_home_popular_cart.png"/>
</button>
</form>
												</div>
												<?php 
														$uid = $_SESSION['uid'];
														$query = "SELECT COUNT(*) AS count FROM `whishlist` WHERE `uid`='".$uid."' AND `pid`=".$pid." AND  `status`=1";
														$result_wish = $con->query($query);
														$no_rows = $result_wish->fetch_assoc();
														$no_rows['count'];
													?>
													<div class="floatleft paddingri5px">
														<button type="button" <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["did"])) { echo "data-toggle='modal' data-target='#myModal'";} else { echo "class='addwishlist'"; }?>  <?php if($no_rows['count'] == 1) echo "disabled=disabled"; ?> style="border: none; background: none;" value="<?php echo $pid;?>" id="addwishlist<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_add_cart.png" /></button>
													</div>
													<div class="floatleft paddingri5px">
														<a href="details.php?pid=<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_view_details.png"/></a>
													</div>
											</div>
										</div>
										<div class="text-center"><a href="details.php?pid=<?php echo $pid;?>"style="color:#333;text-decoration:none;">
							<p><?php echo $pname; ?></p>
						
							<p><?php echo $subcatname; ?></p>
							
							<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/><span style="color:#d84a37;"><?php echo $price;?></span></a> 
							</div></a>
									</div>
									
										
								<?php 
								}
								}
								}
								if(isset($_POST['brand']))
								{
									$sql = "SELECT * FROM product WHERE `brand` = '".$_POST['brand']."' AND `status` = 1";									
									$result = $con->query($sql);                                                                      
									if ($result->num_rows > 0) 
									{
										while($row = $result->fetch_assoc()) 
										{
										   $cat_id =  $row["cat_id"];
										   $pid =  $row["pid"];
										   $image =  $row["image"];
										   $pname =  $row["pname"];
										   $price =  $row["price"];
										   $subcategoryname =  $row["subcategoryname"];
								?>
									<div class="col-md-4">
										<div class="hovereffect">
											<img class="img-responsive" src="admin/uploads/product/<?php echo $image;?>" alt="" width="257" style="height: 165px;">
											<img class="img-responsive" src="img/ic_home_popular_new.png" alt="" style="position: absolute;top: 30px;">
											<div class="overlay">
												<div class="floatleft paddingri5px">
													<form method= "POST" action="<?php echo $current_file; ?>">
														<input type="hidden" value = "<?php echo $pid; ?>" name="pid">
														<input type="hidden" value = "<?php echo $_POST['catid']; ?>" name="catid">
														<button type="submit" style="border: 0; background: transparent">
														<img class="imgbright1" src="img/ic_home_popular_cart.png"/>
														</button>
													</form>
												</div>
												<?php 
														$uid = $_SESSION['uid'];
														$query = "SELECT COUNT(*) AS count FROM `whishlist` WHERE `uid`='".$uid."' AND `pid`=".$pid." AND  `status`=1";
														$result_wish = $con->query($query);
														$no_rows = $result_wish->fetch_assoc();
														$no_rows['count'];
													?>
													<div class="floatleft paddingri5px">
														<button type="button" <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["did"])) { echo "data-toggle='modal' data-target='#myModal'";} else { echo "class='addwishlist'"; }?>  <?php if($no_rows['count'] == 1) echo "disabled=disabled"; ?> style="border: none; background: none;" value="<?php echo $pid;?>" id="addwishlist<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_add_cart.png" /></button>
													</div>
													<div class="floatleft paddingri5px">
														<a href="details.php?pid=<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_view_details.png"/></a>
													</div>
											</div>
										</div>
										<div class="text-center"><a href="details.php?pid=<?php echo $pid;?>"style="color:#333;text-decoration:none;">
							<p><?php echo $pname; ?></p>
						
							<p><?php echo $subcatname; ?></p>
							
							<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/><span style="color:#d84a37;"><?php echo $price;?></span></a> 
							</div></a>
									</div>
									<?php
										}
									}
								}
								}
								
								else
								{
									$sql = "SELECT `pid`, `cat_id`, `subcat_id`, `pname`, `image`, `price` FROM `product` WHERE `status` = 1 ORDER BY `pid` DESC LIMIT 20";												
									$result = $con->query($sql);                                                                      
									if ($result->num_rows > 0) 
									{
										while($row = $result->fetch_assoc()) 
										{
										   $cat_id =  $row["cat_id"];
										   $pid =  $row["pid"];
										   $image =  $row["image"];
										   $pname =  $row["pname"];
										   $price =  $row["price"];
										   $subcategoryname =  $row["subcategoryname"];
									?>
										<div class="col-md-4">
											<div class="hovereffect">
												<img class="img-responsive" src="admin/uploads/product/<?php echo $image;?>" alt="" width="257" style="height: 165px;">
												<img class="img-responsive" src="img/ic_home_popular_new.png" alt="" style="position: absolute;top: 30px;">
												<div class="overlay">
													<div class="floatleft paddingri5px">
														<form method= "POST" action="<?php echo $current_file; ?>">
															<input type="hidden" value = "<?php echo $pid; ?>" name="pid">
															<input type="hidden" value = "<?php echo $_POST['subcat_id']; ?>" name="subcat_id">
															<button type="submit" style="border: 0; background: transparent">
															<img class="imgbright1" src="img/ic_home_popular_cart.png"/>
															</button>
															</form>
													</div>
													<?php 
														$uid = $_SESSION['uid'];
														$query = "SELECT COUNT(*) AS count FROM `whishlist` WHERE `uid`='".$uid."' AND `pid`=".$pid." AND  `status`=1";
														$result_wish = $con->query($query);
														$no_rows = $result_wish->fetch_assoc();
														$no_rows['count'];
													?>
													<div class="floatleft paddingri5px">
														<button type="button" <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["did"])) { echo "data-toggle='modal' data-target='#myModal'";} else { echo "class='addwishlist'"; }?>  <?php if($no_rows['count'] == 1) echo "disabled=disabled"; ?> style="border: none; background: none;" value="<?php echo $pid;?>" id="addwishlist<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_add_cart.png" /></button>
													</div>
													<div class="floatleft paddingri5px">
														<a href="details.php?pid=<?php echo $pid;?>"><img class="imgbright1" src="img/ic_home_popular_view_details.png"/></a>
													</div>
												</div>
											</div>
											<div class="text-center">
											<a href="details.php?pid=<?php echo $pid;?>"style="color:#333;text-decoration:none;">
												<p><?php echo $pname; ?></p>
											
												<p><?php echo $subcatname; ?></p>
												
												<img class="imgbright1" src="img/ic_home_rs_red_16_px.png"/><span style="color:#d84a37;"><?php echo $price;?></span>
											</a> 
											</div>
										</div>
										
											
								<?php 
								} 
								} 
								}?>
								
						</div>
							</div>
							
					
							</div><!--features_items-->
					
					
				</div>
			</div>
		</div>
	</section>
	
	
	
	
	
	<?php
	require('footer.php');
	?>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	
	
	<script src="js/price-range.js"></script>
	<script src="js/main.js"></script>
  </body>
</html>
