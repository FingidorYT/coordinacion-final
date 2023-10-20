
function mostrar_aprendiz(aprendiz) {
  /**
   * LIMPIAR TABLA, CADA VEZ QUE SE BUSQUE POR UNA FICHA DISTINTA
   */
  var tablaAprendiz = document.getElementById("tablaAprendiz");

  const tbody = document.getElementById("tablaAprendiz")[0];
  tablaAprendiz.innerHTML = "";

  console.log(aprendiz.length);

  /**
   *EN CASO DE QUE UNA FICHA ESTE VACIA, LA TABLA TAMBIEN QUEDE VACIA
   */

  if (aprendiz.length === 0) {
    var tablaAprendiz = document.getElementById("tablaAprendiz");

    const tbody = document.getElementById("tablaAprendiz")[0];
    tablaAprendiz.innerHTML = "";
  } else {
    /**
     * AGREGAR CADA APRENDIZ A UNA FILA DE LA TABLA
     */
    for (var i = 0; i < aprendiz.length; i++) {
      console.log(i);
      var registro = aprendiz[i];
      var row = tablaAprendiz.insertRow(0);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);

      /**
       * Generar el boton de eliminar y editar a cada aprendiz en la tabla
       */

      var button = document.createElement("button");
      var button1 = document.createElement("button");

      button.textContent = "Eliminar";
      button.name = "botonEliminar" + registro.id;
      button.setAttribute("nid", "" + registro.id);
      
      button.className = "btn btn-primary ms-1";
      button1.className = "btn btn-primary ms-1";


      button1.textContent = "Editar";
      button1.name = "botonEditar" + registro.id;
      button1.setAttribute("nid", "" + registro.id);

      /**
       * Asignar los datos de los aprendices a las celdas de la tabla
       */

      cell1.innerHTML = registro.documento;
      cell1.classList.add("documento");
      cell2.innerHTML = registro.nombres;
      cell3.innerHTML = registro.apellidos;
      cell4.innerHTML = registro.email;
      cell5.innerHTML = registro.numero;
      cell6.appendChild(button);
      cell7.appendChild(button1);
    }
  }
}

$(document).ready(function () {

/**
 * Mostrar automaticamente los datos de los aprendices de la ficha seleccionada
 */
  $("#ficha").change(function() {
    console.log("OK")
    $( "#btnFiltrar" ).trigger( "click" );
  });

  /**
  * Eliminar aprendiz de una ficha
  */
  
  //$("button[name^='botonEliminar']").on("click",function () {
  $(document).on("click","button[name^='botonEliminar']",function () {
    var id = $(this).attr("nid");

    var confirmar = confirm("¿Estás seguro de que deseas eliminar este registro?");

    if (confirmar) {
      $.ajax({
        url: "http://localhost/coordinacion-final/aprendiz/delete.php",
        type: "POST",
        data: { id: id },
        success: function (data) {
          console.log(data);
          alert("Aprendiz eliminado Exitosamente");
          location.reload();
        },
        error: function (xhr, status, error) {
          console.error("Error al eliminar el aprendiz: " + error);
        }
      });
    } else {
    }

  });

  /**
   * Editar datos de un aprendiz
   */

  //$("button[name^='botonEditar']").on("click",function () {
  $(document).on("click","button[name^='botonEditar']",function () {
    var id = $(this).attr("nid");

      $.ajax({
        url: "http://localhost/coordinacion-final/aprendiz/get_data.php",
        type: "POST",
        dataType: "JSON",
        data: { id: id, 
         },
        success: function (data) {
          console.log(data)
          var modal = new bootstrap.Modal(document.getElementById("editarDatos"));
          $("#h_id").val(data.id);
          console.log(data.id);
          $("#document").val(data.documento);
          $("#nombre").val(data.nombres);
          $("#apellido").val(data.apellidos);
          $("#correo").val(data.email);
          $("#Numfichas").val(data.ficha_id);
          
          modal.show();              
          
        },
        error: function (xhr, status, error) {
          console.error("Error al editar: " + error);
        }
      });
    
  });

    $("#botonActualizar").on("click", function () {
      var id = $("#h_id").val();
      var Nuevodocumento = $("#document").val();
      var Nuevonombres = $("#nombre").val();
      var Nuevoapellidos = $("#apellido").val();
      var Nuevoemail = $("#correo").val();
      var Nuevofichas = $("#Numfichas").val();
  
  
      // Validación de correo
      if (Nuevoemail.indexOf('@') === -1 || Nuevoemail.indexOf('.') === -1) {
          alert("El correo debe contener al menos un '@' y un punto.");
          return;
      }
  
      // Validación de campos vacíos
      if (
          Nuevodocumento.trim() === "" ||
          Nuevonombres.trim() === "" ||
          Nuevoapellidos.trim() === "" ||
          Nuevoemail.trim() === "" ||
          Nuevofichas.trim() === ""
      ) {
          alert("No deben haber campos vacíos.");
          return;
      }else{
    
    $.ajax({
      url: "http://localhost/coordinacion-final/aprendiz/edit.php",
      type: "POST",
      dataType: "json",
      data: {
        "id":id,
        "documento": Nuevodocumento,
        "nombres": Nuevonombres,
        "apellidos": Nuevoapellidos,
        "email": Nuevoemail,
        "fichas": Nuevofichas
      },
      
      success: function (data) {
        console.log("----------->"+data.estado);
        if (data.estado == "OK") {
          $("#editarDatos").modal('hide');
          alert("Los datos de "+Nuevonombres+" "+Nuevoapellidos+" han sido actualizados de manera exitosa");
          location.reload();

        } else {
          console.log("ERROR");
          alert("El numero de documento ingresado ya se encuentra registrado");
        }
      },
      error:  function (xhr, status, error) {
        console.error("Error al actualiar: " + error);
      }
    })
      }
  });


  $("#btnFiltrar").click(function () {
    var numero = $("#ficha").val();
    $.ajax({
      url: "http://localhost/coordinacion-final/aprendiz/listar.php",
      type: "POST",
      dataType: "json",
      data: {
        numero: numero,
      },
      success: function (data) {
        /**
         * LISTAR APRENDICES FILTRANDO POR NUMERO FICHA
         */
        if (data.estado == "OK") {
          mostrar_aprendiz(data.resultado.aprendiz);
          console.log(data.resultado.aprendiz);
          

          /**
           * ALERTA PARA LA FICHA VACIA
           */
        } else {
          console.log(data.msg);

          var tablaAprendiz = document.getElementById("tablaAprendiz");

          const tbody = document.getElementById("tablaAprendiz")[0];
          tablaAprendiz.innerHTML = "";
          alert("FICHA SIN APRENDICES");
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  });


  /**
   * Funcion para limpiar los campos de la modal de agregar nuevo aprendiz
   */
  $('#staticBackdrop').on('hidden.bs.modal', function (e) {
    $("#documento").val("");
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#email").val("");
  });

  /**
   * Boton para agregar nuevo aprendiz
   */
  $("#botonGuardar").click(function () {
    var documento = $("#documento").val();
    var nombres = $("#nombres").val();
    var apellidos = $("#apellidos").val();
    var email = $("#email").val();
    var fichas = $("#fichas").val();
    console.log(fichas);

  // Validación de correo
  if (email.indexOf('@') === -1 || email.indexOf('.') === -1) {
  alert("El correo debe contener al menos un '@' y un punto.");
  return;
  }

  // Validación de campos vacíos
  if (
  documento.trim() === "" ||
  nombres.trim() === "" ||
  apellidos.trim() === "" ||
  email.trim() === "" ||
  fichas.trim() === ""
  ) {
  alert("No deben haber campos vacíos.");
  return;
  }else{
    $.ajax({
      url: "http://localhost/coordinacion-final/aprendiz/create.php",
      type: "POST",
      dataType: "json",
      data: {
        "documento": documento,
        "nombres": nombres,
        "apellidos": apellidos,
        "email": email,
        "fichas": fichas
      },
      success: function (data) {
        if (data.estado == "OK") {
          $("#staticBackdrop").modal('hide');
          alert("Aprendiz creado exitosamente");
          location.reload();

        } else {
          console.log("ERROR");
          alert("El numero de documento ingresado ya se encuentra registrado");
        }
      }
    })
  }
  })



});