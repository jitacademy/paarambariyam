<div class="row row1">
<div class="col-md-12">
			<div class="col-md-2">
			<a href="index.php"><img alt="logo" class="img-responsive" src="img/img_logo.png" style="margin-left: 117px;"></a>
			</div>
			<div class="col-md-10">
			<nav class="navbar navbar-default" role="navigation" style="margin-bottom: 5px;" >
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-left: 50px;">
					<ul class="nav navbar-nav topmenu">
						<!--<li class="dropdown">
							 <a href="#" class="dropdown-toggle topmenulia" data-toggle="dropdown">English  <img src="img/ic_down_arrow_gray.png"></a>
							
						</li>-->
						<!--<li class="dropdown">
							 <a href="#" class="dropdown-toggle topmenulia" data-toggle="dropdown">INR  <img src="img/ic_down_arrow_gray.png"></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">USD</a>
								</li>
							</ul>
						</li>-->
						<li class="active">
							<a <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"])) echo "href='#'"; else echo "href='myaccount.php'";?> class="topmenulia" <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"])) echo "data-toggle='modal' data-target='#myModal'";?>>My Account</a>
						</li>
						<li class="active">
							<a <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"])) echo "href='#'"; else echo "href='wishlist.php'";?> class="topmenulia" <?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"])) echo "data-toggle='modal' data-target='#myModal'";?>>My Wishlist</a>
						</li>
						
						<?php if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"]))
								{
						?>
						<li class="active">
							<a href="#" class="topmenulia1" data-toggle="modal" data-target="#myModal">Login</a>
						</li>
						<?php
								}
								else
								{
						?>
						<li class="active">
							<a href="logout.php" class="topmenulia1">Logout</a>
						</li>
						<?php
								}
						?>
												
					</ul>
					<ul class="nav navbar-nav topmenu" style="float: right;">
					<?php if(isset($_SESSION["uid"]) && isset($_SESSION["role"]))
								{
									$query_name = "SELECT `name` FROM `users` WHERE `uid` = '".$_SESSION["uid"]."'";
									$query_name_res = $con->query($query_name);
									$query_name_row = $query_name_res->fetch_assoc();
						?>
						<li class="active">
							<a href="view_user_profile.php" class="topmenulia">Hello <span class="namecolor" style="color: #3aaaa3;"> <b><?php echo $query_name_row['name'];?></b><span></a>
						</li>
						<?php
								}
						?>
							<?php if(isset($_SESSION["uid"]) && isset($_SESSION["role"]))
								{
									if($_SESSION["role"]=="3"){
									$query_name = "SELECT `amount` FROM `wallet` WHERE `uid` = '".$_SESSION["uid"]."'";
									$query_name_res = $con->query($query_name);
									$query_name_row = $query_name_res->fetch_assoc();
						?>
						<li class="active">
							<a href="wallet.php" class="topmenulia"><b> <span style="color:#3aaaa3; font-weight: 600;">Balance</span>  ₹<?php if($query_name_row['amount']==0){ echo "0";}else{echo $query_name_row['amount'];}?></b></a>
						</li>
						<?php
									}
								}
						?>
							<li class="dropdown">
							 <a href="cart.php" class="topmenulia1" >  <img src="img/ic_home_menu_cart.png">  <span style="color:#3aaaa3; font-weight: 600;">Cart</span> <?php echo $cart_count; ?> Item(s)  </a>
							
						</li>	
					</ul>
					
					
				</div>
				
			</nav>
			<div class="secondmenu">
				<ul class="menutopul">
				<?php 
					$sql = "SELECT * FROM `productcategory` WHERE `status` = 1 LIMIT 4 ";
					$result = $con->query($sql);
					if ($result->num_rows > 0) 
					{
					while($row = $result->fetch_assoc())
					{
				?>				
				  <li class="dropdownlitop">
					<a href="#" class="dropbtnatop"><?php echo $row['catname'];?><span style="margin-left: 12px;"><img src="img/ic_down_arrow_green.png"></span></a>
					
					<div class="dropdown-contentdownlist">
					<form method="POST" action="list-item.php">
					<?php
						$sql1 = "SELECT * FROM `productsubcategory` WHERE `cat_id`= '".$row['cat_id']."' AND `status` = 1";
						$result1 = $con->query($sql1);
						if ($result1->num_rows > 0) 
						{
							while($row1 = $result1->fetch_assoc())
							{							
					?>
					
					<button type="submit" value="<?php echo $row1['subcat_id']; ?>" name="subcat_id" class="contentlista" style="border: 0; background: transparent">
					 <?php echo $row1['subcategoryname'];?>
					</button>
					
					<?php 
							} 
						}
					?>					  
					</div>
					</form>
				  </li>
				  
				  <?php 
							} 
						}
					?>
					<!--<li> <a href="#" class="btn_offer" style="color: white;">OFFER</a></li>-->
				</ul>
					
				</div>
					
				</div>
			
		</div>
		</div>
		</div>
<!-- Modal -->
<div id="myModal" class="modal fade modelheight" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
		
      <div class="modal-header bottomborderno">
		<div class="modal-close">
			<img class="" data-dismiss="modal" src="img/closebtn.jpg" />
		</div>
        <div class="modal-logo">
			<img class="" src="img/smalllogowhite.jpg" />
		</div>
		<h4 class="text-center fontsize24">Good for Nature, Good for you</h4>
		<p class="text-center fontsize16">Get started to lead a more organic life style</p>
		</div>
      <div class="modal-body paddingtb100">
		<form name="loginform" action="login.php" method="POST">
		    <div class="form-group">
				<input type="email" class="form-control inputreg" placeholder="Email" name="email" id="email" />
			</div>
			<div class="form-group">
				<input type="password" class="form-control inputreg" placeholder="Password" name="pass" id="pass" />
			</div>
						
			<input type="submit" class="btn regbtn" value="LOGIN"/>
		</form>
      </div>
	  <div class="modal-bottom-login">
		<p><a href="forgetpassword.php">Forget password?</a></p>
		<p><span class="modal-login-signp">Dont have an account?  </span><a href="signup.php" class="modal-login-sign">Get started</a></p>
      </div>
    </div>

  </div>
</div>
