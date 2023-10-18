<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Carga masiva de archivos</h1>
    <form action="procesar.php" method="post" enctype="multipart/form-data">
    <label for="archivo">Selecciona un archivo CSV:</label>
    <input type="file" name="archivo" id="archivo">
    <input type="submit" value="Subir archivo">
    </form>
</body>
</html>