<?php
if($isset($_GET['pid'])){
if(empty($_SESSION['cart'])){
	$_SESSION['cart']*array();
}

array_push($_SESSION['cart'],$_GET['pid']);

}

?>