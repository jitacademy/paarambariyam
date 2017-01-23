<?php
include('admin/includes/connect.php');
include("admin/includes/core.php");
include("admin/includes/cart.php");
require('header.php');
?>
  <body>

    <div class="container-fluid paddingopx">
	<?php 
	require('topmenu.php');
	?>
	
	<section id="cart_items ">
	<div class="jumbotron">
		<div class="container ">
			<div class="row ">
			<div class="col-md-12">
			<p><span style="font-size:34px;padding-bottom:90px;font-family: OpenSans-light">My Selected Cart</span><span class="text-muted"style="font-size:20px;color:#666666;"> (<?php echo $cart_count;?> items)</span></p>
		
			<div  class="table-responsive cart_info">
				<table style="background-color:white;"class="table table-bordered">
					<thead>
						<tr class="cart_menu">
							<td class="image"></td>
						<td class="description"style="color:#666666;">ITEM</td>
						<td class="quantity"style="text-align:center;">QTY</td>
							<td class="price"style="text-align:center;">PRICE</td>
							<td class="total"style="text-align:center;">SUBTOTAL</td>
							
						</tr>
						
					</thead>
					<tbody>
					<form action="<?php echo $current_file;?>" method="POST"> 
					<?php
				
						$cart_count = count($_SESSION["cart"]);
						$total = 0;
					if(isset($_SESSION[cart])){
						while (list ($key, $val) = each ($_SESSION['cart'])) { 
						$sql = "SELECT * FROM `product` WHERE `pid` = $val";
						$result = $con->query($sql);

						if ($result->num_rows > 0) {
   

							while($row = $result->fetch_assoc()) {	
								$rid = $row["pid"];
							   $image =  $row["image"];
							   $pname = $row["pname"];
							   $price = $row["price"];	
							   $brand = $row["brand"];
							   $price = $row["price"];
							   $subtotal = $_SESSION['qty'][$key]*$price;
							   $total = $total + $subtotal;
							   
					
					?>
					
						<tr>
							<td class="cart_product">
								<a href=""><img style="margin-left:10px; width:150px;" src="admin/uploads/product/<?php echo $image;?>"/></a>
							</td>
							<td class="cart_description">
								<h4><a style="text-decoration: none;color:#000000;" href=""><?php echo $pname; ?></a><span style="color:#cccccc;"></span></h4>
								<p style="text-decoration: none;color:#000000;"><span style="color:#cccccc;"> BRAND :</span> <?php echo $brand; ?></p>
								<div style="float: right; margin-right: 8px;">
								<table><tr><td>
								<a href="#" style="text-decoration: none;color:#3aaaa3;font-size:18px;">MOVE TO WISHLIST</a></td><td>
								<span style="border:0.5px solid;color:#cccccc;margin-left:8px;"></span></td>
								<td>
								
								<button type="submit" value="<?php echo $key; ?>" name="rid"								style="border: 0; background: transparent;text-decoration: none;color:#3aaaa3;font-size:18px;">REMOVE</button>
								</td></tr></table>
								</div>
							</td>
							
							<td class="product_price"><?php echo $price; ?></td>
							<td><input type="text" name="qty" id="<?php echo $key; ?>" class="product_qty" value="<?php echo $_SESSION['qty'][$key];?>"></td>
							<td class="amount_sub_total"><?php echo $price*$_SESSION['qty'][$key]; ?></td>

							
						</tr>
						
						<?php
							}
							}
							
						}
					}
						?>


						<tr class="cart_table_bottom_row"style="text-align:center;">
							<td colspan="3" style="padding-right: 0px;"><span class="cart_table_bottom_row_col1">Amount payable  </span>
							</td>
							<td >&nbsp;</td>
							<td id="total_amount">
							<?php echo $total;  ?>
							
							</td>
						</tr>
						
					</tbody>
					</form>
				</table>
			
			</div>
			
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">
							 <a href="list-item.php">
							<button type="button" class="btn btn-default" style="background-color:gray;color:white;width:212px;padding:8px;margin-left:120px;">
							 CONTINUE SHOPPING
							</button></a>
						</div>
						<div class="col-md-6">
							 <a href="checkout.php">
							<button type="button" class="btn btn-default" style="background-color:#3aaaa3;color:white;width:212px;padding:8px;margin-left:60px;">
								PLACE ORDER
							</button></a>
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
	</section>
	
		
	<?php
	require('footer.php');
	?>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>