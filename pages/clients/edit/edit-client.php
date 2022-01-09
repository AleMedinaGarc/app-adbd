<?php

$user = "app_user";
$password = "4ppUs3.r";
$database = "app_web_adbd";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');
$url_email = $_GET['email'];
$result = $db->query("SELECT * FROM `CLIENTES` WHERE email='$url_email'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title>ADBD P6 - CLIENTES</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="products-edit.css">
  <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style type="text/css">
  label{
    width:100px;
    display: inline-block;
  }

  #form{
    border-radius: 10px;
    width:290px;
    padding:4px;
  }
</style>
</head>

<body style="margin: 10px; padding:0;">
  <div class="header">
    <h2>Editando el cliente con email: <?php echo $url_email; ?></h2>
  </div>
  <hr>
  <form method="post" action="update.php">
    <div class="form-group">
      <label>Email*</label>
      <input name="email" type="email" placeholder="Email del cliente" value="<?php echo $row['email']; ?>" required readonly>
    </div>
    <div class="form-group">
      <label>DNI*</label>
      <input name="DNI" type="text" placeholder="DNI" maxlenght="9" minlenght="9"  value="<?php echo $row['DNI']; ?>" required>
    </div>
    <div class="form-group">
      <label>Nombre*</label>
      <input name="nombre" type="text" placeholder="Nombre del cliente" value="<?php echo $row['nombre']; ?>" required>
    </div>
    <div class="form-group">
      <label>Apellido*</label>
      <input name="apellido" type="text" placeholder="Apellido del cliente" value="<?php echo $row['apellido']; ?>"  required>
    </div>
    <div class="form-group">
      <label>Telefono</label>
      <input name="tlfno" type="tel" placeholder="Telefono del cliente" value="<?php echo $row['tlfno']; ?>">
    </div>
    <div class="form-group">
      <label>Código Postal</label>
      <input name="CP" type="number" maxlenght="5" minlenght="5" placeholder="Ej. 38312" value="<?php echo $row['CP']; ?>">
    </div>
    <input type="submit" name="update" value="Actualizar" class="btn btn-primary">
    <a class="btn btn-outline-danger" href="clientes.php">Volver sin guardar</a>
  </form>
</body>

</html>

<?php
mysqli_close($db);
?>