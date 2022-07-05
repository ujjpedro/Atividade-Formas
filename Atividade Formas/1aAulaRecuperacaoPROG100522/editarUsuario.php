<!DOCTYPE html>
<?php 

    //var_dump($_GET);
    include_once "acaoUsuario.php";
    require_once "classes/Usuario.class.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == "editar"){
        $idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : 0;
        $nome = isset($_GET['nome']) ? $_GET['nome'] : "";
        $login = isset($_GET['login']) ? $_GET['login'] : "";
        $senha = isset($_GET['senha']) ? $_GET['senha'] : "";

        //$usuario = new Usuario($idUsuario,$nome,$login);
        //$usuario->editar();
        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite o seu Cadastro</title>
    
</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Editar Cadastro</h3><hr>
        
    <form method="post" action="ProcessaUsuario.php">
        <div>
            <label>Id</label><br>
            <input readonly type="text" readonly name="id" value="<?php if($acao == "editar") echo $idUsuario; else echo 0;?>" placeholder="ID">
        </div>
        <div>
            <label>Nome:</label><br>
            <input type="name" name="nome" value="<?php if($acao == "editar") echo $nome; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Login:</label> 
            <!-- <?php var_dump($login)?>   -->
            <br>
            <input type="text" name="login" value="<?php if($acao == "editar") echo $login; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Senha:</label><br>
            <input type="text" name="senha" value="<?php if($acao == "editar") echo $senha; else echo 0;?>">
        </div>
        <br>
        <button value="editar" name="editar" type="submit" class="btn btn-outline-info">Salvar</button>

    </form>

</div>
<hr style="width: 98.7%; margin-left: 12px;">
<br>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>