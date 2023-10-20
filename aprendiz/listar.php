<?php

if (isset($_POST['numero'])) {
    $ficha = $_POST['numero'];
    $conn = new mysqli("localhost", "root", "", "coordinacion" );
    if( $conn->connect_errno ) {
        echo "Falla al conectarse a Mysql ( ". $conn->connect_errno . ") " .
                $conn->connect_error ;
    } else {
        //echo $conn->host_info. "\n" ;
    }

    $sql = "SELECT ap.*, fi.numero, fi.programa, fi.lider FROM aprendices as ap " .
            "INNER JOIN fichas as fi on ap.ficha_id=fi.id WHERE ".
        "numero=".$ficha;
    $msg="";
    $estado="";
    $mensaje = array();
    if($resultado = $conn->query($sql)){
        if ($registro = $resultado->fetch_assoc()) {
            $msg= "Resultado OK";
            $estado="OK";
            $mensaje["resultado"]=array();
            $mensaje["resultado"]["aprendiz"]=$registro;

            $sql = "SELECT ap.*,fi.numero FROM `aprendices` as ap  " .
            "INNER JOIN fichas as fi on ap.ficha_id=fi.id ".
            "WHERE fi.numero=".$ficha;

            $aprendiz=array();
            if ($resultado = $conn->query($sql)) {
                while ($registro = $resultado->fetch_assoc()) {
                    $aprendiz[]=$registro;
                }
            }
            $mensaje["resultado"]["aprendiz"]=$aprendiz;
        } else {
            
            $msg= "Ficha sin aprendices";
            $estado="Error";
            
        }
    } else {
        $msg= "Error conexion Base de Datos";
        $estado="Error";
    }
    $mensaje["msg"]=$msg;
    $mensaje["estado"]=$estado;
    echo json_encode($mensaje);
    //echo json_encode($documento);
} else {
    $mensaje = array();
    $mensaje["msg"]="Debe Ingresar un Documento";
    $mensaje["estado"]="Error";
    echo json_encode($mensaje);
}