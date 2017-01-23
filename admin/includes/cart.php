<?php

if(isset($_POST['pid'])){
if(empty($_SESSION["cart"])){
	$_SESSION["cart"] = array();
	$_SESSION["qty"] = array();
}
$pid = $_POST['pid'];

if (in_array($pid,$_SESSION["cart"]))
  {
  
  }
else
  {
array_push($_SESSION["cart"],$_POST['pid']);
array_push($_SESSION["qty"],1);
  }



}
if(isset($_GET['pid'])&&isset($_GET['Status'])){
if(empty($_SESSION["cart"])){
	$_SESSION["cart"] = array();
	$_SESSION["qty"] = array();
}
$pid = $_GET['pid'];

if (in_array($pid,$_SESSION["cart"]))
  {
  
  }
else
  {
array_push($_SESSION["cart"],$_GET['pid']);
array_push($_SESSION["qty"],1);
  }



}


if(isset($_POST['rid'])){
	
	$rid = $_POST['rid'];
	 unset($_SESSION['cart'][$rid]);
	 unset($_SESSION['qty'][$rid]);
	
}
$cart_count = count($_SESSION["cart"]);

//For Currency


							if(isset($_POST['inr'])){
								 $_SESSION["currency"] = "INR";
								
							} else if(isset($_POST['usd'])){
								 $_SESSION["currency"] = "USD";
							}



?>