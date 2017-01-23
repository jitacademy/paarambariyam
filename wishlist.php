<?php
require "admin/includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
require('header.php');
?>
  <body>

  <?php
		require('topmenu.php');
		?>
	<section>
		<div class="container-fluid paddingopx">
			<div class="row">
				<div class="col-md-12"style="margin-bottom: 30px;">
					<div class="row">
						<div style="margin-left:35px;">
							<?php
							$user_id = $_SESSION['uid'];
							$query = "SELECT product.pid, product.pname, product.image, product.cat_id, product.price, productcategory.catname FROM product INNER JOIN whishlist ON whishlist.pid = product.pid INNER JOIN productcategory ON productcategory.cat_id = product.cat_id WHERE whishlist.status = 1 AND whishlist.uid = '".$user_id."'AND product.status = 1 ORDER BY product.pname ASC";
							$result = $con->query($query);
							$num_rows = $result->num_rows;
							?>
							<h2>My wishlist </h2>
							<h4 class="text-muted"><?php echo $num_rows;?> item(s) sorts by <a style="color:#3aaaa3">Name</a>  <img src="img/ic_list_short_1.png"></h4>
						</div>
						<?php						
						if($num_rows > 0)
						{
							while($row = $result->fetch_assoc())
							{
								//echo "<pre>";
								//print_r($row);
								$pid=$row['pid'];
								$cat_id = $row['cat_id'];
								$prod_name = $row['pname'];
								$prod_image = $row['image'];
								$price = $row['price'];
								$cat_name = $row['catname'];
						?>	
						<div class="col-md-3">
							<img class="img-responsive" src="admin/uploads/product/<?php echo $prod_image;?>" alt="" style="background: #f5f5f5; height: 150px; width:350px" />
							<div class="text-center">
								<a href="details.php?pid=<?php echo $pid;?>"style="color:#333;text-decoration:none;">
								<p><?php echo $prod_name;?></p>
								<p><?php echo $cat_name;?></p>
								<img class="imgbright1" src="img/ic_rs_gray_16_px.png" /><span style="color:#d84a37;"><?php echo $price;?></span> </a>
								<form method= "POST" action="<?php echo $current_file; ?>">
									<input type="hidden" value = "<?php echo $pid; ?>" name="pid">
									<button  style="background-color:#3aaaa3;width:100%;padding: 0px 0px 0px 0px;border-radius: 0px;"type="submit" class="btn btn-default">
										<img src="img/ic_home_popular_cart.png">   <span style="color:white;font-size:18px;">  ADD TO CART</span>
									</button>
								</form>
							</div>
							<div class="text-center">
								<a href="removewish.php?pid=<?php echo $pid;?>"style="color: #3aaaa3 !important;text-decoration:none;">Remove</a>
							</div>
						</div>
						<?php
							}
						}
						else
						{
							echo "<div style='padding: 53px 0px 80px 36px; font-size: 20px; font-weight: 600; color: #d84a37;'>Sorry You are not choose any Product as a Wishlist</div>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
</div>
<?php
	require('footer.php');
	?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	
	
	<script src="js/price-range.js"></script>
	<script src="js/main.js"></script>
  </body>
</html>
<?php
}
else
{
	echo "Sorry YOU";
	header("login.php");
}
?>