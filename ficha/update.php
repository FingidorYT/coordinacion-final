<?php
    if(isset($_POST['guardar'])){
        $id = $_POST['id'];
        $numero = $_POST['numero'];
        $programa = $_POST['programa'];
        $lider = $_POST['lider'];
        $conn = new mysqli("localhost", "root", "", "coordinacion");

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $sql = "UPDATE fichas SET numero = '$numero', programa = '$programa', lider = '$lider' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Los datos se actualizaron correctamente.";
        } else {
            echo "Error al actualizar: " . $conn->error;
        }

        $conn->close();
        echo '<a href="index.php"><button>Volver a la página de inicio</button></a>';
    }
?>