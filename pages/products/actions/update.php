<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');
$url_id = $_GET['id'];

if (isset($_POST['update'])) {
  $nameItem = mysqli_real_escape_string($db, $_REQUEST['nameItem']);
  $stock = mysqli_real_escape_string($db, $_REQUEST['stock']);
  $size = mysqli_real_escape_string($db, $_REQUEST['size']);
  $weight = mysqli_real_escape_string($db, $_REQUEST['weight']);
  $price = mysqli_real_escape_string($db, $_REQUEST['price']);
  $family = mysqli_real_escape_string($db, $_REQUEST['family']);
  $descr = mysqli_real_escape_string($db, $_REQUEST['descr']);


  $sql = "UPDATE `PRODUCTS`  
  SET nameItem='$nameItem', descr='$descr', stock='$stock', size='$size', price='$price', weight='$weight'  
  WHERE ID='$url_id'";

  if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
    mysqli_close($db);
    header("Location: ../../../index.php");
    echo exit;
  } else {
    echo "Error: " . $sql . ":-" . mysqli_error($db);
  }
}
