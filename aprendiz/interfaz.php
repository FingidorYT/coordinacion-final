
<?php

session_start();

$id_user = $_SESSION['id_user'];

if (!$id_user) {
    header('Location: index.php');
    return;
}

include("conexion.php");

$ficha = array();

$sql ="SELECT * FROM fichas";

if($resultado  = $conn->query($sql)){
    while ($registro = $resultado->fetch_assoc()){
        $fichas[]=$registro;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include ('scripts-aprendiz.php');?>

    <title>Gestionar Aprendices</title>
</head>
<body>

<?php

    require('../comun/header.php'); 
    require('../comun/navbar.php'); 
?>

<div class="busqueda">
    <p class="titulo">
        BUSCAR APRENDICES
    </p>

    <div class="container-fluid">
        <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Agregar Datos
        </button>


        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar aprendices</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input id="documento" type="number" class="form-control" placeholder="Ingrese Documento">              
                        <div class="input-group mt-2">
                            <input id="nombres" type="text" class="form-control" placeholder="Nombres" aria-label="Nombres">
                        </div>
                        <div class="input-group mt-2">
                            <input id="apellidos" type="text" class="form-control" placeholder="Apellidos" aria-label="Apellidos">
                        </div>
                        <div class="input-group mt-2">
                            <input id="email" type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="input-group mt-2">
                            <select name="fichas" id="fichas" class="form-control">
                                <?php 
                                if(count($fichas) > 0){
                                    foreach($fichas as $ficha){
                                        echo "<option value='".$ficha["id"]."'>".$ficha["numero"]."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="botonGuardar" type="button" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="form-group row">
            <div class="col-2">
                <button type="button" class="btn btn-primary form-control m-2" id="btnFiltrar">Filtrar</button>
            </div>
            <div class="col-3">
                <select name="ficha" id="ficha" class="form-control m-2">
                    <?php
                    if(count($fichas) > 0){
                        foreach ($fichas as $ficha) {
                            echo "<option value='".$ficha["numero"]."'>".$ficha["numero"]."</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
            
        <table class="tabla">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Numero Ficha</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody id="tablaAprendiz">
                <td colspan="7">
                    <h2>Aun no se realiza una búsqueda</h2>
                </td>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="editarDatos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar aprendices</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="h_id" />
                <label for="document">Documento</label>
                <div class="input-group mt-2">
                    <input id="document" type="number" class="form-control" placeholder="Ingrese Documento">              
                </div><br>
                <label for="nombre">Nombre</label>
                <div class="input-group mt-2">
                    <input id="nombre" type="text" class="form-control" placeholder="Nombres" aria-label="Nombres">
                </div><br>
                <label for="apellido">Apellido</label>
                <div class="input-group mt-2">
                    <input id="apellido" type text" class="form-control" placeholder="Apellidos" aria-label="Apellidos">
                </div><br>
                <label for="correo">Correo</label>
                <div class="input-group mt-2">
                    <input id="correo" type="text" class="form-control" placeholder="Email">
                </div><br>
                <label for="Numfichas">Número de Ficha</label>
                <div class="input-group mt-2">
                    <select name="ficha" id="Numfichas" class="form-control">
                        <?php 
                        if(count($fichas) > 0){
                            foreach($fichas as $ficha){
                                echo "<option value='".$ficha["id"]."'>".$ficha["numero"]."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="botonActualizar" type="button" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>


</div>

</body>
</html>
