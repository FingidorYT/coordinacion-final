<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "coordinacion";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $motivoId = $_POST["editMotivoId"];
    $nuevoMotivo = $_POST["motivoEdit"];

    $sql = "UPDATE motivos SET nombre = '$nuevoMotivo' WHERE id = $motivoId";

    if ($conn->query($sql) === TRUE) {
        // Motivo actualizado con éxito
        echo "Motivo actualizado con éxito";
    } else {
        echo "Error al actualizar el motivo: " . $conn->error;
    }
}

$conn->close();
?>






