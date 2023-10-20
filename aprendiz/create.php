<?php

if(isset($_POST['documento']) && isset($_POST['nombres']) &&
isset($_POST['apellidos']) && isset($_POST['email']) && isset($_POST['fichas'])) {

    include("conexion.php");

    $sql = "INSERT INTO aprendices VALUES " .
        " (NULL, ".$_POST['documento'].", '".$_POST['nombres']."', '".
        $_POST['apellidos']."','".$_POST['email']."', ".$_POST['fichas'].")";

        if ($conn->query($sql) === TRUE) {
            $mensaje["msg"]="Se Almaceno Correcto";
            $mensaje["estado"]="OK";
            echo json_encode($mensaje);
        } else {
            $mensaje["msg"]="NO Se Almaceno la información";
            $mensaje["estado"]="Error";
            echo json_encode($mensaje);
        }
}
