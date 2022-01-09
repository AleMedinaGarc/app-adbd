<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

$url_email = $_GET['email'];
$result = $db->query("SELECT * FROM `CLIENTES` WHERE email='$url_email'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Editar cliente</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="edit-client.css">
  <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="margin: 10px; padding:0;">
  <div class="header">
    <h2>Editando el cliente con email: <?php echo $url_email; ?></h2>
  </div>
  <hr>
  <form action="../actions/update.php?email=<?php echo $url_email; ?>" method="post">
    <ul class="form-style-1">
      <li>
        <label>DNI <span class="required">*</span></label>
        <input type="text" name="DNI" class="field-divided" value="<?php echo $row['DNI']; ?>" />

      </li>
      <li>
        <label>Email<span class="required">*</span></label>
        <input type="text" name="email" class="field-divided" value="<?php echo $row['email']; ?>" />
      </li>
      <li>
        <label>Nombre<span class="required">*</span></label>
        <input type="text"  name="nameClient" class="field-divided" value="<?php echo $row['nameClient']; ?>" />
      </li>
      <li>
        <label>Apellido<span class="required">*</span></label>
        <input type="text" s name="surname" class="field-divided" value="<?php echo $row['surname']; ?>" />
      </li>
      <li>
        <label>Código Postal</label>
        <input type="number"  name="price" class="field-divided" value="<?php echo $row['price']; ?>" />
      </li>
      <li>
      <label>Teléfono</label>
        <input type="text" step="0.01" min="0" name="tlf" class="field-divided" value="<?php echo $row['tlf']; ?>"/>
      </li>

      <input type="submit" name="update" value="Actualizar" class="btn btn-primary">
      <a class="btn btn-outline-danger" href="../../index.php">Volver sin guardar</a>
    </ul>
  </form>
</body>

</html>

<?php
mysqli_close($db);
?>