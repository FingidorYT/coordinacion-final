<?php
$env = parse_ini_file(dirname(__DIR__, 1).'/'.'.env');
?>

<div class="head">
        <img class="mintrabajo" src="/<?php echo $env['RUTA_PROYECTO'];?>/img/mintrabajo-logo.png">
        <img class="logosena" src="/<?php echo $env['RUTA_PROYECTO'];?>/img/logosena.png">
</div>
<a href="logout.php" class="salir_2"><button class="opcion salir" id="logout" >Logout</button></a>
