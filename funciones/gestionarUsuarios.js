$(document).ready(function(){
    cargarTablaUsuarios();

    $('#dni, #nombre, #apellido, #email, #cargo').on('keydown', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            $('#cargar').click();
        }
    });

    $('#dniVerificar, #mailVerificar').on('keydown', function(event) {
        if (event.which === 13) {
            event.preventDefault();
            $('#enviar').click();
        }
    });

    $('#enviar').click(function(){
        let dniVerificar = $('#dniVerificar').val();
        let mailVerificar = $('#mailVerificar').val();
        let estado = 0;

        if (dniVerificar === '' ||  mailVerificar === '') {
            alert('Por favor, complete todos los campos.');
            return;
        }

        let emailFormatVerificar = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailFormatVerificar.test(mailVerificar)) {
            alert('Por favor, ingrese un correo electrónico válido.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../modulos/buscarUsuario.php',
            data: {
                dniVerificar,
                mailVerificar,
                estado
            },
            success:function(response){
                if(response == 'success'){
                    alert('hola');
                    console.log(response);
                    $('#dniVerificar').val('');
                    $('#mailVerificar').val('');                    
                }else{
                    alert ("Ha ocurrido un error14");
                }
            },
            error: function(){

                alert("Ha ocurrido un error15");
            }
        })
        
    })
    $('#cargar').click(function(){
        let dni = $('#dni').val();
        let nombre = $('#nombre').val();
        let apellido = $('#apellido').val();
        let email = $('#email').val();
        let cargo = $('#cargo').val();
        
        if (dni === '' || nombre === '' || apellido === '' || email === '') {
            alert('Por favor, complete todos los campos.');
            return;
        }
    
        let emailFormat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailFormat.test(email)) {
            alert('Por favor, ingrese un correo electrónico válido.');
            return;
        } else if(cargo == '') {
            alert('Por favor, seleccione un cargo.');
            return;
        }
    
        $.ajax({
            type: 'POST',
            url: '../modulos/crearUsuario.php',
            data: { 
                dni: dni,
                nombre: nombre,
                apellido: apellido,
                email: email,
                cargo: cargo
            },
            success: function(response){
                if(response == 'success'){
                    cargarTablaUsuarios();
                    $('#dni').val('');
                    $('#nombre').val('');
                    $('#apellido').val('');
                    $('#email').val('');
                    $('#cargo').val('Seleccione un cargo');
                } else if(response == 'duplicate_dni_or_email') {
                    alert("El usuario ya existe.");
                } else {
                    alert("Ha ocurrido un error al crear el usuario.");
                }
            },
            error: function(){
                alert("Ha ocurrido un error al crear el usuario.");
            }
        });
    });

    function cargarTablaUsuarios() {
        $.ajax({
            type: 'GET',
            url: '../modulos/obtenerUsuarios.php',
            success: function(response) {
                const usuarios = JSON.parse(response);
                let tablaHTML = '<table id="miTabla" class="table table-striped table-bordered dt-responsive nowrap"><thead><tr><th class="dni">DNI</th><th class="nombre">Nombre</th><th class="apellido">Apellido</th><th class="gmail">Gmail</th><th class="cargo">Cargo</th><th class="estado">Estado</th><th class="editar">Editar</th><th class="borrar">Deshabilitar</th></tr></thead><tbody>';
                
                usuarios.forEach(function(usuario) {
                    tablaHTML += `<tr>
                                    <td>${usuario.dni}</td>
                                    <td>${usuario.nombre}</td>
                                    <td>${usuario.apellido}</td>
                                    <td>${usuario.gmail}</td>
                                    <td>${usuario.cargo}</td>
                                    <td>${usuario.estado}</td>
                                    <td class="button-column acciones">
                                        <button class="confirmar" id="${usuario.dni}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="button-column acciones">
                                        <center>
                                            <button class="deshabilitar" id="${usuario.dni}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                            </button>
                                        </center>
                                    </td>
                                </tr>`;
                });
                
                tablaHTML += '</tbody></table>';
                $('#tabla').html(tablaHTML);

                if ($.fn.DataTable.isDataTable('#miTabla')) {
                    $('#miTabla').DataTable().destroy();
                }

                $('#miTabla').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                    }
                });
            },
            error: function() {
                alert("Ha ocurrido un error al obtener a los usuarios");
            }
        });
    }

    $(document).on('click', '.confirmar', function(){
        let dniUsuario = $(this).attr('id');
        window.location.href = `modUsuario.php?dni=${dniUsuario}`;
    });

    $(document).on('click', '.deshabilitar', function(){
        let idUsuario = $(this).attr('id');
        deshabilitarUsuario(idUsuario);
    });

    function deshabilitarUsuario(idUsuario){
        if(confirm("¿Estás seguro de que deseas deshabilitar a este usuario?")){
            $.ajax({
                type: 'POST',
                url: '../modulos/deshabilitarUsuario.php',
                data: { id: idUsuario },
                success: function(response){
                    if(response == 'success'){
                        cargarTablaUsuarios();
                        alert("El usuario ha sido deshabilitado correctamente");
                    } else {
                        alert("Ha ocurrido un error al deshabilitar el usuario");
                    }
                },
                error: function(){
                    alert("Ha ocurrido un error al deshabilitar el usuario");
                }
            });
        }
    }
});