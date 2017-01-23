<?php
require "includes/connect.php";

if(isset($_SESSION["uid"]) && isset($_SESSION["role"])) 
{
if($_SESSION["role"] == 1) 
{
$uid = $_SESSION["uid"];
$role = $_SESSION["role"];
include "static/head.php";
include "static/sidebar.php";
include "static/header.php";
if(isset($_POST['submit'])){

if(isset($_POST['wname']) || isset($_POST['rpercent']) || isset($_POST['dpercent']) || isset($_POST['fburl']) || isset($_POST['turl']) || isset($_POST['gurl']) || isset($_POST['yurl']) || isset($_POST['payusalt']) || isset($_POST['payukey']) || isset($_FILES['logo']))
{
	$error="";
	$status="ok"; 
	
	function test_input($data)
	{
		
		$data = trim($data);
		$data = stripslashes($data);
		return $data;
	}
	if($_POST['wname']!="")
	{
		$wname = test_input($_POST['wname']);
	}
	if($_POST['rpercent']!="")
	{
		$rpercent = test_input($_POST['rpercent']);
	}
	if($_POST['dpercent']!="")
	{
		$dpercent = test_input($_POST['dpercent']);
	}
	if($_POST['fburl']!="")
	{	
		$fburl = test_input($_POST['fburl']);
	}
	if($_POST['turl']!="")
	{
		$turl = test_input($_POST['turl']);
	}
	if($_POST['gurl']!="")
	{
		$gurl = test_input($_POST['gurl']);
	}
	if($_POST['yurl']!="")
	{
		$yurl = test_input($_POST['yurl']);
	}
	if($_POST['payusalt']!="")
	{
		$payusalt = test_input($_POST['payusalt']);
	}
	if($_POST['payukey']!="")
	{
		$payukey = test_input($_POST['payukey']);
	}
	if($_POST['donate_amt']!="")
	{
		$donate_amt = test_input($_POST['donate_amt']);
	}
	else if(is_numeric($_POST['donate_amt']))
	{
		$error .= "Donate amount should be numeric";
		$status = "NOTOK";
	}		
	if($_FILES['logo']['name']!="")
	{
		function generateFileName()
		{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789_";
		$name = "";
		for($i=0; $i<12; $i++)
		$name.= $chars[rand(0,strlen($chars))];
		return $name;
		}
		$fileName = generateFileName();
		$imageFileType = pathinfo($_FILES["logo"]["name"],PATHINFO_EXTENSION);
		$target_dir = "uploads/frontlogo/";
		$target_file = $target_dir . $fileName.".".$imageFileType;
		if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) 
		{
			$image =  $fileName.".".$imageFileType;
		}
		else
		{
			echo "sorry";
		}
	}
	else
	{
		$image = $_POST['image'];
	}
	
	if($status=="ok")
	{
		$count_query = "SELECT COUNT(*) AS count FROM `sitesettings`";
		$count_result = $con->query($count_query);
		$count_row = $count_result->fetch_assoc();
		if($count_row['count']==0)
		{
			$query = "INSERT INTO `sitesettings`(`websitename`, `logo`, `referalpercent`, `distributionpercent`, `fb`, `twitter`, `google`, `youtube`, `payusalt`, `payukey`,`donate_amt`) VALUES ('".$wname."','".$image."',".$rpercent.",".$dpercent.",'".$fburl."','".$turl."','".$gurl."','".$yurl."','".$payusalt."','".$payukey."',".$donate_amt.")";
			$result = $con->query($query);
			if($result)
			{
				
				$success = "Your information saved successfully";
				
			}
			else
			{
				$error .= "Sorry your information not saved".$con->error;
			
			}
		}
		else
		{
			$query_update = "UPDATE `sitesettings` SET `websitename`='".$wname."',`logo`='".$image."',`referalpercent`=".$rpercent.",`distributionpercent`=".$dpercent.",`fb`='".$fburl."',`twitter`='".$turl."',`google`='".$gurl."',`youtube`='".$yurl."',`payusalt`='".$payusalt."',`payukey`='".$payukey."',,`donate_amt`=".$donate_amt."";
			$result = $con->query($query_update);
			if($result)
			{
				
				$success = "Your information UPDATE successfully";
				
			}
			else
			{
				$error = "Sorry your information not saved".$con->error;
			
			}
		}
	}			
}
		
}
else
{
	echo "PLEASE FILL ALL DETAILS";
}
?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Site Settings</h3>
              </div>
</div>
             
            <div class="clearfix"></div>
				<div class="row">
					<div class="x_content">
                    <br />
					<?php
					$query_select = "SELECT `websitename`, `logo`, `referalpercent`, `distributionpercent`, `fb`, `twitter`, `google`, `youtube`, `payusalt`, `payukey` FROM `sitesettings`";
					$run_select = $con->query($query_select);
					$row_select = $run_select->fetch_assoc();
					$wname = $row_select['websitename'];
					$image = $row_select['logo'];
					$rpercent = $row_select['referalpercent'];
					$dpercent = $row_select['distributionpercent'];
					$fburl = $row_select['fb'];
					$turl = $row_select['twitter'];
					$gurl = $row_select['google'];
					$yurl = $row_select['youtube'];
					$payusalt = $row_select['payusalt'];
					$payukey = $row_select['payukey'];
					$donate_amt = $row_select['donate_run'];
					?>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" method="POST">
						<div style="color:red;"><?php echo $error;?></div><div style="color:green;"><?php echo $success;?></div>	  
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Website Name
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							  <input type="text" name="wname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $wname?>"placeholder="Website Name">
							</div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Logo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="logo" class="form-control col-md-7 col-xs-12">
						  <input type="hidden" name="image" value="<?php echo $image;?>">
                        </div>
                      </div>
					  <?php
					  if($image != "")
					  {
					  ?>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Logo Preview
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="uploads/frontlogo/<?php echo $image;?>" class="form-control col-md-7 col-xs-12" style="width:160px; height:150px;"/>
                        </div>
                      </div>
					  <?php
					  }
					  ?>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Referal Percent
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="rpercent" class="form-control col-md-7 col-xs-12" value="<?php echo $rpercent;?>"placeholder="Referal Percent">
                        </div>
                      </div>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Distributer Percent <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="dpercent" class="form-control col-md-7 col-xs-12" value="<?php echo $dpercent;?>" placeholder="Distributer Percent">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Facebook URL 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="fburl" class="form-control col-md-7 col-xs-12" value="<?php echo $fburl;?>" placeholder="Facebook URL">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Twitter URL</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  class="form-control col-md-7 col-xs-12" type="text" name="turl" value="<?php echo $fburl;?>" placeholder="Twitter URL">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Google URL
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="gurl" class="form-control col-md-7 col-xs-12" value="<?php echo $gurl;?>"placeholder="Google URL">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Youtube URL
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="yurl"  class="form-control col-md-7 col-xs-12" value="<?php echo $yurl; ?>"placeholder="Youtube URL">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">PAY U SALT
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="payusalt"  class="form-control col-md-7 col-xs-12" value="<?php echo $payusalt;?>" placeholder="PAY U SALT">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PAY U KEY
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="payukey"  class="form-control col-md-7 col-xs-12" value="<?php echo $payukey;?>" placeholder="PAY U KEY">
                        </div>
                      </div>
					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Donate Amount
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="donate_amt"  class="form-control col-md-7 col-xs-12" value="<?php echo $donate_amt;?>" placeholder="Enter the user Donate amount">
                        </div>
                      </div>
					  <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="addproduct.php" class="btn btn-primary">Cancel</a>
                          <input type="submit" class="btn btn-success" name="submit" value="Submit">
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

   </div>
            </div>

<?php
include "static/footer.php";

} else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>