<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

if(isset($_POST['submit']))
{   

$nameItem = mysqli_real_escape_string($db, $_REQUEST['nameItem']);
$stock = mysqli_real_escape_string($db, $_REQUEST['stock']);
$size = mysqli_real_escape_string($db, $_REQUEST['size']);
$weight = mysqli_real_escape_string($db, $_REQUEST['weight']);
$price = mysqli_real_escape_string($db, $_REQUEST['price']);
$family = mysqli_real_escape_string($db, $_REQUEST['family']);
$descr = mysqli_real_escape_string($db, $_REQUEST['descr']);

$sql = "INSERT INTO `app-tienda`.`PRODUCTS` (`nameItem`, `stock`, `size`, `weight`, `price`, `family`, `descr`)
VALUES ('$nameItem', '$stock', '$size', '$weight' , '$price', '$family', '$descr')";

if ($db->query($sql) === TRUE) {
  echo "New record created successfully";
  header("Location: ../../../index.php");
  exit;
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

}
mysqli_close($db);
?>