<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $archivo = $_FILES["archivo"];
    $tipo_archivo = $archivo["type"];

    // Verificar que el archivo es un CSV
    if ($tipo_archivo === "text/csv") {
        $temp_file = $archivo["tmp_name"];

        // Leer el contenido del archivo CSV
        $csv_data = file_get_contents($temp_file);

        // Procesar los datos CSV
        $lineas = explode("\n", $csv_data);
        for  ($i = 1; $i < count($lineas); $i++){
            $campos = str_getcsv($lineas[$i], ';');
            var_dump($campos);
            $username = $campos[0];
            $password = $campos[1];
            $nombre = $campos[2];
            $email = $campos[3];

                
        }

        

            // Asegurarse de que la línea no esté vacía
            
        }

        echo "Archivo CSV procesado correctamente.";
    } else {
        echo "El archivo debe ser de tipo CSV.";
    }

?>

