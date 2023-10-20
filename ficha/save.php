<?php
if (isset($_POST['guardar'])) {
    $numero = $_POST['numero'];
    $programa = $_POST['programa'];
    $lider = $_POST['lider'];
    $conn = new mysqli("localhost", "root", "", "coordinacion");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "INSERT INTO fichas (`id`, `numero`, `programa`, `lider`) VALUES (NULL,$numero,'$programa','$lider')";
    echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "Los datos se cargaron correctamente.";
    } else {
        echo "Error al cargar: " . $conn->error;
    }

    $conn->close();
    echo '<a href="index.php"><button>Volver a la página de inicio</button></a>';
}
?>