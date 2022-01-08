<?php

$user = "app_user";
$password = "4ppUs3.r";
$database = "app_web_adbd";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');
$url_id = $_GET['id'];
$result = $db->query("SELECT * FROM `PRODUCTOS` WHERE ID='$url_id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title>ADBD P6 - PRODUCTOS</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="products-edit.css">
  <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

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
    <h2>Editando el producto con ID: <?php echo $url_id; ?></h2> 
  </div>
  <hr>
  <form method="post">
    <div class="form-group">
      <label>Nombre</label>
      <input type="text" value="<?php echo $row['nombre']; ?>" required>
    </div>
    <div class="form-group">
      <label>Stock*</label>
      <input type="number" min=1 placeholder="Cantidad disponible" value="<?php echo $row['stock']; ?>" required>
    </div>
    <div class="form-group">
      <label>Precio*</label>
      <input type="number" min=0.01 step=0.01 placeholder="Precio de venta" value="<?php echo $row['precio']; ?>" required>
    </div>
    <div class="form-group">
      <label>Familia*</label>
      <input type="text" placeholder="Familia del producto"  value="<?php echo $row['familia']; ?>" required>
    </div>
    <div class="form-group">
      <label>Descripción</label>
      <input type="text" placeholder="Descripción del producto" value="<?php echo $row['descripcion']; ?>">
    </div>
    <div class="form-group">
      <label>Tamaño</label>
      <input type="number" min=0.01 step=0.01 placeholder="Tamaño" value="<?php echo $row['size']; ?>">
    </div>
    <div class="form-group">
      <label>Peso</label>
      <input type="number" min=1 placeholder="Peso en gramos" value="<?php echo $row['peso']; ?>">
    </div>
    <input type="submit" name="submit" value="Actualizar" class="btn btn-primary">
      <a class="btn btn-outline-danger" href="../../index.php">Volver sin guardar</a>
    </ul>
  </form>
</body>

</html>

<?php
if (empty($_POST)) {
  exit;
}
$nameItem = mysqli_real_escape_string($db, $_REQUEST['nameItem']);
$stock = mysqli_real_escape_string($db, $_REQUEST['stock']);
$size = mysqli_real_escape_string($db, $_REQUEST['size']);
$weight = mysqli_real_escape_string($db, $_REQUEST['weight']);
$price = mysqli_real_escape_string($db, $_REQUEST['price']);
$family = mysqli_real_escape_string($db, $_REQUEST['family']);
$descr = mysqli_real_escape_string($db, $_REQUEST['descr']);

$sql = "INSERT INTO `app-tienda`.`PRODUCTS` (`nameItem`, `stock`, `size`, `weight`, `price`, `family`, `descr`)
VALUES ('$nameItem', '$stock', '$size', '$weight' , '$price', '$family', '$descr')";

if ($db->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

//Etapa 4. Cierre conexión
mysqli_close($db);
?>