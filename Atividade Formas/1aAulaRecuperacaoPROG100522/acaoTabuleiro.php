<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once ("classes/Tabuleiro.class.php");

    $idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : 0;
    if(isset($_POST['idTabuleiro'])){$idTabuleiro = $_POST['idTabuleiro'];}else if(isset($_GET['idTabuleiro'])){$idTabuleiro = $_GET['idTabuleiro'];}

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $tabuleiro = new Tabuleiro($idTabuleiro, "", "");
        $resultado = $tabuleiro->excluir();
            header("location:indexTabuleiro.php");
    }
    

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        if ($idTabuleiro == 0){ 
            $tabuleiro = new Tabuleiro("", $_POST['lado']);
            $resultado = $tabuleiro->inserir();
            header("location:indexTabuleiro.php");
        }
        else{
            $tabuleiro = new Tabuleiro($_POST['idTabuleiro'], $_POST['lado']);
            $resultado = $tabuleiro->editar();
            header("location:editarTabuleiro.php");        
        }
    }

//Consultar dados
function buscarDados($idTabuleiro){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM tabuleiro WHERE idTabuleiro = $idTabuleiro");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idTabuleiro'] = $linha['idTabuleiro'];
        $dados['lado'] = $linha['lado'];

    }
    //var_dump($dados);
    return $dados;
}
    
?>