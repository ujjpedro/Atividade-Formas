<?php 

    require_once "AutoLoad.php"; 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $idCubo = isset($_GET['idCubo']) ? $_GET['idCubo'] : 0;
        $cubo = new Cubo($idCubo, $lado, $_POST['cor'], $_POST['id']);     
        $cubo->excluir();
        header("location:showCubo.php");
    }

$acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $id = isset($_POST['idCubo']) ? $_POST['idCubo'] : "";

        try{
        if ($id == 0){
            $cubo = new Cubo("", $lado, $_POST['cor'], $_POST['id']);     
            $cubo->insere();
            header("location:showCubo.php");
        }else {
            $cubo = new Cubo($_POST['idCubo'], $lado, $_POST['cor'], $_POST['id']);
            $cubo->editar();
        }    
        header("location:showCubo.php");    
    }catch(Exception $e){
        echo "<h1>Erro ao tentar cadastrar o Cubo.<h2>
        <br> Erro: <br><br>".$e->getMessage();
    }     
}

$pdo = Database::iniciaConexao();
$consulta = $pdo->query("SELECT lado FROM quadrado,cubo WHERE cubo.id = quadrado.id;");
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { $lado = $linha['lado']; }; 

function buscarDados($idCubo){
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM cubo WHERE idCubo = $idCubo");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['idCubo'] = $linha['idCubo'];
        $dados['cor'] = $linha['cor'];
        $dados['id'] = $linha['id'];
    }
    return $dados;
}
?>