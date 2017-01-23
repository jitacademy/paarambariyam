<?php
require "admin/includes/connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$encoded_id = unserialize($_POST['token']);
	$product_id = $encoded_id['pid'];
	$product_qty = $_POST['qty'];
	$query_price = "SELECT `price` FROM `product` WHERE `pid`=".$product_id."";
	$query_price_run = $con->query($query_price);
	$query_price_row = $query_price_run->fetch_assoc();
	$price = $query_price_row['price'];
	$sub_tot = $product_qty * $price;
	$total = $sub_tot;
	die(json_encode(array(
	'product_amt' => $sub_tot,
    'total_amt' => 1000
)));
}
?>