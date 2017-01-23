<?php
include('admin/includes/connect.php');
include("admin/includes/core.php");
include("admin/includes/cart.php");
if(!isset($_SESSION["uid"]) && !isset($_SESSION["role"])) {
	header('Location: ./login.php');
} else {
	$uid = $_SESSION['uid'];	


// Merchant key here as provided by Payu
$MERCHANT_KEY = "hDkYGPQe";

// Merchant Salt as provided by Payu
$SALT = "yIEkykqEH3";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://test.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;
if(isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address1']) && isset($_POST['address2']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country']) && isset($_POST['zipcode'])){
if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
} else {
	$formError = 1;
}
include('header.php');
?>


  <body onload="submitPayuForm()">

    <div class="container-fluid paddingright0px paddingleft0px">
	<?php
	require('topmenu.php');
	
	?>	
	<div class="jumbotron">					
			<h2 style="padding-left:100px;font-size:30px;"><b>Check Out(<?php echo $cart_count ; ?> Itmes)</b>
			<?php if($formError) { ?>
	
      <span style="color:red; font-size:20px; padding-left: 570px;">Please fill all mandatory fields.</span>
     
    <?php } ?>
	 </h2>
			<div class="row">
				<div class="col-md-12">
					<style>
							table {
								border-collapse: collapse;
								width: 1000px;
							}

							th, td {
								text-align: left;
								padding: 19px;
							}

							tr:nth-child(even){background-color: white}

							th {
								background-color: gray;
								color: white;
								width: 100%;
							}
							tr
							{background-color: #f2f2f2;
							}
							
							
							</style>
							</head>
							<body>

							<?php
								
								$sql = "SELECT * FROM `users` WHERE `uid`='$uid'";
								$result = $con->query($sql);
								if ($result->num_rows > 0) 
								{
								while($row = $result->fetch_assoc()) 
									{
								$name =  $row["name"];
								$gender =  $row["gender"];
								$email =  $row["email"];
								$address1 =  $row["address1"];
								$address2 =  $row["address2"];
								$district =  $row["district"];
								$state =  $row["state"];
								$country =  $row["country"];
								$pincode =  $row["pincode"];
								$refid =  $row["refid"];
								$phone = $row["phone"];
								$username = $row["username"];
							?>
							<?php
									}
								}
								
							?>
							
							<CENTER><table></CENTER>
							<form action="<?php echo $action; ?>" method="post" name="payuForm">
							  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
							  <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
							  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
							<tr>
							<th><h3>1.LOGIN ID</h3></th>
							</tr>
							<tr>
							<td>
							<div class="col-md-6">
							<img class="imgbright1" src="img/b.png"/>
							<div class="modal-body" style="margin-left: 45px;">
							<h4>Name : <?php echo $name;?></h4>
							<input type="hidden" name="firstname" value="<?php echo $name;?>"/>
							
							</div>
							</div>
							</div>
							</td>
							</tr>
							<tr>
							<th><h3>2.DELIVERY SYSTEM</h3></th>
							</tr>
							<tr>
							<td>
							<div  class="row">
							
							<div class="col-md-6">
							<img class="imgbright1" src="img/b.png"/>
							<h4 class="text-center fontsize24"> </h4>
							<div class="modal-body" style="margin-left: 45px;">
							 <table>
        
      
        <tr>
          <td>Email: </td>
          <td><input name="email" id="email" value="<?php 
		  if($email){
		  echo $email;
		  }else {
			  echo $_POST[email];
		  }
		  
		  ?>"  required /><span style="color:red;">*</span></td>
          
		  <td>Phone: </td>
          <td><input name="phone" value="<?php 
		  if($phone){
		  echo $phone;
		  }else {
			  echo $_POST[phone];
		  }
		  
		  ?>" required /><span style="color:red;">*</span></td>
        </tr>
      
        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
          <td>Address1: </td>
          <td><input name="address1" value="<?php 
		  if($address1){
		  echo $address1;
		  }else {
			  echo $_POST[address1];
		  }
		  
		  ?>" required /><span style="color:red;">*</span></td>
          <td>Address2: </td>
          <td><input name="address2" value="<?php 
		  if($address2){
		  echo $address2;
		  }else {
			  echo $_POST[address2];
		  }
		  
		  ?>" required /><span style="color:red;">*</span></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city" value="<?php 
		  if($city){
		  echo $city;
		  }else {
			  echo $_POST[city];
		  }
		  
		  ?>" required /><span style="color:red;">*</span></td>
          <td>State: </td>
          <td><input name="state" value="<?php 
		  if($state){
		  echo $state;
		  }else {
			  echo $_POST[state];
		  }
		  
		  ?>" required /><span style="color:red;">*</span></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input name="country" value="<?php 
		  if($country){
		  echo $country;
		  }else {
			  echo $_POST[country];
		  }
		  
		  ?>"  /><span style="color:red;">*</span></td>
          <td>Zipcode: </td>
          <td><input name="zipcode" value="<?php 
		  if($pincode){
		  echo $pincode;
		  }else {
			  echo $_POST[pincode];
		  }
		  
		  ?>" required /><span style="color:red;">*</span></td>
        </tr>
        
    
      </table>
							
							
							</td>
							</tr>
							<tr>
							<th><h3>3.ORDER SUMMARY</h3></th>
							</tr>
							<tr>
							<td>

							
						<div class="col-md-12">
						<?php
						$cart_count = count($_SESSION["cart"]);
							$total = 0;
							if(isset($_SESSION[cart]))
							{
							while (list ($key, $val) = each ($_SESSION['cart'])) 
								{ 
							$sql = "SELECT * FROM `product` WHERE `pid` = $val";
							$result = $con->query($sql);
							if ($result->num_rows > 0)
									{
							while($row = $result->fetch_assoc()) 
										{	
										$rid = $row["pid"];
									   $price = $row["price"];
									   $subtotal = $_SESSION['qty'][$key]*$price;
									   $total = $total + $subtotal;
									
										}
									}
								}
							}
						?>
						<h4 class="text-center fontsize24"> </h4>
						<div class="row">
						<span><a  href="cart.php" style=" color:#3aaaa3; float:right;"><b>REVIEW ORDER : <img class="imgbright1" src="img/g.png"/> </a></span>
						<div class="col-md-6">
						<img class="imgbright1" src="img/b.png"/>
						<div class="modal-body" style="margin-left: 45px;">
						<div class="text-success"> <?php echo $success;?></div>
						
						<div class="form-group">
							<div class="inputreg">Toatal Amount : <span style="float:right;"><img  src="img/ic_home_rs_red_16_px.png"/><span style="color:red;"></span><?php echo $total;  ?></span>
							<input type="hidden" name="total" value="<?php echo $total;  ?>"/>
							</div>
							</div>
							<div class="form-group">
							<div class="inputreg">VAT 14% : 	<span style="float:right;"><img  src="img/ic_home_rs_red_16_px.png"/><span style="color:red;"></span><?php  $vat = $total * 14/100;  echo $vat ;?></span>
							<input type="hidden" name="vat" value="<?php   echo $vat ;?>"/>
							</div>
							</div>
							<div class="form-group">
							<div class="inputreg">Service Tax 4%: <span style="float:right;"><img  src="img/ic_home_rs_red_16_px.png"/><span style="color:red;"></span><?php $tax = $total * 4/100; echo $tax ;?></span>
							<input type="hidden" name="tax" value="<?php echo $tax ;?>">
							</div>
							</div>
							<div class="form-group">
							<div class="inputreg">Donation For Scanfoundation: <span style="float:right;"><img  src="img/ic_home_rs_red_16_px.png"/><span style="color:red;"></span><?php $fund = 5; echo $fund ;?></span>
							<input type="hidden" name="fund" value="<?php echo $fund ;?>"/>
							</div>
							</div>
							<div class="form-group">
							<div class="inputreg">Grand Total : <span style="float:right;"><img  src="img/ic_home_rs_red_16_px.png"/><span style="color:red;"></span><?php  $grand_total = $total + $vat + $tax + $fund ;echo $grand_total;?></span>
							<input type="hidden" name="amount" value="<?php echo $grand_total;?>"/>
							
							<input type="hidden" name ="productinfo" value="Grocery">
							
							<input type="hidden" name ="surl" value="http://localhost/p25/success.php">
							<input type="hidden" name ="furl" value="http://localhost/p25/failure.php">
							<input type="hidden" name ="curl" value="http://localhost/p25/cancel.php">
							<input type="hidden" name="service_provider" value="payu_paisa" size="64" />
							</div>
							</div>
						</div>
						</div>
						</div>
						
						
						<div>
						
						<input type="submit" class="btn" style="width: 50%;color: white;background: #3aaaa3;border-radius: 0px;font-size: 20px;float: right;" value="Pay Now"/>
					
						</div>
						</form>
						</div>
						</td>
						</tr>
						</form>
						</table>				
						</div>
						</div>	
							
					</div>
<div>
	<?php
	require('footer.php');
	?>
	</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
<?php
}
?>