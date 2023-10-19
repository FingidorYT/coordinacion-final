<?php
session_start();

$id_user = $_SESSION['id_user'];

if (!$id_user) {
    header('Location: index.php');
    return;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ficha</title>
    <link rel="stylesheet" href="styleCreate.css">
    <link rel="stylesheet" href="../css/comun.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

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
    <div class= "contenedor">
    <h1>Crear Ficha</h1>
    <form method="post" action="save.php">
        <input type="hidden" name="id">

        <div class="inputhola">
            <label for="numero">Número:</label>
            <input id="numero" name="numero" type="text">
        </div>

        <div class="inputhola">
            <label for="programa">Programa:</label>
            <input id="programa" name="programa" type="text">
        </div>

        <div class="inputhola">
            <label for="lider">Líder:</label>
            <input id="lider" name="lider" type="text">
        </div>

        <button type="submit" name="guardar">Guardar</button>
        
    </form>
    <a class="A" href="index.php"><button>Volver a la página de inicio</button></a>
    </div>
</body>
</html>
