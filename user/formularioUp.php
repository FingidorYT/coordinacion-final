<?php

$id = $_REQUEST["id"];

// Conexión a la base de datos (debes configurar esto)
include('conexion.php');

// Verifica la conexión

// Actualiza el registro en la base de datos
$sql = "select * from USERS WHERE id=$id";

$username;
$email;
$nombre;


if ($resultado=$conn->query($sql)) {
    if($registro=$resultado->fetch_assoc()) {
        $username= $registro["username"];
        $email= $registro["email"];
        $nombre= $registro["nombre"];
        
    } else {
        header("Location: index.php");
        return;
    }
    //echo "Usuario actualizado correctamente.";
} else {
    echo "Error al actualizar usuario: " . $conn->error;
}

$conn->close();

?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
   
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/comun.css">
    <link rel="stylesheet" href="../css/user.css">
    
</head>
<body>
    

        <?php
    // At top:
    require('../comun/header.php'); 
    ?>
<div class="container">
    <h1 class="mt-4">Editar Usuario</h1>
    <form id="updateForm" class="mt-4"action="servidor.php?id=<?php echo $id?>" method="post">
        <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" >
            <br>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" class="form-control" name="nombre"  value="<?php echo $nombre; ?>">
            <br>
        </div>
        <div class="form-group">
        <label for="email">Correo Electrónico:</label>
            <input type="text" id="email" class="form-control" name="email"   value="<?php echo $email; ?>">
            <br>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password">
            <br>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Volver</a>

    </form>

</div>
    <script src="./js/jquery-3.7.1.min.js"></script>
    
    



    
</body>
</html>