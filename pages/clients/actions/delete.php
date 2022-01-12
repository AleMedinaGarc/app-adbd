<?php

$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

$url_email = $_GET['id'];
$sql = "DELETE FROM CLIENTS WHERE email='$url_email'";

if ($db->query($sql) === TRUE) {
  echo "Cliente eliminado con exito:";
  echo $url_email;
  header("Location: ../clients.php");
} else {
  echo "Error: " . $sql . ":-" . mysqli_error($db);
}

mysqli_close($db);
