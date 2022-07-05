<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "AutoLoad.class.php";

    $idRetangulo = isset($_GET['idRetangulo']) ? $_GET['idRetangulo'] : 0;
    if(isset($_POST['idRetangulo'])){$idRetangulo = $_POST['idRetangulo'];}else if(isset($_GET['idRetangulo'])){$idRetangulo = $_GET['idRetangulo'];}

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $retangulo = new Retangulo($idRetangulo, "", "", "", "");
        $resultado = $retangulo->excluir();
            header("location:indexRetangulo.php");
    }
    

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        if ($idRetangulo == 0){ 
            $retangulo = new Retangulo("", $_POST['alturaRetangulo'], $_POST['baseRetangulo'], $_POST['cor'], $_POST['retangulo_idTabuleiro']);
            $resultado = $retangulo->inserir();
            header("location:indexRetangulo.php");
        }
        else{
            $retangulo = new Retangulo($_POST['idRetangulo'], $_POST['alturaRetangulo'], $_POST['baseRetangulo'], $_POST['cor'], $_POST['retangulo_idTabuleiro']);
            $resultado = $retangulo->editar();
            header("location:editarRetangulo.php");        
        }
    }

//Consultar dados
function buscarDados($idRetangulo){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM retangulo WHERE idRetangulo = $idRetangulo");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idRetangulo'] = $linha['idRetangulo'];
        $dados['alturaRetangulo'] = $linha['alturaRetangulo'];
        $dados['baseRetangulo'] = $linha['baseRetangulo'];
        $dados['cor'] = $linha['cor'];
        $dados['retangulo_idTabuleiro'] = $linha['retangulo_idTabuleiro'];

    }
    //var_dump($dados);
    return $dados;
}
    
?>