<?php
    // session_start();
    //  // Verificar si hay una sesión activa
    // if (isset($_SESSION['dni'])) {
    //     $dniUsuario = $_SESSION['dni'];
    // } else {
    //     // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    //     header('Location: ../../login.php');
    //     exit;
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Document</title>
        <style>
            body {
                padding-top: 0;
                padding-bottom: 3em;
                background-color: rgb(95, 73, 194);
                position: relative;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            #logo-container {
                margin-top: 70px;
                margin-bottom: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container-body {
                background-color: white !important;
                width: 600px;
                padding: 30px;
                border-radius: 10px;
                font-size: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                font-family: Georgia, 'Times New Roman', Times, serif;
            }

            .noti-logo {
                width: 400px;
                height: 150px;
            }

            @media (min-width: 769px) {
                body {
                    padding-bottom: 130px;
                }
            }

            @media (max-width: 768px) {
                #logo-container {
                    margin-top: 30px;
                    margin-bottom: 30px; /* Espacio entre la imagen y el contenedor */
                    display: flex; /* Usar flexbox */
                    justify-content: center; /* Centrar horizontalmente */
                    align-items: center; /* Centrar verticalmente */
                }

                body {
                    padding-top: 0;
                    padding-bottom: 10px;
                    position: relative;
                    min-height: 100vh;
                }

                .container-body {
                    max-width: 90%;
                    margin-bottom: 30px;
                }

                #footer {
                    visibility: hidden;
                }
            }

            .image-upload-container {
                display: flex;
                align-items: center;
                margin-top: 20px;
                font-size: 15px;
            }

            .image-upload-container input[type="file"] {
                flex: 1;
            }

            .image-preview {
                width: 100px;
                height: 100px;
                margin-left: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
            }

            .image-preview img {
                max-width: 100%;
                max-height: 100%;
            }
        </style>
    </head>

    <body>
        <div id="logo-container">
            <img src="../imagenes/Noticias-design-girls-name-removebg-preview.png" class="noti-logo">
        </div>
        <div class="container-body">
            <a class="btn btn-danger" href="admin.php" role="button" style="text-decoration: none; color:white; font-size:17px;">
                <img src="../imagenes/arrow_return_icon_175872.png" style="width: 20px; height: auto;"> Volver
            </a>
            <!-- Titulo Noticia -->
            <div class="mt-3">
                <label class="form-label">Titulo de la noticia</label>
                <input type="email" class="form-control" id="noticia" placeholder="Escribe el titulo...">
            </div>
            <!-- Descripcion Noticia -->
            <div class="mt-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" rows="5" placeholder="Descibre la noticia..."></textarea>
            </div>
            <!-- Imagen Noticia -->
            <div class="image-upload-container">
                <input type="file" id="imagen" class="form-control" accept="image/*">
                <div class="image-preview form-control" id="imagePreview">
                    <span>Vista previa</span>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <button id="crear" class="btn btn-success">Crear</button>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="../funciones/crearNovedades.js"></script>
        <script>
            document.getElementById('imagen').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Vista previa de la imagen">';
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.innerHTML = '<p style="text-align: center;">Vista previa</p>';
                }
            });
        </script>
    </body>
</html>
