<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

if ($result = $db->query('SELECT * FROM PRODUCTS')) {

?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Tienda ADBD</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="./assets/images/image.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  </head>

  <body>
    <div class="header">
      <h1>Clientes</h1>
      <ul class="navBar">
        <li><a class="active" href="./index.php">Artículos</a></li>
        <li><a href="./pages/clients/clients.php">Clientes</a></li>
        <li><a href="./pages/purchases/purchases.php">Compras</a></li>
      </ul>
    </div>
    <div class="buttonDiv">
      <button class="button"> <a href="./pages/products/add/new-product.html">Añadir producto</a></button>
    </div>
    <div class="tableDiv">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Familia</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Tamaño</th>
            <th>Precio</th>
            <th>Peso</th>
            <th style="text-align: center;">Comprar</th>
            <th style="text-align: center;">Editar</th>
            <th style="text-align: center;">Eliminar</th>
          </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tbody>
            <tr class="item">
              <td><?php echo $row['ID']; ?>
              <td><?php echo $row['nameItem']; ?></td>
              <td><?php echo $row['family']; ?></td>
              <td><?php echo $row['descr']; ?></td>
              <td><?php echo $row['stock']; ?></td>
              <td><?php echo $row['size']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td<?php echo $column == 'weight' ? $add_class : ''; ?>><?php echo $row['weight']; ?>
                <td style="text-align: center;"><a href="./pages/purchases/add/add-purchase.php?id=<?php echo $row['ID']; ?>"><i class="material-icons">shopping_cart</i></a></td>
                <td style="text-align: center;"><a href="./pages/products/edit/edit-product.php?id=<?php echo $row['ID']; ?>"><i class="material-icons">edit</i></a></td>
                <td style="text-align: center;"><a href="./pages/products/actions/delete.php?ID=<?php echo $row['ID']; ?>"><i class="material-icons">delete_forever</i></a></td>
            </tr>
          <tbody>
          <?php endwhile; ?>
      </table>
    </div>
  </body>

  </html>
<?php
  $result->free();
}
mysqli_close($db);
?>