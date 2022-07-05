<!DOCTYPE html>
<?php 
    
    include_once "acaoRetangulo.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    $idRetangulo = "";
    if ($acao == 'editar'){
        $idRetangulo = isset($_GET['idRetangulo']) ? $_GET['idRetangulo'] : "";
    if ($idRetangulo > 0)
        $dados = buscarDados($idRetangulo);
        
}?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Retangulo</title>
    
</head>
<body>

<?php 
    require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Criar Retangulo</h3><hr>
        
    <form method="post" action="ProcessaRetangulo.php">
        <div>
            <label>Cor do Retangulo:</label><br>
            <input type="color" name="cor" value="<?php if($acao == "editar") echo $dados['cor']; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Altura do Retangulo:</label><br>
            <input type="number" name="alturaRetangulo" value="<?php if ($acao == "editar") echo $dados['alturaRetangulo']; else echo 0;?>" placeholder="Insira o tamanho da altura">
        </div>
        <br>
        <div>
            <label>Base do Retangulo:</label><br>
            <input type="number" name="baseRetangulo" value="<?php if ($acao == "editar") echo $dados['baseRetangulo']; else echo 0;?>" placeholder="Digite o tamanho da base">
        </div>
        <br>
        <div>
            <label>Escolher o Tabuleiro</label><br>  
                    <select name="retangulo_idTabuleiro" id="retangulo_idTabuleiro" class="form-select">>
                        <?php
                        require_once ("selecionarTabuleiro.php");
                        echo listarTabuleiro(0);
                        ?>
        </div>

    <br>
    <input  type="hidden" name="idRetangulo" value="<?php echo $idRetangulo;?>">

    <br>

    <button value="Salvar" id="salvar" name="Salvar" type="submit" class="btn btn-outline-info">Salvar</button>

    </form>

    </div>

    <!-- Aqui separa a criação de um retangulo para o listar dos retangulos -->

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
                    <h3 style="font-weight: bold">Procurar Retangulo</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                
                    <br>

                    <div>
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Altura<br>
                        <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> Base<br>
                        <input type="radio" name="busca" value="4" class="form-check-input" <?php if ($busca == "4") echo "checked" ?>> Cor<br>
                    <br>
                    </div>
                        <button type="submit" name="salvar" value="Salvar" class="btn btn-outline-info">Buscar</button>
                    
                </div>
              
                <br>

            </form>

            <table class="table table-striped">
            <tr><td><b>Id</b></td>
                <td><b>Altura</b></td>
                <td><b>Base</b></td>
                <td><b>Cor</b></td>
                <td><b>Id Tabuleiro</b></td>
                <td><b>Visualizar</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM retangulo
                                        WHERE idRetangulo LIKE '$procurar%' 
                                        ORDER BY idRetangulo");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM retangulo
                                        WHERE altura LIKE '$procurar%' 
                                        ORDER BY altura");}

            else if($busca == 3){
                $consulta = $pdo->query("SELECT * FROM retangulo
                                        WHERE base LIKE '$procurar%' 
                                        ORDER BY base");}

            else if($busca == 4){
                $consulta = $pdo->query("SELECT * FROM retangulo 
                                        WHERE cor LIKE '$procurar%'
                                        ORDER BY cor");}

            else if($busca == 5){
                $consulta = $pdo->query("SELECT * FROM retangulo 
                                        WHERE retangulo_idTabuleiro LIKE '$procurar%'
                                        ORDER BY retangulo_idTabuleiro");}
        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
                $cor = str_replace('#','%23', $linha['cor']);

            
        ?>
        <tr><td><?php echo $linha['idRetangulo'];?></td>
            <td><?php echo $linha['alturaRetangulo'];?></td>
            <td><?php echo $linha['baseRetangulo'];?></td>
            <td><?php echo $linha['cor'];?></td>
            <td><?php echo $linha['retangulo_idTabuleiro'];?></td>
            <td><a href="showRetangulo.php?idRetangulo=<?php echo $linha['idRetangulo']?>&alturaRetangulo=<?php echo $linha['alturaRetangulo']?>&baseRetangulo=<?php echo $linha['baseRetangulo']?>&cor=<?php echo $cor?>"><img src="img/visualizador.png" style="width: 1.8vw;"></td></a>
            <!-- <td><a href="show.php"> <img src="img/visualizador.png" style="width: 1.8vw;"></a> -->
            <td><a href='editarRetangulo.php?acao=editar&idRetangulo=<?php echo $linha['idRetangulo'];?>&alturaRetangulo=<?php echo $linha['alturaRetangulo'];?>&baseRetangulo=<?php echo $linha['baseRetangulo'];?>&cor=<?php echo $cor;?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo "<a href=javascript:excluir('acaoRetangulo.php?acao=excluir&idRetangulo={$linha['idRetangulo']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>