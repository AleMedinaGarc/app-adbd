<?php

$user = "USER1";
$password = "ADBD2122";
$database = "app-tienda";
//Etapa1. Crear la variable $db y asignar a la cadena de conexión
$db = mysqli_connect("localhost", $user, $password, $database) or die('Error al conectar al servidor MySQL.');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('email', 'DNI', 'pc', 'tlf', 'name', 'surname');

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
        <link rel="stylesheet" href="clients.css">
        <style>
            html {
                font-family: Tahoma, Geneva, sans-serif;
                padding: 10px;
            }

            table {
                border-collapse: collapse;
                width: 500px;
                margin-left: auto;
                margin-right: auto;
                border-color: #64686e;
                border-width: 1px;

            }

            th {
                background-color: #54585d;
                border: 1px solid #54585d;
                color: white;
                padding: 10px;
            }

            th:hover {
                background-color: #64686e;
            }

            td {
                padding: 10px;
                color: #636363;
                border: 1px solid #dddfe1;
            }

            tr {
                background-color: #ffffff;
            }

            tr .highlight {
                background-color: #f9fafb;
            }

            .header {
                padding: 60px;
                text-align: center;
                font-size: 20px;
                font-family: Arial, Geneva, sans-serif;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <h1>Tema 4: Desarrollo de Aplicaciones</h1>
            <p>Pagina de clientes</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Código postal</th>
                </tr>
            </thead>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tbody>
                    <tr class="item">
                        <td<?php echo $column == 'ID' ? $add_class : ''; ?>><?php echo $row['ID']; ?></td>
                            <td<?php echo $column == 'name' ? $add_class : ''; ?>><?php echo $row['name']; ?></td>
                                <td<?php echo $column == 'surname' ? $add_class : ''; ?>><?php echo $row['family']; ?></td>
                                    <td<?php echo $column == 'email' ? $add_class : ''; ?>><?php echo $row['desc']; ?></td>
                                        <td<?php echo $column == 'tlf' ? $add_class : ''; ?>><?php echo $row['stock']; ?></td>
                                            <td<?php echo $column == 'pc' ? $add_class : ''; ?>><?php echo $row['size']; ?></td>
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