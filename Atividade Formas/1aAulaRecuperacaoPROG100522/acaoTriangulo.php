<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "AutoLoad.class.php";

    $idTriangulo = isset($_GET['idTriangulo']) ? $_GET['idTriangulo'] : 0;
    if(isset($_POST['idTriangulo'])){$idTriangulo = $_POST['idTriangulo'];}else if(isset($_GET['idTriangulo'])){$idTriangulo = $_GET['idTriangulo'];}

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $triangulo = new Triangulo($idTriangulo, "", "", "", "", "");
        $resultado = $triangulo->excluir();
            // header("location:indexTriangulo.php");
    }
    

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        if ($idTriangulo == 0){ 
            $triangulo = new Triangulo("", $_POST['baseTriangulo'], $_POST['ladoTriangulo1'], $_POST['ladoTriangulo2'], $_POST['cor'], $_POST['triangulo_idTabuleiro']);
            $resultado = $triangulo->inserir();
            // header("location:indexTriangulo.php");
        }
        else{
            $triangulo = new Triangulo($_POST['idTriangulo'], $_POST['baseTriangulo'], $_POST['ladoTriangulo1'], $_POST['ladoTriangulo2'], $_POST['cor'], $_POST['triangulo_idTabuleiro']);
            $resultado = $triangulo->editar();
            header("location:editarTriangulo.php");        
        }
    }

//Consultar dados
function buscarDados($idTriangulo){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM triangulo WHERE idTriangulo = $idTriangulo");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idTriangulo'] = $linha['idTriangulo'];
        $dados['baseTriangulo'] = $linha['baseTriangulo'];
        $dados['ladoTriangulo1'] = $linha['ladoTriangulo1'];
        $dados['ladoTriangulo2'] = $linha['ladoTriangulo2'];
        $dados['cor'] = $linha['cor'];
        $dados['triangulo_idTabuleiro'] = $linha['triangulo_idTabuleiro'];

    }
    //var_dump($dados);
    return $dados;
}
    
?>