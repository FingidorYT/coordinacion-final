<?php
// Conexión a la base de datos (igual que en index.php)
$servername = "localhost";
$username = "root";
$password = "";
$database = "coordinacion";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nuevo motivo del formulario
    $nuevoMotivo = $_POST["nuevoMotivo"];

    // Consulta SQL para insertar el nuevo motivo en la base de datos
    $sql = "INSERT INTO motivos (nombre) VALUES ('$nuevoMotivo')";

    if ($conn->query($sql) === TRUE) {
        // Motivo agregado con éxito
        echo "Motivo agregado correctamente.";
    } else {
        echo "Error al agregar el motivo: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
