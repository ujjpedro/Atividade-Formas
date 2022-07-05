<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once ("classes/Usuario.class.php");

    $idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : 0;
    if(isset($_POST['idUsuario'])){$idUsuario = $_POST['idUsuario'];}else if(isset($_GET['idUsuario'])){$idUsuario = $_GET['idUsuario'];}

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $usuario = new Usuario($idUsuario, "", "", "");
        $resultado = $usuario->excluir();
            header("location:indexUsuario.php");
    }
    

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        if ($idUsuario == 0){ 
            $usuario = new Usuario("", $_POST['nome'], $_POST['login'], $_POST['senha']);
            $resultado = $usuario->inserir();
            header("location:indexUsuario.php");
        }
        else{
            $usuario = new Usuario($_POST['idUsuario'], $_POST['nome'], $_POST['login'], $_POST['senha']);
            $resultado = $usuario->editar();
            header("location:editarUsuario.php");        
        }
    }

//Consultar dados
function buscarDados($idUsuario){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM usuario WHERE idUsuario = $idUsuario");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idUsuario'] = $linha['idUsuario'];
        $dados['nome'] = $linha['nome'];
        $dados['login'] = $linha['login'];
        $dados['senha'] = $linha['senha'];

    }
    //var_dump($dados);
    return $dados;
}

$login = isset($_POST['login']) ? $_POST['login'] : "";
if ($login == "login") {
    $logar = isset($_POST['logar']) ? $_POST['logar'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : ""; 
    

    $usuario = new Usuario("", "", $logar, $senha);
    if($usuario->efetuaLogin($logar, $senha)){
        header('location:indexUsuario.php');
    }else{
        header('location:login.php');
    }
}
    
?>