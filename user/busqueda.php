<?php
    include('conexion.php');
    $campo = $_POST["barra-busqueda"];
    $result = null;
    if ($campo!=null) {
        $sql="SELECT * FROM users WHERE id = ".$campo;
        $result = mysqli_query($conn, $sql);
    } else {
        echo "Campo vacio o no existen usuario";
        return;
    }
    
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/comun.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
<?php
    // At top:
    require('../comun/header.php'); 
    ?>


    <?php
    // At top:
    require('../comun/navbar.php'); 
    ?>

<div class="container mt-4">
<div class="busqueda">
        <p class="titulo">
            <h1>GESTION DE USUARIOS</h1>
        </p>
            
        <button class="btn btn-success" id="btn-agregar" onclick="location.href='./create.php'">Agregar</button>
        <form action="busqueda.php" class="d-flex pb-3" role="search" method="post" id="busqueda">            
            <input id="barra-busqueda" class="form-control me-2" name="barra-busqueda" type="search" placeholder="Buscar Usuario por id" aria-label="Search">
            <button id="btn-buscar" type="submit"><a>Buscar</a></button>
            <button id="btn-buscar" type="button"><a href="index.php">Limpiar busqueda</a></button>
        </form>
        <table class="table" id="tabla">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["nombre"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td>
                            <button class="btn btn-primary" id="btnEditar"><a id="btn-editar" href="formularioUp.php?id=<?php echo $row["id"]; ?>">Editar</a></button>
                            <button class="btn btn-danger" id="btnEliminar<?php echo $row["id"]; ?>">Eliminar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>
        
</div>
    <br>
    <br>



<script src="./js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {

            
            $('button[id^="btnEliminar"]'<?php echo $row["id"]; ?>).click(function() {
                var id = $(this).attr('id').substr(11); 
                if (window.confirm("Esta seguro de eliminar?")) {
                    document.location.href = 'delete.php?id='+id;
                }
            }); 
        });
        
        
    </script>

    <style>
        #barra-busqueda{
            width:60%;
            margin-left:30px;
            color:rgb(103,28,52);
            border: 2px solid rgb(103,28,52);
            margin-right : 20px;
        }
        #btn-buscar{
            border: 2px solid rgb(103,28,52);
            background: white;
            color:rgb(103,28,52);
            padding: 5px 15px;
            margin-right : 10px;
        }
        #btn-buscar>a{
            color:rgb(103,28,52);
        }
        #btn-buscar:hover>a{
            color:white;
        }
        #btn-buscar:hover{
            transition: all 0.5s ease-out;
            padding : 5px 20px;
            color: white;
            background:rgb(103,28,52);
        }
        #busqueda{
            position: relative;
            left: 80px;
        }
        #btn-agregar{
            position: relative;
            top: 38px;
        }
    </style>
</body>
</html>

<?php
mysqli_close($conn);
?>