<?php

if (isset($_POST['documento'])) {
    $documento = $_POST['documento'];
    $conn = new mysqli("localhost", "root", "", "coordinacion" );
    if( $conn->connect_errno ) {
        echo "Falla al conectarse a Mysql ( ". $conn->connect_errno . ") " .
                $conn->connect_error ;
    } else {
        //echo $conn->host_info. "\n" ;
    }

    $sql = "SELECT ap.*, fi.numero, fi.programa, fi.lider FROM aprendices as ap " .
            "INNER JOIN fichas as fi on ap.ficha_id=fi.id WHERE ".
        "documento=".$documento;
    $msg="";
    $estado="";
    $mensaje = array();
    if($resultado = $conn->query($sql)){
        if ($registro = $resultado->fetch_assoc()) {
            $msg= "Resultado OK";
            $estado="OK";
            $mensaje["resultado"]=array();
            $mensaje["resultado"]["aprendiz"]=$registro;

            $sql = "SELECT sa.*, us.nombre AS coordinador, mo.nombre AS nombre_motivo  ".
                "FROM salidas AS sa ".
            "INNER JOIN users AS us ON sa.user_id=us.id ".
            "INNER JOIN motivos as mo ON sa.motivo_id=mo.id ".
            " WHERE sa.aprendiz_id=".$registro['id']." ORDER BY fecha DESC, hora desc;";

            $historial=array();
            if ($resultado = $conn->query($sql)) {
                while ($registro = $resultado->fetch_assoc()) {
                    $historial[]=$registro;
                }
            }
            $mensaje["resultado"]["historial"]=$historial;
        } else {
            $msg= "Este aprendiz no se encuentra en la base de datos";
            $estado="Error";
        }
    } else {
        $msg= "Ingrese un usuario valido";
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