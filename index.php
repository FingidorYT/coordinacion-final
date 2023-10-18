<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Salidas</title>
    <?php include ('scripts.php');?>

    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php 
        $Error = 0;
        if(isset($_GET['Error'])){
            $Error = $_GET['Error'];
            $msg = "";
            switch($Error){
                case "1": 
                    $msg = "Usuario y/o contraseña equivocados";
                    break;

                case "2":
                    $msg = "Error conexion Base de Datos";
                    break;
                    
            }
            echo "<script>alert('".$msg."');</script>";
            echo '<script> 
            window.location.href="home.php";
            </script>';
        }

    ?>
    <div class="head">
        <img class="mintrabajo" src="img/mintrabajo-logo.png">
        <img class="logosena" src="img/logosena.png">
    </div>

    <div class="contenido">
        <div class="login">
            <legend>INGRESO</legend>
            
            <form action="validar.php?contar=1" method="POST" >
                <table>
                    <tr>
                        <td class="label">
                            <img class="userimg" src="img/user.png">
                            <input type="text" id="username" name="username" placeholder="Username"/>
                        </td>
                    </tr>
            
                    <tr>
                        <td class="label">
                            <img class="userimg" src="img/lock.png">
                            <input type="password" id="password" name="password" placeholder="Password"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <button class="btn">Login</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <footer>

    </footer>

</body>
</html>