<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ficha</title>
</head>
<body>
    <h1>Crear Ficha</h1>
    <form method="post" action="save.php">
        <input type="hidden" name="id">

        <div class="input-group mb-3">
            <label for="numero">Número:</label>
            <input id="numero" name="numero" type="text">
        </div>

        <div class="input-group mb-3">
            <label for="programa">Programa:</label>
            <input id="programa" name="programa" type="text">
        </div>

        <div class="input-group mb-3">
            <label for="lider">Líder:</label>
            <input id="lider" name="lider" type="text">
        </div>

        <button type="submit" name="guardar">Guardar</button>
        <a class="A" href="index.php"><button>Volver a la página de inicio</button></a>
    </form>
</body>
</html>
