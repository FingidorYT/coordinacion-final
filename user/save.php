<?php




    include("conexion.php");

    //$conn = new mysqli("localhost", "root", getenv('DB_PASSWORD'), "coordinacion" ); 
    if( $conn->connect_errno ) {
        echo "Falla al conectarse a Mysql ( ". $conn->connect_errno . ") " .
            $conn->connect_error ;
    }else{
        echo "Conecto";
    }



    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $repetir_contrasena = $_POST['repetir-contrasena'];


    $mensaje = array();
    $mensaje['msj'] = "";
    $mensaje['estado'] = "";

    if ($contrasena != $repetir_contrasena) {
        $mensaje['msj'] = "Contraseñas diferentes";
        $mensaje['estado'] = "Error";
        //header('Location: index.php');
        //echo json_encode($mensaje);
        echo "<script> history.back();alert('".$mensaje['msj']."');</script>";
        return;
    }


    if (isset($username) && isset($nombre) &&
    isset($email) && isset($contrasena) && isset($repetir_contrasena)){      
        try {
            $sql = "INSERT INTO users VALUES (NULL, '". $username ."' , sha2( '". $contrasena ."', 256 ), '". $nombre ."', '". $email ."')";
            if ($conn->query($sql) === TRUE) {
                $mensaje["msg"]="Se Almaceno Correcto";
                $mensaje["estado"]="OK";
                header("Location: index.php");
                exit();
                echo json_encode($mensaje);
            } else {
                $mensaje["msg"]="No Se Almaceno la información";
                $mensaje["estado"]="Error";
                echo json_encode($mensaje);
            }
            } catch (\Throwable $th) {
                echo $th;
            }
        

    } else {
        $mensaje = array();
        $mensaje["msg"]="Datos Incompletos";
        $mensaje["estado"]="Error";
        echo json_encode($mensaje);
    }