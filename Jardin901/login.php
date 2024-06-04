<?php
    session_start();

    // Verificar si hay una sesión activa
    if (isset($_SESSION['dni'])) {
        session_destroy();
    }
    // Desactivar el caché del navegador
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión</title>
        
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <main>
            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Olvidaste tu contraseña?</h3>
                        <p>Haz click aquí para recuperar tu contraseña</p>
                        <button id="btn__registrarse">Recuperar</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <div class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" id="loginDNI" placeholder="Ingrese su DNI...">
                        <input type="password" id="loginContraseña" placeholder="Contraseña...">
                        <button id="enviarLogin" class="btn btn-info">Enviar</button>
                    </div>

                    <!--Register-->
                    <div class="formulario__register">
                        <h2>Recuperar contraseña</h2>
                        <input type="text" id="correo" placeholder="Escriba su correo electrónico">
                        <button id="recuperar">Recuperar</button>
                    </div>
                </div>
                    <?php 
                        if(isset($_GET['message'])){
                        
                        ?>
                        <div class="alert alert-primary" role="alert">
                            <?php 
                            switch ($_GET['message']) {
                            case 'ok':
                                echo 'Por favor, revisa tu correo';
                                break;
                            case 'success_password':
                                echo 'Inicia sesión con tu nueva contraseña';
                                break;
                                
                            default:
                                echo 'Algo salió mal, intenta de nuevo';
                                break;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="funciones/login.js"></script>
        <script src="funciones/recuperarContra.js"></script>
        <script>
            $(document).ready(function() {
                $('#loginDNI').val("");
                $('#loginContraseña').val("");
            });
        </script>
    </body>
</html>
