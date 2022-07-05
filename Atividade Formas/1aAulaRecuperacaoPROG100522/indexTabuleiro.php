<!DOCTYPE html>
<?php 
    include_once "acaoTabuleiro.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    $idTabuleiro = 0;
    if ($acao == 'editar'){
        $idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : "";
    if ($idTabuleiro > 0)
        $dados = buscarDados($idTabuleiro);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Tabuleiro</title>
    
</head>
<body>

<?php 
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Criar Tabuleiro</h3><hr>
        
    <form method="post" action="ProcessaTabuleiro.php">
        <div>
            <label>Numero de Lados:</label><br>
            <input type="number" name="lado" value="<?php if($acao == "editar") echo $dados['lado']; else echo 0;?>" placeholder="Numero de Lados">
        </div>

    <br>
    <input  type="hidden" name="idTabuleiro" value="<?php echo $idTabuleiro;?>">


    <button value="Salvar" id="salvar" name="salvar" type="submit" class="btn btn-outline-info">Salvar</button>

    </form>

    </div>

    <!-- Aqui separa a criação de um tabuleiro para o listar dos tabuleiros -->

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
                    <h3 style="font-weight: bold">Procurar Tabuleiro</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                
                    <br>

                    <div>
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Lado<br>
                    <br>
                    </div>
                        <button type="submit" name="salvar" value="Salvar" class="btn btn-outline-info">Buscar</button>
                    
                </div>
              
                <br>

            </form>

            <table class="table table-striped">
            <tr><td><b>Id</b></td>
                <td><b>Qntd Lados</b></td>
                <td><b>Visualizar</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM tabuleiro
                                        WHERE idTabuleiro LIKE '$procurar%' 
                                        ORDER BY idTabuleiro");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM tabuleiro
                                        WHERE lado LIKE '$procurar%' 
                                        ORDER BY lado");}

        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
                // $cor = str_replace('#','%23', $linha['cor']);
        ?>
        <tr><td><?php echo $linha['idTabuleiro'];?></td>
            <td><?php echo $linha['lado'];?></td>
            <td><a href="showTabuleiro.php?idTabuleiro=<?php echo $linha['idTabuleiro']?>&lado=<?php echo $linha['lado']?>"><img src="img/visualizador.png" style="width: 1.8vw;"></td></a>
            <!-- <td><a href="show.php"> <img src="img/visualizador.png" style="width: 1.8vw;"></a> -->
            <td><a href='editarTabuleiro.php?acao=editar&idTabuleiro=<?php echo $linha['idTabuleiro'];?>&lado=<?php echo $linha['lado'];?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo "<a href=javascript:excluir('acaoTabuleiro.php?acao=excluir&idTabuleiro={$linha['idTabuleiro']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>