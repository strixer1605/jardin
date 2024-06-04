$(document).ready(function() {
    $('#recuperar').click(function() {
        let correo = $('#correo').val();
        console.log(correo);

        // Validar que el campo de correo no esté vacío
        if (correo === '') {
            alert('Por favor, Ingrese un correo valido.');
            return;
        }

        // Validar el formato del email utilizando una expresión regular simple
        let emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailFormat.test(correo)) {
            alert('Por favor, ingrese un correo electrónico válido.');
            return;
        }
        
        $.post('modulos/recuperarContra.php', {
            data_correo: correo
        })
        .done(function(response) {
            let res = JSON.parse(response);
            if (res.status === 'ok') {
                // Redireccionar a la página de login con un mensaje de éxito en la URL
                window.location.href = 'login.php?message=ok';
            } else if (res.status === 'not_found') {
                alert('Correo no encontrado.');
            } else {
                alert('Error: ' + res.message);
            }
        })
        .fail(function() {
            // Redireccionar a la página de login con un mensaje de error en la URL
            window.location.href = 'login.php?message=error';
        });
    });
});
