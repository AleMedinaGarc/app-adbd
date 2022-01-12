<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";

$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

$url_id = $_GET['id'];
echo $url_id;
echo 'uwu';
$sql = "DELETE FROM PURCHASES WHERE IDPurchase='$url_id'";

if ($db->query($sql) === TRUE) {
  echo "Producto eliminado con exito";
  header("Location: ../purchases.php");
    exit;
} else {
  echo "Error: " . $sql . ":-" . mysqli_error($db);
}

mysqli_close($db);
