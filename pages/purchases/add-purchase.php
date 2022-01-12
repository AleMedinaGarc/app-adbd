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
    <title>Añadir compra</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../assets/styles/insert.css">
    <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
    <link rel="icon" href="../../assets/images/image.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="header">
        <h2>Añadir compra</h2>
        <hr class="solid">
    </div>

    <form action="./actions/insert.php" method="post">
        <ul class="form-style-1">
            <li>
                <label>Id Producto <span class="required">*</span></label>
                <input type="number" name="IDProduct" class="field-divided" value="<?php echo $row['ID']; ?>" />
            </li>
            <li>
                <label>Email<span class="required">*</span></label>
                <input type="test" name="email" class="field-divided" />
            </li>
            <li id="last">
                <label>Cantidad<span class="required">*</label>
                <input type="number" name="amount" class="field-divided" />
            </li>
           
                <input type="submit" name="submit" value="Insertar" class="btn btn-primary">
                <a class="btn btn-outline-danger" href="/">Volver sin guardar</a>
           
        </ul>
    </form>
</body>

</html>