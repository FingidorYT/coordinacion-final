<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"])) {

        include("conexion.php");

        $sql = "DELETE FROM aprendices WHERE id =" .$_POST['id'];
        
        if ($conn->query($sql) === TRUE) {
            echo "Registro eliminado de la base de datos";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }


    } else {
        echo "No se proporcionó el identificador del aprendiz a eliminar";
    }
} else {
    echo "Acceso no autorizado";
}
?>