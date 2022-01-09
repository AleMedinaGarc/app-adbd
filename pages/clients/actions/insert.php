<?php
$user = "app_user";
$password = "4ppUs3.r";
$database = "app_web_adbd";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');
if(isset($_POST['submit']))
{   
  $email = $_POST['email'];
  $DNI = $_POST['DNI'];
  $nombre = $_POST['name'];
  $apellido = $_POST['surname'];
  $tlfno = $_POST['tlf'];
  $CP = $_POST['pc'];
  //email, dni cp tlfno, nombre apellido
  $sql = "INSERT INTO CLIENTES ('email', 'DNI', 'pc', 'tlf', 'name', 'surname') VALUES ('$email','$DNI','$CP', '$tlfno', '$nombre', '$apellido')";
  // $sqltest = "INSERT INTO `CLIENTES` (`email`, `DNI`, `CP`, `tlfno`, `nombre`, `apellido`) VALUES ('pacotest@gmail.com', '39871554Y', '38111', 933961861 , 'Pacotest', 'Goomez')";
  if ($db->query($sql) === TRUE) {
    //echo "New record has been added successfully !";
    echo'<script type="text/javascript">
    alert("Tarea Guardada");
    window.location.href="clientes.php";
    </script>';
  } else {
    echo "Error: " . $sql . ":-" . mysqli_error($db);
  }
}
mysqli_close($db);
?>