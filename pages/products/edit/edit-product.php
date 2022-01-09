<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

$url_id = $_GET['id'];
$result = $db->query("SELECT * FROM `PRODUCTS` WHERE ID='$url_id'");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title>EDITAR PRODUCTO</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="edit-product.css">
  <link rel="icon" href="../../../assets/images/image.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

</head>

<body style="margin: 10px; padding:0;">
  <div class="header">
    <h2>Editando el producto con ID: <?php echo $url_id; ?></h2> 
  </div>
  <hr>
  <form action="../actions/update.php?id=<?php echo $url_id; ?>" method="post">
        <ul class="form-style-1">
            <li>
                <label>Nombre <span class="required">*</span></label>
                <input type="text" name="nameItem" class="field-divided" value="<?php echo $row['nameItem']; ?>"/>

            </li>
            <li>
                <label>Stock<span class="required">*</span></label>
                <input type="number" name="stock" class="field-divided" value="<?php echo $row['stock']; ?>"/>
            </li>
            <li>
                <label>Tamaño</label>
                <input type="number" step="0.01" min="0" name="size" class="field-divided" value="<?php echo $row['size']; ?>"/>
            </li>
            <li>
                <label>Peso</label>
                <input type="number" step="0.01" min="0" name="weight" class="field-divided" value="<?php echo $row['weight']; ?>"/>
            </li>
            <li>
                <label>Precio <span class="required">*</span></label>
                <input type="number" step="0.01" min="0" name="price" class="field-divided" value="<?php echo $row['price']; ?>"/>
            </li>
            <li>
                <label>Familia</label>
                <select name="family" class="field-select field-divided" value="<?php echo $row['family']; ?>">
          <option value="Televisor">Televisor</option>
          <option value="Televisor">Móvil</option>
          <option value="Otro">Otro</option>
        </select>
            </li>
            <li>
                <label>Descripcion</label>
                <textarea name="descr" id="field5" class="field-long field-textarea"></textarea>
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