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

    if ($conn->query($sql) === TRUE) {
        $mensaje["msg"]="Se ha guardado correctamente";
        $mensaje["estado"]="OK";
        header('Location: index.php');
        echo json_encode($mensaje);
    } else {
        $mensaje["msg"]="No se ha guardado correctamente";
        $mensaje["estado"]="Error";
        header('Location: index.php');
        echo json_encode($mensaje);    }
}else{
$mensaje["msg"]=$msg;
$mensaje["estado"]=$estado;
echo json_encode($mensaje);
}
?>