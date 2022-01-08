<?php

$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');
?>

<!DOCTYPE html>
<html>

<head>
  <title>Tienda ADBD</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="product-edit.css">
  <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
  <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="header">
    <h2>Añadir producto</h2>
  </div>

  <form method="post">
    <ul class="form-style-1">
      <li>
        <label>Nombre <span class="required">*</span></label>
        <input type="text" name="nameItem" class="field-divided" />

      </li>
      <li>
        <label>Stock<span class="required">*</span></label>
        <input type="number" name="stock" class="field-divided" />
      </li>
      <li>
        <label>Tamaño</label>
        <input type="number" step="0.01" min="0" name="size" class="field-divided" />
      </li>
      <li>
        <label>Peso</label>
        <input type="number" step="0.01" min="0" name="weight" class="field-divided" />
      </li>
      <li>
        <label>Precio <span class="required">*</span></label>
        <input type="number" step="0.01" min="0" name="price" class="field-divided" />
      </li>
      <li>
        <label>Familia</label>
        <select name="family" class="field-select field-divided">
          <option value="Televisor">Televisor</option>
          <option value="Televisor">Móvil</option>
          <option value="Otro">Otro</option>
        </select>
      </li>
      <li>
        <label>Descripcion</label>
        <textarea name="descr" id="field5" class="field-long field-textarea"></textarea>
      </li>
      <input type="submit" name="submit" value="Insertar" class="btn btn-primary">
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