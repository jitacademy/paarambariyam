<?php
require "admin/includes/connect.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
	header('Location: ./index.php');
}
else
{	
	require('header.php');
?>
<body>
<?php
	require('topmenu.php');	
?>
<?php
if(isset($_POST['submit']))
{ 
 mysql_connect('localhost','root','mysql') or die(mysql_error());
 mysql_select_db('Paarambariyam') or die(mysql_error());
 $email=$_POST['email'];
 $error = "";
 $success = "";
 $mailmsg = "";
 $query=mysql_query("select * from users where email='".$email."' ") or die(mysql_error());
 $row=mysql_affected_rows();
 if($row!=0) 
 {
  $result=mysql_fetch_array($query);
  $to=$result['email'];
  
  function randomString($length) 
{
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) 
	{
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
  
  $rand = randomString(16);
  
				$sql="UPDATE `users` SET `forgetpass`='".$rand."',`role`=2,`status`=1 WHERE `email`='$email'" ;
				$res = mysqli_query($con, $sql);	
				if($res)
				{
					 //$success = "Your information saved successfully";
					 $mailmsg = "Check your inbox in email and reset your password";
					 }
				else
				{
					 //$error = "Sorry your information not saved".mysql_error();
				
				}
				$query1=mysql_query("select * from users where forgetpass='".$rand."' ") or die(mysql_error());
				$row1=mysql_affected_rows();
				$result1=mysql_fetch_array($query1);
				$forgetpass=$result1['forgetpass'];
				$email=$result1['email'];
				$to=$email;
				$url = "http://www.paarambariyam.com/password_reset.php?email=<?php echo $email?>&forgetpass=<?php echo $forgetpass?> ";
				$body  =  "Paarambariyam password recovery Script
				-----------------------------------------------
				Url : $url;
				email Details is : $to;
				Here is your password Update Link  : $url;
				Sincerely,
				Paarambariyam";
				$subject='Remind password';
				$message='Your password Key : '.$result['forgetpass']; 
				$headers='From:paarambariyam@gmail.com';
				$sentmail=mail($to,$subject,$message,$body,$headers);
  if($sentmail)
  {
    echo'Check your inbox in email';
  }
  else
  {
   echo'email is not send';
  }
 }
 else
 {
  echo'You entered email id is not present';
 }
}	
?>		
	
    <section>
	<div class="container-fluid " style="background-color:#f5f5f5;">
	<div class="row" >			
	<div class="col-md-12"style="margin-bottom: 30px;">							
	<div class="col-md-6" style="background-color:white;margin-top:35px;">
	<div class="modal-logo">
			<img class="" src="img/smalllogowhite.jpg" />
		</div>
		<h4 class="text-center fontsize24">Enter Your Email Address</h4>
		<p class="text-center fontsize16 text-muted">We'll get you back on track</p>
		<p class="text-center fontsize16 text-success"><?php echo $mailmsg;?></p>
	<div class="modal-body">
	<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
	<div class="form-group">
	<input type="email" class="form-control inputreg" placeholder="Email Address *" name="email" id="email" required="required" value="<?php echo $email?>"/>
	</div>				
	<input type="submit" class="btn regbtn" value=" Request Reset link" name="submit"/>
	</form>
	</div>
	</div>
	</div>
	</div>
	</div>
	</section>
 

	<div>
	<?php
	require('footer.php');
	?>
	</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php
}
?>