<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');
$url_id = $_GET['id'];

if(isset($_POST['update']))
{    
    $email = mysqli_real_escape_string($db, $_REQUEST['email']);
    $DNI = mysqli_real_escape_string($db, $_REQUEST['DNI']);
    $pc = mysqli_real_escape_string($db, $_REQUEST['pc']);
    $tlf = mysqli_real_escape_string($db, $_REQUEST['tlf']);
    $nameClient = mysqli_real_escape_string($db, $_REQUEST['nameClient']);
    $surname = mysqli_real_escape_string($db, $_REQUEST['surname']);
  

  $sql = "UPDATE `PRODUCTS`  
  SET email='$email', DNI='$DNI', pc='$pc', tlf='$tlf', nameClient='$nameClient', surname='$surname'   
  WHERE DNI='$DNI'";

  if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
    mysqli_close($db);
    header("Location: ../../../index.php");
    echo exit;
  } else {
    echo "Error: " . $sql . ":-" . mysqli_error($db);
  }
}

