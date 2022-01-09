<?php
$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

if ($result = $db->query('SELECT * FROM PRODUCTS')) {

?>
  <!DOCTYPE html>
  <html>
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
      <h1>Productos</h1>
      <ul class="navBar">
        <li><a class="active" href="./index.php">Artículos</a></li>
        <li><a href="./routes/clients/clients.php">Clientes</a></li>
        <li><a href="./routes/purchases/purchases.php">Compras</a></li>
      </ul>
    </div>
    <div class="buttonDiv">
      <button class="button"> <a href="./pages/product/add/new-product.html">Añadir producto</a></button>
    </div>
    <div class="tableDiv">
      <table>
        <thead>
          <tr>
            <th>DNI</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Codigo Postal</th>
            <th>Telefono</th>
            <th style="text-align: center;">Editar</th>
            <th style="text-align: center;">Eliminar</th>
          </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tbody>
            <tr class="item">
              <td<?php echo $column == 'DNI' ? $add_class : ''; ?>><?php echo $row['DNI']; ?>
                <td<?php echo $column == 'email' ? $add_class : ''; ?>><?php echo $row['email']; ?></td>
                  <td<?php echo $column == 'nameClient' ? $add_class : ''; ?>><?php echo $row['nameClient']; ?></td>
                    <td<?php echo $column == 'surname' ? $add_class : ''; ?>><?php echo $row['surname']; ?></td>
                      <td<?php echo $column == 'pc' ? $add_class : ''; ?>><?php echo $row['pc']; ?></td>
                        <td<?php echo $column == 'tlf' ? $add_class : ''; ?>><?php echo $row['tlf']; ?></td>
                              <td style="text-align: center;"><a href="./edit/edit-client.php?id=<?php echo $row['ID']; ?>"><i class="material-icons">edit</i></a></td>
                              <td style="text-align: center;"><a href="./actions/delete.php?ID=<?php echo $row['ID']; ?>"><i class="material-icons">delete_forever</i></a></td>
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