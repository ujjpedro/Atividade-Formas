<!DOCTYPE html>
<?php 
    include_once "acao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    $idCubo = 0;
    if ($acao == 'editar'){
        $idCubo = isset($_GET['idCubo']) ? $_GET['idCubo'] : "";
    if ($idCubo > 0)
        $dados = buscarDados($idCubo);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Cubo</title>
    
</head>
<body>

<?php 
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Criar Cubo</h3><hr>
        
    <form method="post" action="ProcessaCubo.php">
        <div>
            <!-- <label>Id</label><br> -->
            <input readonly type="hidden" name="id" value="<?php if($acao == "editar") echo $id; else echo 0;?>">
        </div>
        <div>
            <label>Cor do Cubo:</label><br>
            <input type="color" name="cor" value="<?php if($acao == "editar") echo $dados['cor']; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Escolher o Quadrado</label><br>  
                    <select name="id" id="id" class="form-select">>
                        <?php
                        require_once ("selecionarTabuleiro.php");
                        echo listarQuadrado(0);
                        ?>
        </div>

    <br>
    <input  type="hidden" name="id" value="<?php echo $id;?>">

    <br>

    <button value="Salvar" id="salvar" name="salvar" type="submit" class="btn btn-outline-info">Salvar</button>

    </form>

    </div>

    <!-- Aqui separa a criação de um quadrado para o listar dos quadrados -->

    <hr style="width: 98.7%; margin-left: 12px;">

    <br>

    <?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;

?>

    <script>
        function excluir(url){
            if (confirm("Deseja excluir o item?"))
                location.href = url;
        }
    </script>
    
    <div class="margin-top">
        <div class="container-fluid">
            <form method="post">
                <div class="form-group col-6">
                    <h3 style="font-weight: bold">Procurar Quadrado</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                
                    <br>

                    <div>
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Cor<br>
                        <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> Id Quadrado<br>
                    <br>
                    </div>
                        <button type="submit" name="salvar" value="Salvar" class="btn btn-outline-info">Buscar</button>
                    
                </div>
              
                <br>

            </form>

            <table class="table table-striped">
            <tr><td><b>Id</b></td>
                <td><b>Cor</b></td>
                <td><b>Id Quadrado</b></td>
                <td><b>Visualizar</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM cubo
                                        WHERE id LIKE '$procurar%' 
                                        ORDER BY id");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM cubo
                                        WHERE cor LIKE '$procurar%' 
                                        ORDER BY cor");}

            else if($busca == 3){
                $consulta = $pdo->query("SELECT * FROM cubo 
                                        WHERE id LIKE '$procurar%'
                                        ORDER BY id");}

        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
                $cor = str_replace('#','%23', $linha['cor']);

            
        ?>
        <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['cor'];?></td>
            <td><?php echo $linha['id'];?></td>
            <td><a href="showCubo.php?idCubo=<?php echo $linha['idCubo']?>&cor=<?php echo $cor?>&id=<?php echo $linha['id']?>"><img src="img/visualizador.png" style="width: 1.8vw;"></td></a>
            <!-- <td><a href="show.php"> <img src="img/visualizador.png" style="width: 1.8vw;"></a> -->
            <td><a href='editarCubo.php?acao=editar&idCubo=<?php echo $linha['idCubo'];?>&cor=<?php echo $cor;?>&id=<?php echo $linha['id'];?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo "<a href=javascript:excluir('acao.php?acao=excluir&idCubo={$linha['idCubo']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>