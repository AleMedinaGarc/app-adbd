<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

if(isset($_POST['submit'])) {   

$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$IDProduct = mysqli_real_escape_string($db, $_REQUEST['IDProduct']);
$amount = mysqli_real_escape_string($db, $_REQUEST['amount']);

$sql = "INSERT INTO `app-tienda`.`PURCHASES` (`email`, `IDProduct`, `amount`)
VALUES ('$email', '$IDProduct', '$amount')";

if ($db->query($sql) === TRUE) {
  echo "New record created successfully";
  header("Location: ../../../index.php");
  exit;
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

}
mysqli_close($db);
