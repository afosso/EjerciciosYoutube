var url = "./../controlador/persona.controlador.php";

$(document).ready(function() {
    Consultar();
})

function Consultar() {
    $.ajax({
        data: { "accion": "CONSULTAR" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        var html = "";
        $.each(response, function(index, data) {
            html += "<tr>";
            html += "<td>" + data.nombres + "</td>";
            html += "<td>" + data.apellidos + "</td>";
            html += "<td>" + data.fechaNacimiento + "</td>";
            html += "<td>" + data.direccion + "</td>";
            html += "<td>" + data.telefono + "</td>";
            html += "<td>";
            html += "<button class='btn btn-warning' onclick='ConsultarPorId(" + data.idPersona + ");'><span class='fa fa-edit'></span> Modificar</button>"
            html += "<button class='btn btn-danger' onclick='Eliminar(" + data.idPersona + ");'><span class='fa fa-trash'></span> Eliminar</button>"
            html += "</td>";
            html += "</tr>";
        });

        document.getElementById("datos").innerHTML = html;
        $('#tablaPersona').DataTable();
    }).fail(function(response) {
        console.log(response);
    });
}

function ConsultarPorId(idPersona) {
    $.ajax({
        url: url,
        data: { "idPersona": idPersona, "accion": "CONSULTAR_ID" },
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        document.getElementById('nombres').value = response.nombres;
        document.getElementById('apellidos').value = response.apellidos;
        document.getElementById('direccion').value = response.direccion;
        document.getElementById('fechanacimiento').value = response.fechaNacimiento;
        document.getElementById('telefono').value = response.telefono;
        document.getElementById('idPersona').value = response.idPersona;
        BloquearBotones(false);
    }).fail(function(response) {
        console.log(response);
    });
}

function Guardar() {
    $.ajax({
        url: url,
        data: retornarDatos("GUARDAR"),
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos guardados con éxito", "success");
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Limpiar();
        Consultar();
    }).fail(function(response) {
        console.log(response);
    });
}

function Modificar() {
    $.ajax({
        url: url,
        data: retornarDatos("MODIFICAR"),
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos actualizados con éxito", "success");
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Limpiar();
        Consultar();
    }).fail(function(response) {
        console.log(response);
    });
}

function Eliminar(idPersona) {
    $.ajax({
        url: url,
        data: { "idPersona": idPersona, "accion": "ELIMINAR" },
        type: 'POST',
        dataType: 'json'
    }).done(function(response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos eliminados con éxito", "success");
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Consultar();
    }).fail(function(response) {
        console.log(response);
    });
}

function Validar() {
    nombres = document.getElementById('nombres').value;
    apellidos = document.getElementById('apellidos').value;
    direccion = document.getElementById('direccion').value;
    fechaNacimiento = document.getElementById('fechanacimiento').value;
    telefono = document.getElementById('telefono').value;

    if (nombres == "" || apellidos == "" || direccion == "" ||
        fechaNacimiento == "" || telefono == "") {
        return false;
    }
    return true;
}

function retornarDatos(accion) {
    return {
        "nombres": document.getElementById('nombres').value,
        "apellidos": document.getElementById('apellidos').value,
        "direccion": document.getElementById('direccion').value,
        "fechaNacimiento": document.getElementById('fechanacimiento').value,
        "telefono": document.getElementById('telefono').value,
        "accion": accion,
        "idPersona": document.getElementById("idPersona").value
    };
}

function Limpiar() {
    document.getElementById('nombres').value = "";
    document.getElementById('apellidos').value = "";
    document.getElementById('direccion').value = "";
    document.getElementById('fechanacimiento').value = "";
    document.getElementById('telefono').value = "";
    BloquearBotones(true);
}

function BloquearBotones(guardar) {
    if (guardar) {
        document.getElementById('guardar').disabled = false;
        document.getElementById('modificar').disabled = true;
    } else {
        document.getElementById('guardar').disabled = true;
        document.getElementById('modificar').disabled = false;
    }
}

function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}