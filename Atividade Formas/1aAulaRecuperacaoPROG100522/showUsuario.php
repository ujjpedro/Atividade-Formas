    <!DOCTYPE html>

<?php
$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : 0;
$nome = isset($_GET['nome']) ? $_GET['nome'] : 0;
$login = isset($_GET['login']) ? $_GET['login'] : "";
$senha = isset($_GET['senha']) ? $_GET['senha'] : "";
?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Cadastro</title>

</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3>O seu Cadastro</h3><hr><br>




<?php  
            if ($acao = "salvar") {
                require_once "classes/Usuario.class.php";

                $usuario = new Usuario($idUsuario,$nome,$login,$senha);
                echo $usuario;
            }
?>

<br>

</body>
</html>