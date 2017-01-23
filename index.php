<?php
include("admin/includes/connect.php");
include("admin/includes/core.php");
include("admin/includes/cart.php");
require('header.php');

?>
  <body>

    <div class="container-fluid paddingopx">
		<?php
		require('topmenu.php');
		require('slider.php');
		?>

	

		
	<div class="row">
		<div class="col-md-12">
			<div class="col-inner">
				<div class="col-innertitle">
					<p class="col-innerp">ORGANIC TYPE</p>
				</div>				
		<div class="col-md-12">
			<div class="row">
			<form method="post" action="list-item.php">
			<?php	
		$sql = "SELECT * FROM `productcategory` WHERE `status` = 1 ORDER BY `cat_id` DESC LIMIT 6";
		$result = $con->query($sql);
		if ($result->num_rows > 0) {
									   

		while($row = $result->fetch_assoc())
			{
		$catid =  $row["cat_id"];
		$catname =  $row["catname"];
		$catimage =  $row["catimage"];
										  
					
			
	?>
				<div class="col-md-4">
				
					<button type="submit" name="catid" value="<?php echo $catid?>" style="border: 0; background: transparent"><img style="background-color: #f5f5f5; width: 312px;height: 201px;" alt="Organic Images" src="admin/uploads/category/<?php echo $catimage;?>" />
					<p class ="center"><?php echo $catname; ?></p></button>
					
				</div>
				
				<?php
			}
		}
		?>
		</form>
			</div>
			
		</div>

			</div>
		</div>
	</div>
	<div class="row bacolash padding55pxtb">
		<div class="col-md-12">
			<div class="tabbable" id="tabs-540599">
				<ul class="nav nav-tabs hometabmain">
					<li class="active" style="padding-bottom:32px;margin-left:250px;">
						<a href="#panel-590358" data-toggle="tab" class = "tabmenudefault" >POPULAR</a>
					</li>
					<li>
						<a href="#panel-683699" class = "tabmenudefault" data-toggle="tab">NEW ARRIVALS</a>
					</li>
					
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-590358">
						<div class="padding140">
							<div class="col-md-12" style="padding-left:75px;">
								<div class="row">
								<?php	
								$sql = "SELECT * FROM `product` WHERE `status` = 1 ORDER BY `prod_views` DESC LIMIT 4";

								$result = $con->query($sql);
								if ($result->num_rows > 0) {
								   

									while($row = $result->fetch_assoc()) {
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
					</div>
					<div class="tab-pane" id="panel-683699">
						<div class="padding140">
							<div class="col-md-12" style="padding-left:75px;">
								<div class="row">
								<?php	
								$sql = "SELECT * FROM `product` WHERE `status` = 1 ORDER BY `pid` DESC LIMIT 4";
								$result = $con->query($sql);
								if ($result->num_rows > 0) {
								   

									while($row = $result->fetch_assoc()) {
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
					</div>
					
				
				</div>
			</div>
			
		</div>
	</div>
	<div class="row padding55pxtb">
		<div class="col-md-12 paddingleft0px paddingright0px">
			<div class="col-md-4 paddingleft0px">
				<img alt="Bootstrap Image Preview" src="img/home_three1.jpg" width="420px">
				<div style="position: absolute;left: 32%;top: 86%;">
									
							<p>
								<a class="slidershop1" href="#">SHOP NOW!</a>
							</p>
						</div>
			</div>
			<div class="col-md-4 paddingleft0px">
				<img alt="Bootstrap Image Preview" src="img/home_three2.jpg" width="420px">
				<div style="position: absolute;left: 32%;top: 86%;">
									
							<p>
								<a class="slidershop1" href="#">SHOP NOW!</a>
							</p>
						</div>
			</div>
			<div class="col-md-4 paddingleft0px paddingright0px">
				<img alt="Bootstrap Image Preview" src="img/home_three3.jpg" width="420px">
				<div style="position: absolute;left: 32%;top: 86%;">
									
							<p>
								<a class="slidershop1" href="#">SHOP NOW!</a>
							</p>
						</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 paddingleft0px">
			<img alt="Bootstrap Image Preview" src="img/home_honeyshop.jpg" width="100%">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portfolio">						
				<div class="col-md-6">
					<img alt="Bootstrap Image Preview" src="img/home_portfolio1.jpg" class="img-circle" style="margin-left:100px;float:left;">	
					
					<p style="padding: 10px 0px 0px 18px;;float:left;"><img src="img/ic_home_quote.png"/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br> Integer posuere erat a ante."</p>
					
				</div>						
					<div class="col-md-6">
					<img alt="Bootstrap Image Preview" src="img/home_portfolio2.jpg" class="img-circle"style="margin-left:100px;float:left;">		
					
					<p style="padding: 10px 0px 0px 18px;float:left;"><img src="img/ic_home_quote.png"/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>Integer posuere erat a ante."</p>
					
				</div>
			</div>
		</div>
	</div>
	<?php
	require('footer.php');
	?>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>