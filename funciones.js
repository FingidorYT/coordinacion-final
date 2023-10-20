
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


function mostrar_datos_aprendiz(aprendiz) {
    let rs = $("#rbuscar");
    let tr = $(".resultado-tabla");
    $(tr).remove();

    let documento = aprendiz.documento;
    let nombre = aprendiz.nombres;
    let apellidos = aprendiz.apellidos;
    let email = aprendiz.email;
    let nficha = aprendiz.numero;
    let nombres = nombre +" " + apellidos; 
    let programa = aprendiz.programa;
    let lider = aprendiz.lider;
    var fila = $("<tr></tr>");
    var celda = $("<td></td>");
    var tabla = $("#rbuscar");
    $(fila).addClass("resultado-tabla");
    celda.html(documento);
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(nombres);
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(email);
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(nficha);
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(programa);
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(lider);
    $(fila).append(celda);
    $(tabla).append(fila);
}


function mostrar_datos_historial(historial) {
    console.log(historial);
    var tabla = $("#rbuscar-2");
    historial.forEach(element => {             
    var fila = $("<tr></tr>");
    var celda = $("<td></td>");
    celda.html(element.coordinador);
    $(fila).append(celda);
    celda = $("<td></td>");
    if (element.nombre_motivo=="Otros") {
            celda.html(  element.otros  );
    } else {
            celda.html(  element.nombre_motivo  );
    }      
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(  element.fecha  );
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(  element.hora  );
    $(fila).append(celda);
    celda = $("<td></td>");
    celda.html(  element.duracion + " horas" );
    $(fila).append(celda);
    $(fila).addClass("resultado-tabla");
    $(tabla).append(fila);      
    });
}

$(document).ready(function() {
    $("#btnbuscar").click(function(){
        var documento = $("#documento").val();
        $.ajax({
            url: "http://localhost/coordinacion-final/busqueda.php",
            type: "POST",
            dataType: "json",
            data: {
                "documento":documento
            },
            success: function(data) {
                if (data.estado=="OK") {
                    mostrar_datos_aprendiz(data.resultado.aprendiz);
                    mostrar_datos_historial(data.resultado.historial);
                } else {
                    alert(data.msg);
                    window.location.href="home.php";
                    //$("#resultado").text(data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    });

    $("#mybtn").click(function(){
        if ($("#documento").val() == 0) {
            alert("Ingrese Documento Valido");
        } else {
        var modal = $("#myModal");
        $(modal).css("display", "block");
    }});

    $("#limpiar").click(function(){
        window.location.href="home.php";
    });

    $("span.close").click(function(){
        var modal = $("#myModal");
        $(modal).css("display", "none");
    });

    $("#motivo").click(function(){
        if ($("#motivo option:selected").text() == "Otros") {
            var spanotro = $("#otro-2");
            $(spanotro).css("display", "flex");
        } else {
            var spanotro = $("#otro-2");
            $(spanotro).css("display", "none");
        }
    });

    $("#btnguardar").click(function(){
        
        var modal = $("#myModal");
        var documento = $("#documento").val();
        var motivo = $("#motivo").val();
        var otro = "";
        console.log("nada");
        if ($("#motivo option:selected").text() == "Otros") {
            otro = $("#otro").val();
        } else {
            otro = null;
        }
        var nhoras = $("#nhoras").val();
        var userid = $("#user_id").val();

        $.ajax({
            url: "http://localhost/coordinacion/guardar.php",
            type: "POST",
            dataType: "json",
            data: {
                "documento": documento,
                "motivo": motivo,
                "otro": otro,
                "nhoras": nhoras,
                "user_id": userid
            },
            success: function(data) {
                if (data.estado=="OK") {
                    $(modal).css("display", "none");
                    $("#btnbuscar").trigger("click");

                } else {
                    console.log(otro);
                    alert(data.msg);
                    //$("#resultado").text(data.msg);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("paso");
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }

        });
    });
});

/*
console.log(btn);
// When the user clicks the button, open the modal 
btn.onclick = function() {
    console.log(modal);

}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    console.log(modal);
modal.style.display = "none";
}
*/