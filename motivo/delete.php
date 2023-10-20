<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "coordinacion";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha proporcionado un ID en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para eliminar el motivo
    $sql = "DELETE FROM motivos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Motivo eliminado con éxito
        header("Location: index.php"); // Redirige de vuelta a la página principal
    } else {
        // No se pudo eliminar el motivo debido a una llave foránea
        session_start();
        $_SESSION['alert_message'] = "No se puede eliminar el motivo ya que posee llave foránea";
        header("Location: index.php");
    }
} else {
    echo "ID de motivo no proporcionado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
