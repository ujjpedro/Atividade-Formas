<!DOCTYPE html>
<?php 

    //var_dump($_GET);
    include_once "acao.php";
    require_once "classes/Quadrado.class.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == "editar"){
        $idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : 0;
        $lado = isset($_GET['lado']) ? $_GET['lado'] : 0;

        //$quadrado = new Quadrado($id,$lado,$cor);
        //$quadrado->editar();
        
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edite o seu Tabuleiro</title>
    
</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Editar Tabuleiro</h3><hr>
        
    <form method="post" action="ProcessaTabuleiro.php">
        <div>
            <!-- <label>Id</label><br> -->
            <input readonly type="hidden" name="idTabuleiro" value="<?php if($acao == "editar") echo $idTabuleiro; else echo 0;?>" placeholder="Id">
        </div>
        <div>
        <br>
        <div>
            <label>Numero de Lados:</label><br>
            <input type="number" name="lado" value="<?php if($acao == "editar") echo $lado; else echo 0;?>" placeholder="Numero de Lados">
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