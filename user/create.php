<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Agregar usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/comun.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
<?php
    // At top:
    require('../comun/header.php'); 
    ?>
<div class="container">
    <h1 class="mt-4">Crear Usuario</h1>
    <form class="mt-4" action="save.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena">
        </div>
        <div class="form-group">
            <label for="repetir-contrasena">Repetir contraseña:</label>
            <input type="password" class="form-control" id="repetir-contrasena" name="repetir-contrasena">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Volver</a>

    </form>
</div>
    <script src="./js/jquery-3.7.1.min.js"></script>
</body>
</html>