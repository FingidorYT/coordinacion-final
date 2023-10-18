<?php
session_start();

$id_user = $_SESSION['id_user'];

if (!$id_user) {
    header('Location: index.php');
    return;
}

include ("conexion.php");

$motivos = array();

$sql = "SELECT * FROM motivos";

if($resultado = $conn -> query($sql)){
    while ($registro = $resultado->fetch_assoc()) {
        $motivos[] = $registro;
    }
}


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include ('scripts.php');?>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <?php
    // At top:
    require('comun/header.php'); 
    ?>


    <?php
    // At top:
    require('comun/navbar.php'); 
    ?>
    
    <div class="busqueda">
        <p class="titulo">
            REGISTRO SALIDAS
        </p>
        <form method="post" action="index.php">
            <div class="opciones">

                    <img class="id-img" src="img/id.png">
                    <input class="documento" type="number" id="documento" name="documento" placeholder="Ingrese el documento"/>

                    <button class="btn" type="button" id="btnbuscar">Buscar</button>
                
                    <button class="btn" type="button" id="mybtn">Nueva</button>

                    <button class="btn" type="button" id="limpiar">Limpiar</button>

                
            </div>
        </form>
        <div id="resultado" class="resultado">
           
            <h2 class="title-info">Información Aprendiz</h2>
            <table class="rbusqueda" id="rbuscar" border="2vw">
                <tr>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Numero de ficha</th>
                    <th>Programa de formacion</th>
                    <th>Lider de la ficha</th>
                </tr>
                    <tr class="resultado-tabla">
                        <td colspan="6">
                            <h2>Aun no se realiza una busqueda</h2>
                        </td>
                    </tr>
            </table>
            <br>
            <h2 class="title-info">Historial Salidas</h2>
            <div class="wrapper">
                <table class="rbusqueda tabla2" id="rbuscar-2" border="2vw">
                    <thead>
                        <tr>
                            <th>Coordinador</th>
                            <th>Motivo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Duracion</th>
                        </tr>    
                    </thead>            

                    <tr class="resultado-tabla">
                        <td colspan="6">
                            <h2>Aun no se realiza una busqueda</h2>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <input type="hidden" id="user_id" value="<?php echo $id_user; ?>"/>
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Registrar Salida</h2>
            </div>

            <div class="modal-body">
                <span>Motivo
                <select name="motivo" id="motivo" class="form-control">
                    <?php 
                    if (count($motivos) > 0){
                        foreach ($motivos as $motivo){
                            echo "<option value='".$motivo["id"]."'>".$motivo["nombre"]."</option>";
                        }
                    }
                    ?>
                </select>
                </span>
                <span id="otro-2">Otro:<input type="text" placeholder="Ingresa el motivo" name="otro" id="otro"/></span>
                <span><input type="number" placeholder="Horas del permiso" name="nhoras" id="nhoras" min="1"/>Horas</span>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnguardar" class="btn">Guardar</button>
            </div>
        </div>
    </div>
    
</body>
</html>