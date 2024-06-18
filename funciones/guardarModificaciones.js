$(document).ready(function() {
    $('#modificar').click(function() {
            let dni = $('#dni').val();
            let nombre = $('#nombre').val();
            let apellido = $('#apellido').val();
            let gmail = $('#gmail').val();
            let cargo = $('#cargo').val();
            
    
            $.post('guardarModificacion.php', {
                data_dni: dni,
                data_nombre: nombre, 
                data_apellido: apellido, 
                data_gmail: gmail, 
                data_cargo: cargo,
            })
            .done(function(response) {
                // Este código se ejecuta si la solicitud AJAX se completa correctamente
                // El parámetro 'response' contiene la respuesta del servidor
                
                if (response === "1") {
                    alert("Ocurrió un error, intentelo nuevamente."); // Mostrar mensaje de error cuando el DNI ya existe
                } else {
                    alert("¡Usuario modificado correctamente!");
                }
            })
            .fail(function() {
                // Este código se ejecuta si la solicitud AJAX falla
                alert("Ocurrió un error, intentelo nuevamente."); // Mostrar mensaje de error genérico en caso de fallo
            });
        
        // Capturar el evento 'keydown' en los campos del formulario
        $('#dni, #nombre, #apellido, #gmail, #cargo').on('keydown', function(event) {
            if (event.which === 13) { // Verificar si la tecla presionada es 'Enter'
                event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario
                enviarDatos(); // Llamar a la función para enviar los datos del formulario
            }
        });
    });
});
