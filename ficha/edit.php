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
</head>
<body>
    <h1>Editar Ficha</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <div class="input-group mb-3">
            <label for="numero">Número:</label>
            <input id="numero" name="numero" type="text" value="<?php echo $row['numero']; ?>">
        </div>

        <div class="input-group mb-3">
            <label for="programa">Programa:</label>
            <input id="programa" name="programa" type="text" value="<?php echo $row['programa']; ?>">
        </div>

        <div class="input-group mb-3">
            <label for="lider">Líder:</label>
            <input id="lider" name="lider" type="text" value="<?php echo $row['lider']; ?>">
        </div>

        <button type="submit" name="guardar">Guardar</button>
        <a class="A" href="index.php"><button>Volver a la página de inicio</button></a>

    </form>
</body>
</html>
