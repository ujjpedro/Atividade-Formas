<?php
    //var_dump($_POST);
    require "AutoLoad.class.php";
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

        $idCirculo = isset($_POST['idCirculo']) ? $_POST['idCirculo'] : 0;
        $raio = isset($_POST['raio']) ? $_POST['raio'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $circulo_idTabuleiro = isset($_POST['circulo_idTabuleiro']) ? $_POST['circulo_idTabuleiro'] : 0;

        $acao = isset($_POST['editar']) ? $_POST['editar'] : "";

        $salvar = isset($_POST['salvar']) ? $_POST['salvar'] : "";

        //var_dump($cor);
    ?>

<?php

require_once "ProcessaCirculo.php";

    if ($acao == "editar") {
        
        echo "Id:".$idCirculo."<br>
            Raio: ".$raio."<br>
            cor: ".$cor."<br>
            Id Tabuleiro: ".$circulo_idTabuleiro;
        
        $circulo = new Circulo($idCirculo,$raio,$cor,$circulo_idTabuleiro);
        $circulo->editar();

        header("location:indexCirculo.php"); 

        //echo "Pedro Coelho";
    }

    if ($salvar == "Salvar") {
        $circulo = new Circulo(NULL,$raio,$cor,$circulo_idTabuleiro);
        $circulo->inserir();

        // header("location:indexCirculo.php"); 

        //echo $quadrado;
        //echo "Salvou";
    }
    

?>
<div class="container-fluid">

</body>
</html>