<!DOCTYPE html>
<?php 

    //var_dump($_GET);
    include_once "acaoTriangulo.php";
    require_once "AutoLoad.class.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == "editar"){
        $idTriangulo = isset($_GET['idTriangulo']) ? $_GET['idTriangulo'] : 0;
        $baseTriangulo = isset($_GET['baseTriangulo']) ? $_GET['baseTriangulo'] : 0;
        $ladoTriangulo1 = isset($_GET['ladoTriangulo1']) ? $_GET['ladoTriangulo1'] : 0;
        $ladoTriangulo2 = isset($_GET['ladoTriangulo2']) ? $_GET['ladoTriangulo2'] : 0;
        $cor = isset($_GET['cor']) ? $_GET['cor'] : "";
        $triangulo_idTabuleiro = isset($_GET['triangulo_idTabuleiro']) ? $_GET['triangulo_idTabuleiro'] : 0;

        $cor = str_replace('%23','#',$cor);

        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite o seu Triangulo</title>
    
</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Editar Triangulo</h3><hr>
        
    <form method="post" action="ProcessaTriangulo.php">
        <div>
            <!-- <label>Id</label><br> -->
            <input readonly type="hidden" name="id" value="<?php if($acao == "editar") echo $id; else echo 0;?>">
        </div>
        <div>
            <label>Cor do Triangulo:</label><br>
            <input type="color" name="cor" value="<?php if($acao == "editar") echo $cor; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Base do Triangulo:</label><br>
            <input type="text" name="baseTriangulo" value="<?php if ($acao == "editar") echo $baseTriangulo; else echo 0;?>" placeholder="Digite o tamanho da base">
        </div>
        <br>
        <div>
            <label>Lado 1 do Triangulo:</label><br>
            <input type="text" name="ladoTriangulo1" value="<?php if ($acao == "editar") echo $ladoTriangulo1; else echo 0;?>" placeholder="Digite o tamanho da lado">
        </div>
        <br>
        <div>
            <label>Lado 2 do Triangulo:</label><br>
            <input type="text" name="ladoTriangulo2" value="<?php if ($acao == "editar") echo $ladoTriangulo2; else echo 0;?>" placeholder="Digite o tamanho da lado">
        </div>
        <br>
        <div>
            <label>Escolher o Tabuleiro</label><br>  
                    <select name="tabuleiro_idTabuleiro" id="tabuleiro_idTabuleiro" class="form-select">>
                        <?php
                        require_once ("selecionarTabuleiro.php");
                        echo listarTabuleiro(0);
                        ?>
                        </select>
        </div>
        <br>
        <button value="editar" name="editar" type="submit" class="btn btn-outline-info">Salvar</button>

    </form>

</div>
<hr style="width: 98.7%; margin-left: 12px;">
<br>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>