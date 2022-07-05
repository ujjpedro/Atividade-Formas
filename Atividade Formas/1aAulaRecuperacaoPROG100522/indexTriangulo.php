<!DOCTYPE html>
<?php 
    
    include_once "acaoTriangulo.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    $idTriangulo = 0;
    if ($acao == 'editar'){
        $idTriangulo = isset($_GET['idTriangulo']) ? $_GET['idTriangulo'] : "";
    if ($idTriangulo > 0)
        $dados = buscarDados($idTriangulo);
        
}?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Triangulo</title>
    
</head>
<body>

<?php 
    require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Criar Triangulo</h3><hr>
        
    <form method="post" action="ProcessaTriangulo.php">
        <div>
            <label>Cor do Triangulo:</label><br>
            <input type="color" name="cor" value="<?php if($acao == "editar") echo $dados['cor']; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Base do Triangulo:</label><br>
            <input type="text" name="baseTriangulo" value="<?php if ($acao == "editar") echo $dados['baseTriangulo'];?>" placeholder="Digite o tamanho da base">
        </div>
        <br>
        <div>
            <label>Lado 1 do Triangulo:</label><br>
            <input type="text" name="ladoTriangulo1" value="<?php if ($acao == "editar") echo $dados['ladoTriangulo1'];?>" placeholder="Digite o tamanho da lado">
        </div>
        <br>
        <div>
            <label>Lado 2 do Triangulo:</label><br>
            <input type="text" name="ladoTriangulo2" value="<?php if ($acao == "editar") echo $dados['ladoTriangulo2'];?>" placeholder="Digite o tamanho da lado">
        </div>
        <br>
        <div>
            <label>Escolher o Tabuleiro</label><br>  
                    <select name="tabuleiro_idTabuleiro" id="tabuleiro_idTabuleiro" class="form-select">>
                        <?php
                        require_once ("selecionarTabuleiro.php");
                        echo listarTabuleiro(0);
                        ?>
        </div>

    <br>
    <input  type="hidden" name="id" value="<?php echo $id;?>">

    <br>

    <button value="Salvar" id="salvar" name="salvar" type="submit" class="btn btn-outline-info">Salvar</button>

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
                    <h3 style="font-weight: bold">Procurar Triangulo</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                
                    <br>

                    <div>
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Base<br>
                        <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> Lado 1<br>
                        <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "4") echo "checked" ?>> Lado 2<br>
                        <input type="radio" name="busca" value="4" class="form-check-input" <?php if ($busca == "5") echo "checked" ?>> Cor<br>
                    <br>
                    </div>
                        <button type="submit" name="salvar" value="Salvar" class="btn btn-outline-info">Buscar</button>
                    
                </div>
              
                <br>

            </form>

            <table class="table table-striped">
            <tr><td><b>Id</b></td>
                <td><b>Base</b></td>
                <td><b>Lado 1</b></td>
                <td><b>Lado 2</b></td>
                <td><b>Cor</b></td>
                <td><b>Id Tabuleiro</b></td>
                <td><b>Visualizar</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM triangulo
                                        WHERE idTriangulo LIKE '$procurar%' 
                                        ORDER BY idTriangulo");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM triangulo
                                        WHERE baseTriangulo LIKE '$procurar%' 
                                        ORDER BY baseTriangulo");}

            else if($busca == 3){
                $consulta = $pdo->query("SELECT * FROM triangulo
                                        WHERE ladoTriangulo1 LIKE '$procurar%' 
                                        ORDER BY ladoTriangulo1");}

            else if($busca == 4){
                $consulta = $pdo->query("SELECT * FROM triangulo
                                        WHERE ladoTriangulo2 LIKE '$procurar%' 
                                        ORDER BY ladoTriangulo2");}

            else if($busca == 5){
                $consulta = $pdo->query("SELECT * FROM triangulo 
                                        WHERE cor LIKE '$procurar%'
                                        ORDER BY cor");}

            else if($busca == 6){
                $consulta = $pdo->query("SELECT * FROM triangulo 
                                        WHERE triangulo_idTabuleiro LIKE '$procurar%'
                                        ORDER BY triangulo_idTabuleiro");}
        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
                $cor = str_replace('#','%23', $linha['cor']);

            
        ?>
        <tr><td><?php echo $linha['idTriangulo'];?></td>
            <td><?php echo $linha['baseTriangulo'];?></td>
            <td><?php echo $linha['ladoTriangulo1'];?></td>
            <td><?php echo $linha['ladoTriangulo2'];?></td>
            <td><?php echo $linha['cor'];?></td>
            <td><?php echo $linha['triangulo_idTabuleiro'];?></td>
            <td><a href="showTriangulo.php?idTriangulo=<?php echo $linha['idTriangulo']?>&baseTriangulo=<?php echo $linha['baseTriangulo']?>&ladoTriangulo1=<?php echo $linha['ladoTriangulo1']?>&ladoTriangulo2=<?php echo $linha['ladoTriangulo2']?>&cor=<?php echo $cor?>"><img src="img/visualizador.png" style="width: 1.8vw;"></td></a>
            <!-- <td><a href="show.php"> <img src="img/visualizador.png" style="width: 1.8vw;"></a> -->
            <td><a href='editarTriangulo.php?acao=editar&idTriangulo=<?php echo $linha['idTriangulo'];?>&baseTriangulo=<?php echo $linha['baseTriangulo']?>&ladoTriangulo1=<?php echo $linha['ladoTriangulo1']?>&ladoTriangulo2=<?php echo $linha['ladoTriangulo2']?>&cor=<?php echo $cor;?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo "<a href=javascript:excluir('acaoTriangulo.php?acao=excluir&id={$linha['idTriangulo']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>