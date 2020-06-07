function IniciarSesion() {
    var usuario = document.getElementById('correo').value;
    var contrasena = document.getElementById('contrasenia').value;

    if (usuario == "") {
        alert('Debe ingresar usuario');
        return;
    }

    if (contrasena == "") {
        alert('Debe ingresar contraseña');
        return;
    }

    var datos = {
        "usuario": usuario,
        "contrasena": contrasena
    };

    $.ajax({
        url: '../controlador/login.controlador.php',
        data: datos,
        type: 'POST',
        dataType: 'json'
    }).done(function (data) {
        if (data == "OK") {
            alert('Sesion iniciada');
            window.location = 'persona.html';
        } else {
            alert(data);
        }
    }).fail(function (data) {
        console.log(data);
    });
}