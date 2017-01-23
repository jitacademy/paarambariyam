<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {



 if($_SESSION["role"] == 1) {

$uid = $_SESSION["uid"];
$role = $_SESSION["role"];

include "static/head.php";
include "static/sidebar.php";
include "static/header.php";

?>
<div class="right_col" role="main">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Distributer Payment List </h2>
                    
                        
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<?php
    		        if(isset($_POST['paydis']))
					{
						$uid = $_POST['uid'];
						$mode = $_POST['mode'];
						$transid = $_POST['transid'];
						$reqamt = $_POST['reqamt'];
						$rid = $_POST['rid'];
						if($uid == "" && $mode == "" && $transid == "" && $reqamt == "")
						{
							echo "<div class='alert alert-danger'>Please Enter All Fields. All are Mandatory";
						}
						else
						{
							$query_ins = "INSERT INTO `transaction`(`uid`, `paymentmode`, `amount`, `paymenttime`, `transid`, `status`) VALUES ('".$uid."','".$mode."',".$reqamt.",CURTIME(),'".$transid."',1)";
							$query_ins_res = $con->query($query_ins);
							if($query_ins_res)
							{
								echo $success = "<div class='alert alert-success'>Your Transaction Saved Successfully</div></br>";
								echo "<a href='payments.php' class='btn btn-primary'>BACK</a>";
								$update = "UPDATE `requestpayment` SET `status`= 2 WHERE `rid`=".$rid."";
								$update_res = $con->query($update);
							}
							else
							{
								echo "<div class='alert alert-danger'>Sorry your information not saved try again</div>";
							}
							
						}
					}
					?>
<?php
if(isset($_GET['rid']))
{
$rid = $_GET['rid'];
$sql = "SELECT `rid`, `uid`, `amount`, `status` FROM `requestpayment` WHERE rid=".$rid."";
$result = $con->query($sql);
if ($result->num_rows == 1) 
{
		$row = $result->fetch_assoc();
		//print_r($row);
       $rid =  $row["rid"];
       $uid = $row["uid"];
       $reqamt = $row["amount"];
       $status = $row["status"];
?>
 <table class="table">
                      
                      <tbody>
					  
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
	<tr>
		<td style="width: 50%; text-align: right;">Requested Amount:</td>
		<td style="width: 50%; text-align: left;"><?php echo $reqamt; ?></td>
		<input type="hidden" name="reqamt" value="<?php echo $reqamt;?>">
		<input type="hidden" name="uid" value="<?php echo $uid;?>">
		<input type="hidden" name="rid" value="<?php echo $rid;?>">
	</tr>
	<tr>
		<td style="width: 50%; text-align: right;">Mode:</td>
		<td style="width: 50%; text-align: left;">
		<select name="mode">
			<option value="BANK">BANK</option>
			<option value="NEFT">NEFT</option>
		</select>
		</td>
	</tr>
	<tr>
		<td style="width: 50%; text-align: right;">Transaction Id:</td>
		<td style="width: 50%; text-align: left;"><input type="text" name="transid" /></td>
	</tr>
	<tr>
		<td colspan="2" style="width: 100%; text-align: left;"><input type="submit" value = "submit" class="btn btn-success" name="paydis"></td>
	</tr>
</form>
<?php                     
}
	else
	{
		echo "<div class='alert alert-info'>No Rows Selected</div>";
	}
?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
</div>
</div>

<?php
include "static/footer.php";

} 
 }
else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>