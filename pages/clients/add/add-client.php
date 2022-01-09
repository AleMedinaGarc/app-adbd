<?php

$user = "app_user";
$password = "4ppUs3.r";
$database = "app_web_adbd";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('email','DNI','CP', 'tlfno', 'nombre', 'apellido');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $db->query('SELECT * FROM COMPRAS ORDER BY ' .  $column . ' ' . $sort_order)) {
  // Some variables we need for the table.
  $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
  $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
  $add_class = ' class="highlight"';
?>
<!DOCTYPE html>
  <html>

  <head>
    <title>ADBD P6 - COMPRAS</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="index.css">
    <!--<link rel="icon" href="./assets/images/image.png" type="image/x-icon">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  </head>

  <body style="margin: 10px;padding:0;">
    <div class="header">
      <h1>HISTORIAL DE COMPRAS REALIZADAS</h1>
      <hr>
          <div>
            <a class="btn btn-primary" href="../../index.php">Productos</a>
            <a class="btn btn-primary" href="../clientes/clientes.php">Clientes</a>
            <a class="active btn btn-primary" href="compras.php">Compras</a>
          </div>
       <hr>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Compra</th>
          <th>ID Producto</th>
          <th>Cliente</th>
          <th>Cantidad</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()) : ?>
        
          <tr>
            <td<?php echo $column == 'IDPurchase' ? $add_class : ''; ?>><?php echo $row['IDPurchase']; ?></td>
            <td<?php echo $column == 'IDProduct' ? $add_class : ''; ?>><?php echo $row['IDProduct']; ?></td>
            <td<?php echo $column == 'email' ? $add_class : ''; ?>><?php echo $row['email']; ?></td>
            <td<?php echo $column == 'cantidad' ? $add_class : ''; ?>><?php echo $row['cantidad']; ?></td>   
            <td<?php echo $column == 'totalPrice' ? $add_class : ''; ?>><?php echo $row['totalPrice']; ?></td>
          </tr>

        
        <?php endwhile; ?>
        <tbody>
    </table>
  </body>

  </html>
<?php
  $result->free();
}

//Etapa 4. Cierre conexión
mysqli_close($db);
?>