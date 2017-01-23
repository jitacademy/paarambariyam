<?php
include("admin/includes/core.php");
include("admin/includes/cart.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Paarambariyam Home</title>

    <meta name="description" content="General health products">
    <meta name="author" content="Paarambariyam">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="js/scripts.js"></script>
	  <script>
		var hash = '<?php echo $hash ?>';
		function submitPayuForm() {
		  if(hash == '') {
			return;
		  }
		  var payuForm = document.forms.payuForm;
		  payuForm.submit();
		}
  </script>
	  </head>