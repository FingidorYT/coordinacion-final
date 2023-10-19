<?php
session_start();

$id_user = $_SESSION['id_user'];

if (!$id_user) {
    header('Location: index.php');
    return;
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0-beta3/css/all.min.css">
    <?php include('links.php'); ?>
    <?php include ('../scripts.php');?>
    <link rel="stylesheet" href="estiss.css">

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
    
    <div class="busqueda">
       
        
        


      <div class="container p-5" id="divPr">
      <h1>Lista de motivos</h1>

     <table class="table table-striped">
        <thead>
            <tr>
                <th>Motivos de salida</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "coordinacion";

            $conn = new mysqli($servername, $username, $password, $database);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Consulta SQL para seleccionar los motivos
            $sql = "SELECT * FROM motivos";
            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td><a href='#editModal' data-toggle='modal' data-id='" . $row["id"] . "' class='btn btn-warning edit-motivo'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                    echo "<td><a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'><i class='fa-solid fa-trash'></i></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron motivos.</td></tr>";
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
            ?>
        </tbody>
     </table>
     <div class="row">
        <div class="col">
            <button  class="btn btn-success float-left mt-2" data-toggle="modal" data-target="#agregarModal" id="aggMotivo">
                Agregar motivo
            </button>
        </div>
     </div>

     <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Motivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nuevoMotivo">Nuevo Motivo:</label>
                        <input type="text" class="form-control" id="nuevoMotivo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardarNuevoMotivo">Guardar</button>
                </div>
            </div>
        </div>
     </div>
      </div>
     <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Motivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editMotivoId">
                <div class="form-group">
                    <label for="motivoEdit">Motivo:</label>
                    <input type="text" class="form-control" id="motivoEdit">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarMotivo">Guardar</button>
            </div>
        </div>
       </div>
      </div>
    


       </div>
       </div>



        <script>
     // JavaScript para manejar el modal de edición y la actualización del motivo
     $(document).ready(function() {
        $('.edit-motivo').click(function() {
            var motivoId = $(this).data('id');
            var motivoText = $(this).closest('tr').find('td:first').text();

            $('#editMotivoId').val(motivoId);
            $('#motivoEdit').val(motivoText);
        });

        $('#guardarMotivo').click(function() {
            var motivoId = $('#editMotivoId').val();
            var nuevoMotivo = $('#motivoEdit').val();

            // Enviar los datos del formulario para actualizar el motivo en la base de datos
            $.ajax({
                type: 'POST',
                url: 'editar.php',
                data: { editMotivoId: motivoId, motivoEdit: nuevoMotivo },
                success: function(response) {
                    // Manejar la respuesta del servidor, si es necesario
                    console.log(response);

                    // Actualiza la tabla con el nuevo motivo sin recargar la página (si es necesario)
                    var motivoTd = $('td:contains(' + motivoId + ')');
                    motivoTd.next().text(nuevoMotivo);

                    // Cierra el modal
                    $('#editModal').modal('hide');

                    location.reload();
                    
                },
                error: function(xhr, status, error) {
                    console.log('Error al actualizar el motivo: ' + error);
                }
            });
        });
     });
      </script>

         <script>
     // JavaScript para manejar el modal de agregar motivo y la inserción en la base de datos
     $(document).ready(function() {
        $('#guardarNuevoMotivo').click(function() {
            var nuevoMotivo = $('#nuevoMotivo').val();

            // Enviar el nuevo motivo a la base de datos
            $.ajax({
                type: 'POST',
                url: 'agregar.php', // Archivo que manejará la inserción en la base de datos
                data: { nuevoMotivo: nuevoMotivo },
                success: function(response) {
                    // Manejar la respuesta del servidor, si es necesario
                    console.log(response);

                    // Actualiza la tabla en la página (si es necesario)
                    // Por ejemplo, puedes volver a cargar la página o usar AJAX para actualizar la tabla sin recargarla.
                },
                error: function(xhr, status, error) {
                    console.log('Error al agregar el motivo: ' + error);
                }
            });

            // Cierra el modal
            $('#agregarModal').modal('hide');

            location.reload();
        });
     });
     </script>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </p>
     </div>
     <br>
     <br>
    
    
</body>
</html>




