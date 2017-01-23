<?php
require "includes/connect.php";
include "static/head.php";
if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) {
	 if($_SESSION["role"] == 1) {
		header('Location: index.php'); 
	 }else{
		 header('Location: ../index.php');
		 
	 }
}else{
if(isset($_POST['uname']) && isset($_POST['password'])){
	$uname = htmlspecialchars($_POST['uname']);
	$password =$_POST['password'];
	$pass_hash = md5($password);
	
$sql = "SELECT `uid`,  `role`, `status` FROM `users` WHERE `username` = '$uname' AND `password` = '$pass_hash'";

$result = $con->query($sql);


if ($result->num_rows > 0) {
   

    while($row = $result->fetch_assoc()) {
       $uid =  $row["uid"];
       $role = $row["role"];
       $status =  $row["status"];
if($status == 1) {
$_SESSION["uid"] = $row["uid"];
$_SESSION["role"] = $row["role"];
header('Location: index.php');

}

    }
}
		
	
}
}

?>



<body class="login">
    <div>
 

      <div class="login_wrapper">
        <div class="animate form login_form">
		 
              
               
              
			 
          <section class="login_content">
		   <img src="images/img_logo.png" >
            <form method="post" action="login.php">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="uname" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" name="enter" class="btn btn-default submit" value="Login">
               
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />

                <div>
                 
                  <p>Copyright © Paarambariyam 2016. All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

         </div>
    </div>
  </body>
</html>
