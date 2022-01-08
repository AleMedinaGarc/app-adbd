<?php

$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('ID', 'name', 'family', 'desc', 'stock', 'size', 'price', 'weight');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $db->query('SELECT * FROM PRODUCTS ORDER BY ' .  $column . ' ' . $sort_order)) {

  $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
  $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
  $add_class = ' class="highlight"';
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
      <h1>Tema 4: Desarrollo de Aplicaciones</h1>
      <ul class="navBar">
        <li><a class="active" href="./index.php">Artículos</a></li>
        <li><a href="./routes/clients/clients.php">Clientes</a></li>
        <li><a href="./routes/purchases/purchases.php">Compras</a></li>
      </ul>
    </div>
    <div class="buttonDiv">
      <button class="button"> <a href="./routes/product/new-product.php">Añadir producto</a></button>
    </div>
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
            <td<?php echo $column == 'ID' ? $add_class : ''; ?>><?php echo $row['ID']; ?>
              <td<?php echo $column == 'name' ? $add_class : ''; ?>><?php echo $row['name']; ?></td>
                <td<?php echo $column == 'family' ? $add_class : ''; ?>><?php echo $row['family']; ?></td>
                  <td<?php echo $column == 'desc' ? $add_class : ''; ?>><?php echo $row['desc']; ?></td>
                    <td<?php echo $column == 'stock' ? $add_class : ''; ?>><?php echo $row['stock']; ?></td>
                      <td<?php echo $column == 'size' ? $add_class : ''; ?>><?php echo $row['size']; ?></td>
                        <td<?php echo $column == 'price' ? $add_class : ''; ?>><?php echo $row['price']; ?></td>
                          <td<?php echo $column == 'weight' ? $add_class : ''; ?>><?php echo $row['weight']; ?>
                            <td style="text-align: center;"><a href="./pages/productos/comprar_producto.php?id=<?php echo $row['ID']; ?>"><i class="material-icons">shopping_cart</i></a></td>
                            <td style="text-align: center;"><a href="./pages/productos/edit_productos.php?id=<?php echo $row['ID']; ?>"><i class="material-icons">edit</i></a></td>
                            <td style="text-align: center;"><a href="./pages/delete.php?id=<?php echo $row['ID']; ?>"><i class="material-icons">delete_forever</i></a></td>
          </tr>

        <tbody>
        <?php endwhile; ?>
    </table>
  </body>

  </html>
<?php
  $result->free();
}

//Etapa 4. Cierre conexión
mysqli_close($db);
?>