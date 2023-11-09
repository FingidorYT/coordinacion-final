<?php
session_start();

$id_user = $_SESSION['id_user'];

if (!$id_user) {
    header('Location: index.php');
    return;
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleHome.css">
    <link rel="stylesheet" href="../css/comun.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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
    <div class="cajita">
        <p class="titulo">REGISTRO FICHAS</p>
        <div class="col" id="buscar">
            <form method="post" action="index.php">
                <div class="input-group mb-3">
                    <input id="numFicha" name="numFicha" type="number" class="form-control" placeholder="Ingrese Num Ficha">
                    <button class="btn btn-outline-secondary" type="submit" id="btnBuscar" name="buscar">Buscar</button>
                </div>
            </form>
            <a href="create.php"><button class="btn btn-outline-secondary" type="submit" id="btnCrear" name="buscar">Crear</button></a>
        </div>

        <?php 
        if(isset($_POST['buscar'])){
            $numFicha = $_POST['numFicha'];
            $conn = new mysqli("localhost", "root", "", "coordinacion");
            
            if ($conn->connect_error) {
                die("Error de conexión a la base de datos: " . $conn->connect_error);
            }
            
            $sql = "SELECT id, numero, programa, lider FROM fichas WHERE numero LIKE '%$numFicha%'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Id</th><th>Numero</th><th>Programa</th><th>Lider</th></tr>";
                while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["numero"] . "</td>";
                    echo "<td>" . $row["programa"] . "</td>";
                    echo "<td>" . $row["lider"] . "</td>";
                    echo "<td><a href='edit.php?id=" . $row["id"] . "'><button onclick='accion1(" . $row["id"] . ")'>Editar</button></a></td>";
                    echo "<td><button onclick='accion2(" . $row["id"] . ")'>Eliminar</button></td>";
                    echo "</tr>";
                }
                echo "</table>";

                
            } else {
                echo "No se encontraron fichas con ese número en la base de datos.";
            }
            
            $conn->close();
        }else {
        ?>

        <div id="fichas">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Numero</th>
                    <th>Programa</th>
                    <th>Lider</th>
                    <th>Editar</th> 
                    <th>Eliminar</th>
                </tr>

                <?php
                    $conn = new mysqli("localhost", "root", "", "coordinacion");

                    if ($conn->connect_error) {
                        die("Error de conexión a la base de datos: " . $conn->connect_error);
                    }

                    // Realiza una consulta para obtener las fichas
                    $sql = "SELECT id, numero, programa, lider FROM fichas";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr id='row_" . $row["id"] . "'>";  // Asigna un ID a cada fila
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["numero"] . "</td>";
                            echo "<td>" . $row["programa"] . "</td>";
                            echo "<td>" . $row["lider"] . "</td>";
                            echo "<td><a href='edit.php?id=" . $row["id"] . "'><button onclick='accion1(" . $row["id"] . ")'>Editar</button></a></td>";
                            echo "<td><button onclick='eliminarFila(" . $row["id"] . ")'>Eliminar</button></td>"; 
                            echo "</tr>";
                        }
                    } else {
                        echo "No se encontraron fichas en la base de datos.";
                    }
                    $conn->close();
                ?>

                <?php
                    include ('delete.php'); 
                ?>
            </table>
        </div>
    <?php } ?>
    </div>

    
</body>
</html>