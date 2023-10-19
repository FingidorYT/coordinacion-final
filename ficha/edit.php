<?php
session_start();

$id_user = $_SESSION['id_user'];

if (!$id_user) {
    header('Location: index.php');
    return;
}

?>



<?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $conn = new mysqli("localhost", "root", "", "coordinacion");

            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }

            $sql = "SELECT id, numero, programa, lider FROM fichas WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "No se encontró la ficha en la base de datos.";
                exit;
            }

            $conn->close();
        } else {
            echo "No se proporcionó un ID";
            exit;
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ficha</title>
    <link rel="stylesheet" href="styleEdit.css">
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
    <h1>Editar Ficha</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="inputhola">
            <label for="numero">Número:</label>
            <input id="numero" name="numero" type="text" value="<?php echo $row['numero']; ?>">
        </div>

        <div class="inputhola">
            <label for="programa">Programa:</label>
            <input id="programa" name="programa" type="text" value="<?php echo $row['programa']; ?>">
        </div>

        <div class="inputhola">
            <label for="lider">Líder:</label>
            <input id="lider" name="lider" type="text" value="<?php echo $row['lider']; ?>">
        </div>

        <button type="submit" name="guardar">Guardar</button>
    </form>
    <a class="A" href="index.php"><button>Volver a la página de inicio</button></a>
    </div>
</body>
</html>
