<!DOCTYPE html>
<?php 

    //var_dump($_GET);
    include_once "acaoCirculo.php";
    require_once "classes/Circulo.class.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == "editar"){
        $idCirculo = isset($_GET['idCirculo']) ? $_GET['idCirculo'] : 0;
        $raio = isset($_GET['raio']) ? $_GET['raio'] : 0;
        $cor = isset($_GET['cor']) ? $_GET['cor'] : "";
        $circulo_idTabuleiro = isset($_GET['circulo_idTabuleiro']) ? $_GET['circulo_idTabuleiro'] : 0;

        $cor = str_replace('%23','#',$cor);
        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite o seu Circulo</title>
    
</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Editar Circulo</h3><hr>
        
    <form method="post" action="ProcessaCirculo.php">
        <div>
            <!-- <label>Id</label><br> -->
            <input readonly type="hidden" name="id" value="<?php if($acao == "editar") echo $id; else echo 0;?>" placeholder="ID">
        </div>
        <div>
            <label>Cor do Circulo:</label><br>
            <input type="color" name="cor" value="<?php if($acao == "editar") echo $cor; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Numero do Raio:</label><br>
            <input type="number" name="raio" value="<?php if($acao == "editar") echo $raio; else echo 0;?>" placeholder="Numero do Raio">
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