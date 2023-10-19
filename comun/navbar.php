<?php
$env = parse_ini_file(dirname(__DIR__, 1).'/'.'.env');
?>

<navbar class="menu">
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/aprendiz/index.php" id="op1"><button class="opcion" >Aprendices</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/ficha/index.php" id="op2"><button class="opcion" >Fichas</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/motivo/index.php" id="op3"><button class="opcion" >Motivos</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/home.php" ><button class="opcion" id="op4">Salidas</button></a>
        <a href="<?php echo $env['RUTA_PROYECTO'];?>/user/index.php" id="op5"><button class="opcion" >Users</button></a>
</navbar>