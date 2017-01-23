<?php
function generateFileName()
{
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789_";
$name = "";
for($i=0; $i<12; $i++)
$name.= $chars[rand(0,strlen($chars))];
return $name;
}
//get a random name of the file here
 $image = generateFileName();
 //$fileName;
  $imageFileType = pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);

$target_dir = "uploads/product/";
//$target_file = $target_dir . $image.".".$imageFileType."<br>";
 $target_file = $target_dir . $image.".".$imageFileType;
 $image =  $image.".".$imageFileType;
 $uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["productupdate"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 1000000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		//echo "The file ". $image. " has been uploaded.";
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}
?>




<?php
function generateFileName1()
{
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789_";
$name = "";
for($i=0; $i<12; $i++)
$name.= $chars[rand(0,strlen($chars))];
return $name;
}
//get a random name of the file here
 $image1 = generateFileName1();
 //$fileName;
  $image1FileType = pathinfo($_FILES["image1"]["name"],PATHINFO_EXTENSION);

$target_dir = "uploads/product/";
//$target_file = $target_dir . $image1.".".$image1FileType."<br>";
 $target_file = $target_dir . $image1.".".$image1FileType;
 $image1 =  $image1.".".$image1FileType;
 $uploadOk = 1;

// Check if image1 file is a actual image1 or fake image1
if(isset($_POST["brandupdate"])) {
    $check = getimagesize($_FILES["image1"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image1 - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image1.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image1"]["size"] > 1000000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($image1FileType != "jpg" && $image1FileType != "png" && $image1FileType != "jpeg"
&& $image1FileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
		//echo "The file ". $image1. " has been uploaded.";
        //echo "The file ". basename( $_FILES["image1"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}
?>


<?php
function generateFileName2()
{
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789_";
$name = "";
for($i=0; $i<12; $i++)
$name.= $chars[rand(0,strlen($chars))];
return $name;
}
//get a random name of the file here
 $image2 = generateFileName2();
 //$fileName;
  $image2FileType = pathinfo($_FILES["image2"]["name"],PATHINFO_EXTENSION);

$target_dir = "uploads/product/";
//$target_file = $target_dir . $image2.".".$image2FileType."<br>";
 $target_file = $target_dir . $image2.".".$image2FileType;
 $image2 =  $image2.".".$image2FileType;
 $uploadOk = 1;

// Check if image2 file is a actual image2 or fake image2
if(isset($_POST["certificateupdate"])) {
    $check = getimagesize($_FILES["image2"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image2 - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image2.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image2"]["size"] > 1000000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($image2FileType != "jpg" && $image2FileType != "png" && $image2FileType != "jpeg"
&& $image2FileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file)) {
		//echo "The file ". $image2. " has been uploaded.";
        //echo "The file ". basename( $_FILES["image2"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}

?>


<?php
function generateFileName3()
{
$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789_";
$name = "";
for($i=0; $i<12; $i++)
$name.= $chars[rand(0,strlen($chars))];
return $name;
}
//get a random name of the file here
 $catimage = generateFileName3();
 //$fileName;
   $catimageFileType = pathinfo($_FILES["catimage"]["name"],PATHINFO_EXTENSION);

$target_dir = "uploads/category/";
//$target_file = $target_dir . $catimage.".".$catimageFileType."<br>";
  $target_file = $target_dir . $catimage.".".$catimageFileType;
 $catimage =  $catimage.".".$catimageFileType;
 $uploadOk = 1;

// Check if catimage file is a actual catimage or fake catimage
if(isset($_POST["addproduct"])) {	
    $check = getimagesize($_FILES["catimage"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an catimage - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an catimage.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["catimage"]["size"] > 1000000) {
   // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($catimageFileType != "jpg" && $catimageFileType != "png" && $catimageFileType != "jpeg"
&& $catimageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["catimage"]["tmp_name"], $target_file)) {
		//echo "The file ". $catimage. " has been uploaded.";
        //echo "The file ". basename( $_FILES["catimage"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}
?>

