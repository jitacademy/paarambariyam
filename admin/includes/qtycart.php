<?php
session_start();
$id = $_GET['id'];//say 2
$new_value =$_GET['value'];//say 16

        //assign new value to the quantity
        $_SESSION['qty'][$id]=$new_value;
		