
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
 $fileName = generateFileName();
 //$fileName;
  $imageFileType = pathinfo($_FILES["fileName"]["name"],PATHINFO_EXTENSION);
 
$target_dir = "admin/uploads/user/";


//$target_file = $target_dir . $fileName.".".$imageFileType."<br>";
 $target_file = $target_dir . $fileName.".".$imageFileType;
 $image =  $fileName.".".$imageFileType;
$uploadOk = 1;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileName"]["tmp_name"]);
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
if ($_FILES["fileName"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    //echo "Sorry, only JPG, JPEG, PNG  files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileName"]["tmp_name"], $target_file)) {
        //echo "The file ". $fileName. " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}
?>

