    <script>
        function eliminarFila(id) {
            if (confirm("¿Estás seguro de que deseas eliminar esta fila?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var row = document.getElementById("row_" + id);
                        if (row) {
                            row.parentNode.removeChild(row); // Elimina la fila si se encuentra
                        } else {
                            console.log("La fila no se encontró en el DOM");
                        }
                    }
                };

                xhr.open("POST", "index.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("id=" + id);
            }
        }
    </script>


            <?php
                if (isset($_POST["id"])) {
                    $id = $_POST["id"];

                    $conn = new mysqli("localhost", "root", "", "coordinacion");

                    if ($conn->connect_error) {
                        die("Error de conexión a la base de datos: " . $conn->connect_error);
                    }
                    
                    $sql = "DELETE FROM fichas WHERE id = $id";

                    if ($conn->query($sql) === TRUE) {
                        echo "Fila eliminada con éxito";
                    } else {
                        echo "Error al eliminar la fila: " . $conn->error;
                    }

                    $conn->close();
                }
            ?>