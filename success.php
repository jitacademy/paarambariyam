<?php
include('admin/includes/connect.php');
$status=$_POST["status"];
$billname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="yIEkykqEH3";
$userid = $_SESSION['uid'];
$paymode = "PAYUMONEY";
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$district = $_POST["district"];
$state = $_POST["state"];
$country = $_POST["country"];
$postalcode = $_POST["zipcode"];
$userip = $_SERVER['REMOTE_ADDR'];

	$sql = "SELECT `refid` FROM `users` WHERE `uid`='$userid'";
								$result = $con->query($sql);
								if ($result->num_rows > 0) 
								{
								while($row = $result->fetch_assoc()) 
									{
								$refid =  $row["refid"];

									}
								} else {
									$refid = "0";
								}

$query = "INSERT INTO `bill`(`billid`, `invoiceno`, `userid`, `amount`, `paymode`, `comments`, `billname`, `address1`, `address2`, `district`, `state`, `country`, `refid`, `postalcode`, `userip`, `billtime`, `orderstatus`, `status`) VALUES ('','$txnid','$userid','$amount','$paymode','','$billname','$address1','$address2','$district','$state','$country','$refid','$postalcode','$userip',NOW(),'1','1')";

$result = mysqli_query($con, $query);
if($result)
{


						while (list ($key, $val) = each ($_SESSION['cart'])) { 
						$qty = $_SESSION['qty'][$key];
						$qry33 = "INSERT INTO `billdetail`(`billdetail_id`, `txnid`, `pid`, `qty`) VALUES ('','".$txnid."','$val','$qty')";
						
						$result33 = mysqli_query($con, $qry33);
						}
						unset($_SESSION['cart']);
	unset($_SESSION['qty']);
header('Location: ./orderhistory.php');

	
	
}else{
	If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
 else {   
 
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
 
         }
 $hash = hash("sha512", $retHashSeq);
 
       if ($hash != $posted_hash) {
        echo "Invalid Transaction. Please try again";
    }
    else {
              
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
		  print_r($_POST);
           
    }         
	
}
 

?>