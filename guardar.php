<?php

if (isset($_POST['documento']) && isset($_POST['motivo']) &&
    isset($_POST['nhoras']) && isset($_POST['user_id'])  && 
    isset($_POST['otro'])) {
        include("conexion.php");

        $sql = "SELECT id FROM aprendices where documento=".$_POST['documento'];
        $aprendiz_id = "";

        if($resultado=$conn->query($sql)){
            if($registro = $resultado->fetch_assoc()){
                $aprendiz_id = $registro["id"];
            } else {
                $mensaje["msg"]="Documento invalido";
                $mensaje["estado"]="Error";
                echo json_encode($mensaje);
                return;
            }
        }


        $sql = "INSERT INTO salidas VALUES " .
        "(NULL, ".$aprendiz_id.", ".$_POST['user_id'].", ".
        $_POST['motivo'].", '".$_POST['otro']."', curdate(), current_time,".$_POST['nhoras'].")";

        if($resultado = $conn->query($sql) === TRUE){
            $mensaje["msg"]="Se ha guardado correctamente";
            $mensaje["estado"]="OK";
            echo json_encode($mensaje);
        } else {
            $mensaje["msg"]="No se ha guardado correctamente";
            $mensaje["estado"]="Error";
            echo json_encode($mensaje);
        }

} else {
    $mensaje["msg"]=$msg;
    $mensaje["estado"]=$estado;
    echo json_encode($mensaje);

}

