<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

if(isset($_POST['submit']))
{   
  $email = mysqli_real_escape_string($db, $_REQUEST['email']);
  $DNI = mysqli_real_escape_string($db, $_REQUEST['DNI']);
  $nameClient = mysqli_real_escape_string($db, $_REQUEST['nameClient']);
  $surname = mysqli_real_escape_string($db, $_REQUEST['surname']);
  $tlf = mysqli_real_escape_string($db, $_REQUEST['tlf']);
  $pc = mysqli_real_escape_string($db, $_REQUEST['pc']);

  $sql = "INSERT INTO `app-tienda`.`CLIENTS` (`email`, `DNI`, `pc`, `tlf`, `nameClient`, `surname`)
  VALUES ('$email','$DNI','$pc', '$tlf', '$nameClient', '$surname')";
  if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../clients.php");
    exit;
  } else {
    echo "Error: " . $sql . ":-" . mysqli_error($db);
  }
}
mysqli_close($db);
?>