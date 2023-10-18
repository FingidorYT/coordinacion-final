<?php
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "coordinacion" );
    if( $conn->connect_errno ) {
        echo "Falla al conectarse a Mysql ( ". $conn->connect_errno . ") " .
                $conn->connect_error ;
    } else {
        //echo $conn->host_info. "\n" ;
    }

    $sql = "SELECT * FROM `users` WHERE ".
        "`username`='".$username."' and `password`=sha2('".$password."',256)";
    
    if($resultado = $conn->query($sql) ){
        if ($registro = $resultado->fetch_assoc()) {
            $_SESSION['id_user']=$registro['id'];
            header("location:home.php");
            return;
            //echo "Bienvenido".$registro["nombre"];
        } else {
            header("location:index.php?Error=1");
        }
    } else {
        header("location:index.php?Error=2");
    }
} else {
    echo "Error, Use el Formulario";
}



/*
echo 'Usando $_GET';
echo var_dump($_GET);

if(isset ($_GET['username'])){
    echo $_GET['username'];
}


echo "<br/>";

echo 'Usando $_POST';
echo var_dump($_POST);

echo $_POST['username'];


echo "<br/>";

echo 'Usando $_REQUEST';
echo var_dump($_REQUEST);

echo $_REQUEST['username'];


echo "<br/>";
*/

