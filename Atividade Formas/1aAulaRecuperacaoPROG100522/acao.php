<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once ("classes/Quadrado.class.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    if(isset($_POST['id'])){$id = $_POST['id'];}else if(isset($_GET['id'])){$id = $_GET['id'];}

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $quadrado = new Quadrado($id, "", "", "");
        $resultado = $quadrado->excluir();
            header("location:index.php");
    }
    

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        if ($id == 0){ 
            $quadrado = new Quadrado("", $_POST['lado'], $_POST['cor'], $_POST['tabuleiro_idTabuleiro']);
            $resultado = $quadrado->inserir();
            header("location:index.php");
        }
        else{
            $quadrado = new Quadrado($_POST['id'], $_POST['lado'], $_POST['cor'], $_POST['tabuleiro_idTabuleiro']);
            $resultado = $quadrado->editar();
            header("location:editar.php");        
        }
    }

//Consultar dados
function buscarDados($id){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM quadrado WHERE id = $id");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['id'] = $linha['id'];
        $dados['lado'] = $linha['lado'];
        $dados['cor'] = $linha['cor'];
        $dados['tabuleiro_idTabuleiro'] = $linha['tabuleiro_idTabuleiro'];

    }
    //var_dump($dados);
    return $dados;
}
    
?>