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

<?php
include "static/footer.php";

} else{
header('Location: ./index.php');
}
} else {

header('Location: login.php');

}
?>