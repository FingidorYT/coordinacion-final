<?php
$env = parse_ini_file(dirname(__DIR__, 1).'/'.'.env');
?>

<navbar class="menu">
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/aprendiz/interfaz.php"><button class="opcion" id="op1">Aprendices</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/ficha/index.php"><button class="opcion" id="op2">Fichas</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/motivo/index.php"><button class="opcion" id="op3">Motivos</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/home.php" ><button class="opcion" id="op4">Salidas</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/user/index.php"> <button class="opcion" id="op5">Users</button></a>
</navbar>