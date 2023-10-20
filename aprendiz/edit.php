<?php

if(isset($_POST['id']) && isset($_POST['documento']) && isset($_POST['nombres']) &&
isset($_POST['apellidos']) && isset($_POST['email']) && isset($_POST['fichas'])) {

    include("conexion.php");

    $sql = "UPDATE aprendices SET documento = '"
    .$_POST['documento']."', nombres = '".$_POST['nombres']."', apellidos = '"
    .$_POST['apellidos']."', email = '".$_POST['email']."', ficha_id = '"
    .$_POST['fichas']."' WHERE id = '".$_POST['id']."'";


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