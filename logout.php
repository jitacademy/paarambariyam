<?php
require "admin/includes/connect.php";
session_unset("uid");
session_unset("role"); 
require('header.php');
?>
 <body>

  <?php
		require('topmenu.php');
		?>
    <div class="container-fluid paddingopx">
	<section>
		<div class="container-">
			<div class="row" style="padding: 36px;  background: #f5f5f5;  margin-top: 13px; border-radius: 17px;">
				<div class="col-md-12"style="margin-bottom: 30px;">
					<div class="row">
						<div style="padding: 5px 0px 5px 32px;" class="alert alert-success">
							<p style="font-size: 20px;">You are Successfully logout</p>
							<p style="font-size: 20px;">Thank you Visit Again</p>
						</div>
						<div class="loginouter">
					<div class="loginrow" style="text-align: center;">
						<img class="" src="img/smalllogowhite.jpg">
					</div>
					<div class="loginrow">
						<div style="font-size: 20px;text-align: center;padding-bottom: 5px;">Good for Nature, Good for you</div>
						<div style="font-size: 13px; text-align: center; padding-bottom: 5px;">Get started to lead a more organic life style</div>
					</div>
					<?php
					if($error!="")
					{
					?>
					<div class="loginrow">
						<div class="alert-danger padding15px">
							<?php echo $error;?>
						</div>
					</div>
					<?php
					}
					?>
					<form name="loginform" method="POST" action="login.php">
						<div class="fullrowlogin">
							<div class="loginrow">
								<input type="email" name="email" class="logininput" placeholder="Email" />								
							</div>
							<div class="loginrow">
									<input type="password" name="pass" class="logininput" placeholder="Password"/>								
							</div>
							<div class="loginrow" style="text-align: center;">
								<input type="submit" value="LOGIN" name="submit" class="btnsumit" style="width: 100%; padding: 8px;"/>
							</div>
						</div>
					</form>
					<div class="modal-bottom-login">
						<p><a href="forgetpassword.php">Forget password?</a></p>
						<p><span class="modal-login-signp">Dont have an account?  </span><a href="signup.php" class="modal-login-sign">Get started</a></p>
					  </div>
				</div>
				</div> 
						
					</div>
				</div>
			</div>
		</div>
	</section>
	
</div>
<?php
	require('footer.php');
?>
<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	
	
	<script src="js/price-range.js"></script>
	<script src="js/main.js"></script>
  </body>
</html>