<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"])) {
        include("conexion.php");

        // Obtén el ID del aprendiz que deseas editar
        $id = $_POST["id"];

        // Consulta la base de datos para recuperar los datos del aprendiz
        $sql = "SELECT ap.*, fi.numero FROM aprendices as ap
        INNER JOIN fichas as fi on ap.ficha_id=fi.id
        WHERE ap.id = $id";

        $resultado = $conn->query($sql);

        if ($resultado) {
            $aprendiz = $resultado->fetch_assoc();
            // Devuelve los datos del aprendiz como respuesta JSON
            echo json_encode($aprendiz);
        } else {
            // Manejo de errores si la consulta no tiene éxito
            echo json_encode(["error" => "Error al recuperar los datos del aprendiz"]);
        }
    } else {
        echo json_encode(["error" => "No se proporcionó el ID del aprendiz a editar"]);
    }
} else {
    echo json_encode(["error" => "Acceso no autorizado"]);
}
?>