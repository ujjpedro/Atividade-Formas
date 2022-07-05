<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "AutoLoad.class.php";

    $idCirculo = isset($_GET['idCirculo']) ? $_GET['idCirculo'] : 0;
    if(isset($_POST['idCirculo'])){$idCirculo = $_POST['idCirculo'];}else if(isset($_GET['idCirculo'])){$idCirculo = $_GET['idCirculo'];}

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $circulo = new Circulo($idCirculo, "", "", "");
        $resultado = $quadrado->excluir();
            header("location:indexCirculo.php");
    }
    

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        if ($idCirculo == 0){ 
            $circulo = new Circulo("", $_POST['raio'], $_POST['cor'], $_POST['circulo_idTabuleiro']);
            $resultado = $circulo->inserir();
            header("location:indexCirculo.php");
        }
        else{
            $circulo = new Circulo($_POST['idCirculo'], $_POST['raio'], $_POST['cor'], $_POST['circulo_idTabuleiro']);
            $resultado = $circulo->editar();
            header("location:editarCirculo.php");        
        }
    }

//Consultar dados
function buscarDados($idCirculo){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM circulo WHERE idCirculo = $idCirculo");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idCirculo'] = $linha['idCirculo'];
        $dados['raio'] = $linha['raio'];
        $dados['cor'] = $linha['cor'];
        $dados['circulo_idTabuleiro'] = $linha['circulo_idTabuleiro'];

    }
    //var_dump($dados);
    return $dados;
}
    
?>