<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

if ($result = $db->query('SELECT * FROM PURCHASES')) {

?>
  <!DOCTYPE html>
  <html>
  <html>

  <head>
    <title>Compras</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../assets/styles/main.css">
    <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  </head>

  <body>
    <div class="header">
      <ul class="navBar">
        <li><a href="/" >Productos</a></li>
        <li><a href="../clients/clients.php">Clientes</a></li>
        <li><a class="active" >Compras</a></li>
      </ul>
      <h1>Compras</h1>
    </div>
    <div class="tableDiv">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Email del usuario</th>
            <th>ID Producto</th>
            <th>Cantidad</th>
            <th style="text-align: center;">Eliminar</th>
          </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tbody>
            <tr class="item">
              <td><?php echo $row['IDPurchase']; ?>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['IDProduct']; ?></td>
              <td><?php echo $row['amount']; ?></td>
              <td style="text-align: center;"><a href="./actions/delete.php?id=<?php echo $row['IDPurchase']; ?>"><i class="material-icons">delete_forever</i></a></td>
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