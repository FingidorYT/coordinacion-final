<?php



include("conexion.php");

//$conn = mysqli_connect("localhost", "root", getenv('DB_PASSWORD'), "coordinacion");

if (!$conn) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];
    
    $sql = "DELETE FROM users WHERE id = $user_id";
    if (mysqli_query($conn, $sql)) {
        echo "Usuario eliminado correctamente.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar usuario: " . mysqli_error($conn);
    }
} else {
    echo "ID de usuario no válido.";
}

mysqli_close($conn);
?>

