<!DOCTYPE html>
<?php 

    //var_dump($_GET);
    include_once "acaoRetangulo.php";
    require_once "classes/Retangulo.class.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == "editar"){
        $idRetangulo = isset($_GET['idRetangulo']) ? $_GET['idRetangulo'] : "";
        $alturaRetangulo = isset($_GET['alturaRetangulo']) ? $_GET['alturaRetangulo'] : 0;
        $baseRetangulo = isset($_GET['baseRetangulo']) ? $_GET['baseRetangulo'] : 0;
        $cor = isset($_GET['cor']) ? $_GET['cor'] : "";
        $retangulo_idTabuleiro = isset($_GET['retangulo_idTabuleiro']) ? $_GET['retangulo_idTabuleiro'] : 0;
        $cor = str_replace('%23','#',$cor);

        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite o seu Retangulo</title>
    
</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Editar Retangulo</h3><hr>
        
    <form method="post" action="ProcessaRetangulo.php">
        <div>
            <!-- <label>Id</label><br> -->
            <input readonly type="hidden" name="idRetangulo" value="<?php if($acao == "editar") echo $idRetangulo; else echo 0;?>">
        </div>
        <div>
            <label>Cor do Retangulo:</label><br>
            <input type="color" name="cor" value="<?php if($acao == "editar") echo $cor; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Altura do Retangulo:</label><br>
            <input type="number" name="alturaRetangulo" value="<?php if ($acao == "editar") echo $dados; else echo 0;?>" placeholder="Insira o tamanho da altura">
        </div>
        <br>
        <div>
            <label>Base do Retangulo:</label><br>
            <input type="number" name="baseRetangulo" value="<?php if ($acao == "editar") echo $dados; else echo 0;?>" placeholder="Digite o tamanho da base">
        </div>
        <br>
        <div>
            <label>Escolher o Tabuleiro</label><br>  
                    <select name="retangulo_idTabuleiro" id="retangulo_idTabuleiro" class="form-select">>
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