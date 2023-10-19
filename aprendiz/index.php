<?php
session_start();

$id_user = $_SESSION['id_user'];

if (!$id_user) {
    header('Location: index.php');
    return;
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include ('../scripts.php');?>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <?php
    // At top:
    require('../comun/header.php'); 
    ?>


    <?php
    // At top:
    require('../comun/navbar.php'); 
    ?>
    
    <div class="busqueda">
        <p class="titulo">
            TITULO ACA
        </p>
        <p>Ponga sus funciones aca</p>
    </div>
    <br>
    <br>
    
    
</body>
</html>