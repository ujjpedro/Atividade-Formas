<!DOCTYPE html>
<?php 

    //var_dump($_GET);
    include_once "acaoCubo.php";
    require_once "classes/Cubo.class.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == "editar"){
        $idCubo = isset($_GET['idCubo']) ? $_GET['idCubo'] : 0;
        $cor = isset($_GET['cor']) ? $_GET['cor'] : "";
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        $cor = str_replace('%23','#',$cor);

        //$quadrado = new Quadrado($id,$lado,$cor);
        //$quadrado->editar();
        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite o seu Cubo</title>

</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Editar Cubo</h3><hr>
        
    <form method="post" action="Processa.php">
        <div>
            <!-- <label>Id</label><br> -->
            <input readonly type="hidden" name="id" value="<?php if($acao == "editar") echo $id; else echo 0;?>">
        </div>
        <div>
            <label>Cor do Cubo:</label><br>
            <input type="color" name="cor" value="<?php if($acao == "editar") echo $cor; else echo 0;?>">
        </div>
        <br>
        <div>
            <label>Escolher o Quadrado</label><br>  
                    <select name="id" id="id" class="form-select">>
                        <?php
                        require_once ("selecionarTabuleiro.php");
                        echo listarQuadrado(0);
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