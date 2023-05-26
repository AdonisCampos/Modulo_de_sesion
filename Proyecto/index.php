<?php
session_start();
include_once 'conexion.php';
include_once 'Login.php';

$host = "localhost";
$dbname = "dbclasepoo";
$usuario = "root";
$contrasena = "";
$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['user'];
    $password = MD5($_POST['pwd']);

    $login = new Login($conexion);

    if ($login->login($usuario, $password)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: dash.php");
        exit();
    } else {
        $error_message = "Nombre de usuario o contraseña incorrectos.";
    }
}
$conexion->desconectar();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo.css">
    <title>Iniciar Sesión</title>

</head>
<style>
    .title {
        text-align: center;
        font-size: 40px;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        position: relative;
        animation: sparkle 2s infinite alternate;
        color: rebeccapurple;
    }

    @keyframes sparkle {
        0% {
            color: black;
            text-shadow: none;
        }

        25% {
            color: black;
            text-shadow: 0 0 5px #ff00ff, 0 0 10px #ff00ff, 0 0 15px #ff00ff, 0 0 20px #ff00ff, 0 0 25px #ff00ff;
        }

        50% {
            color: black;
            text-shadow: 0 0 10px #ff00ff, 0 0 15px #ff00ff, 0 0 20px #ff00ff, 0 0 25px #ff00ff, 0 0 30px #ff00ff;
        }

        75% {
            color: black;
            text-shadow: 0 0 15px #ff00ff, 0 0 20px #ff00ff, 0 0 25px #ff00ff, 0 0 30px #ff00ff, 0 0 35px #ff00ff;
        }

        100% {
            color: black;
            text-shadow: none;
        }
    }


    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        padding: 0;
        background-color: transparent;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        padding: 0;
        background-color: transparent;
    }

    .inner-container {
        height: 45vh;
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background: linear-gradient(to bottom right, #74c6db, #a49fe4, #e69fa5);
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2), 0 0 20px rgba(255, 255, 255, 0.4) inset;
        border-radius: 10px;
    }

    .inner-container {
        height: 45vh;
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background: linear-gradient(to bottom right, #74c6db, #a49fe4, #e69fa5);
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2), 0 0 20px rgba(255, 255, 255, 0.4) inset;
        border-radius: 10px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    h2 {
        text-align: center;
        font-size: 28px;
        color: black;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }


    .form-group {
        margin-bottom: 10px;
        position: relative;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
        width: 100%;
        padding: 5px;
        border: none;
        border-bottom: 2px solid #ccc;
        background-color: transparent;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="password"]:focus {
        outline: none;
        border-color: rebeccapurple;
    }

    .form-group input[type="text"]~.label-text,
    .form-group input[type="password"]~.label-text {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        transition: all 0.2s ease;
    }

    .form-group input[type="text"]:focus~.label-text,
    .form-group input[type="password"]:focus~.label-text,
    .form-group input[type="text"]:valid~.label-text,
    .form-group input[type="password"]:valid~.label-text {
        transform: translateY(-20px);
        font-size: 12px;
        color: rebeccapurple;
    }

    .form-group .label-text {
        font-size: 16px;
        color: #333;
        transition: all 0.2s ease;
    }

    .form-group .bar {
        position: relative;
        display: block;
        width: 100%;
    }

    .form-group .bar::before,
    .form-group .bar::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: rebeccapurple;
        transition: all 0.2s ease;
    }

    .form-group .bar::before {
        left: 50%;
    }

    .form-group .bar::after {
        right: 50%;
    }

    .form-group input[type="text"]:focus~.bar::before,
    .form-group input[type="password"]:focus~.bar::before,
    .form-group input[type="text"]:focus~.bar::after,
    .form-group input[type="password"]:focus~.bar::after {
        width: 50%;
    }

    .form-group input[type="text"]:focus~.bar::before,
    .form-group input[type="password"]:focus~.bar::after {
        background-color: rebeccapurple;
    }

    .form-group input[type="text"]:valid~.bar::before,
    .form-group input[type="password"]:valid~.bar::before,
    .form-group input[type="text"]:valid~.bar::after,
    .form-group input[type="password"]:valid~.bar::after {
        background-color: rebeccapurple;
    }

    .form-group input[type="text"]:focus~.bar::before,
    .form-group input[type="password"]:focus~.bar::after {
        width: 50%;
    }

    .form-group input[type="text"]:focus~.bar::before,
    .form-group input[type="password"]:focus~.bar::after {
        background-color: rebeccapurple;
    }

    .form-group input[type="text"]:valid~.bar::before,
    .form-group input[type="password"]:valid~.bar::before,
    .form-group .bar::after {
        background-color: rebeccapurple;
    }

    .form-group .error-message {
        font-size: 14px;
        color: red;
        margin-top: 5px;
    }

    .form-group.error input[type="text"],
    .form-group.error input[type="password"] {
        border-color: red;
    }


    label[for="user"],
    label[for="pwd"] {
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
        color: black;
        font-weight: bold;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }


    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 5px;
    }

    button[type="submit"] {
        padding: 10px;
        width: 100%;
    }

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        padding: 0;
        background-color: transparent;
    }

    .logo {
        margin-bottom: 20px;
        width: 100px;
    }

    .show-password {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .show-password input[type="checkbox"] {
        margin-right: 5px;
        appearance: none;
        width: 16px;
        height: 16px;
        border: 2px solid #ccc;
        border-radius: 50%;
        outline: none;
        transition: background-color 0.3s ease;
    }

    .show-password input[type="checkbox"]:checked {
        background-color: rebeccapurple;
        border-color: rebeccapurple;
    }

    .show-password input[type="checkbox"]:checked::before {
        content: '';
        display: block;
        width: 8px;
        height: 8px;
        margin: 2px;
        background-color: white;
        border-radius: 50%;
    }


    button[type="submit"] {
        padding: 10px;
        width: 100%;
        background-color: rebeccapurple;
        color: white;
        border: none;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #8e44ad;
    }

    body {
        background-image: url('https://fondosmil.com/fondo/12752.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .error-message {
        background-color: #ff9999;
        color: #cc0000;
        border: 1px solid #cc0000;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>

<body>
    <div class="container">
        <h5 class="title">BIENVENIDO GESTIONA TUS PELICULAS</h5>
        <img src="/Proyecto/img/imagen_1.png" alt="Logo de la página" class="logo">
        <?php if (!empty($error_message)) : ?>
            <div class="error-message">
                <span style="color: red;"><?php echo $error_message; ?></span>
            </div>
        <?php endif; ?>

        <div class="inner-container">
            <h2>Iniciar sesión</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="user">Usuario:</label>
                    <input type="text" name="user">
                    <br><br>
                </div>
                <div class="form-group">
                    <label for="pwd">Contraseña:</label>
                    <input type="password" name="pwd" id="pwd">
                </div>
                <div class="show-password">
                    <input type="checkbox" id="showPasswordCheckbox">
                    <label for="showPasswordCheckbox">Mostrar contraseña</label>
                </div>

                <script>
                    const passwordInput = document.getElementById('pwd');
                    const showPasswordCheckbox = document.getElementById('showPasswordCheckbox');

                    showPasswordCheckbox.addEventListener('change', function() {
                        passwordInput.type = this.checked ? 'text' : 'password';
                    });
                </script>
                <br>
                <div class="form-group">
                    <button type="submit">Entrar</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>