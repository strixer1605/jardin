$(document).ready(function() {
    $('#crear').click(function(){
        let noticia = $('#noticia').val();
        let descripcion = $('#descripcion').val();
        var file = $('#imagen')[0].files[0];
        
        console.log(file);

        if (noticia === '' || descripcion === '' || file == null) {
            alert('Por favor, complete todos los campos.');
            return;
        }

        var formData = new FormData();
        formData.append('data_noticia', noticia);
        formData.append('data_descripcion', descripcion);
        formData.append('data_img', file);

        $.ajax({
            url: '../modulos/novedadesCarga.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response === "1") {
                    alert("Ocurrió un error, intentelo nuevamente."); // Mostrar mensaje de error
                } else {
                    alert("¡Datos insertados correctamente!");
                    $('#noticia, #descripcion').val('');
                    $('#imagen').val('');
                    $('#imagePreview').html('<p style="text-align: center;">Vista previa</p>');
                }
            },
            error: function() {
                alert("Ocurrió un error, intentelo nuevamente."); // Mostrar mensaje de error genérico en caso de fallo
            }
        });
    });
});
