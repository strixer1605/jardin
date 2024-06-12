$(document).ready(function() {
    $('#mantenimiento, #descripcion, #select').on('keydown', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            $('#crear').click();
        }
    });
    $('#crear').click(function(){
        let mantenimiento = $('#mantenimiento').val();
        let descripcion = $('#descripcion').val();
        let select = $('#select').val();
        // Validar que todos los campos estén completos
        if (mantenimiento === '' || descripcion === '' || select == null) {
            alert('Por favor, complete todos los campos.');
            return;
        }
        
        $.post('../../modulos/crearMantenimiento.php', {
            data_mantenimiento: mantenimiento,
            data_descripcion: descripcion,
            data_select: select,
        })
        .done(function(response) {
            // Este código se ejecuta si la solicitud AJAX se completa correctamente
            // El parámetro 'response' contiene la respuesta del servidor
            
            if (response === "1") {
                alert("Ocurrió un error, intentelo nuevamente."); // Mostrar mensaje de error cuando el DNI ya existe
            } else {
                alert("¡Datos insertados correctamente!");
                $('#mantenimiento, #descripcion').val('');
                $('#select').val('');
            }
        })
        .fail(function() {
            // Este código se ejecuta si la solicitud AJAX falla
            alert("Ocurrió un error, intentelo nuevamente."); // Mostrar mensaje de error genérico en caso de fallo
        });
    });
});

