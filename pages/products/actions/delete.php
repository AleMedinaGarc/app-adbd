<?php

$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

$url_id = $_GET['ID'];
$sql = "DELETE FROM PRODUCTS WHERE ID='$url_id'";
  if ($db->query($sql) === TRUE) {
    echo "Producto eliminado con exito";
    header("Location: ../../../index.php");
    exit;
  } else {
    echo "Error: " . $sql . ":-" . mysqli_error($db);
  }

mysqli_close($db);
?>