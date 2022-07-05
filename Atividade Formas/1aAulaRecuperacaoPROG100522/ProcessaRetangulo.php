<?php
   
        require "AutoLoad.class.php";
        include_once "conf/default.inc.php";
        require_once "conf/Conexao.php";

        $idRetangulo = isset($_POST['idRetangulo']) ? $_POST['idRetangulo'] : 0;
        $alturaRetangulo = isset($_POST['alturaRetangulo']) ? $_POST['alturaRetangulo'] : 0;
        $baseRetangulo = isset($_POST['baseRetangulo']) ? $_POST['baseRetangulo'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $retangulo_idTabuleiro = isset($_POST['retangulo_idTabuleiro']) ? $_POST['retangulo_idTabuleiro'] : 0;

        $acao = isset($_POST['editar']) ? $_POST['editar'] : "";

        $salvar = isset($_POST['Salvar']) ? $_POST['Salvar'] : "";

        //var_dump($cor);
    ?>

<?php

require_once "ProcessaRetangulo.php";

    if ($acao == "editar") {
        
        echo "Id:".$idRetangulo."<br>
            Altura: ".$alturaRetangulo."<br>
            Base: ".$baseRetangulo."<br>
            cor: ".$cor."<br>
            Id Tabuleiro: ".$retangulo_idTabuleiro;
        
        $retangulo = new Retangulo($idRetangulo,$alturaRetangulo,$baseRetangulo,$cor,$retangulo_idTabuleiro);
        $retangulo->editar();

        header("location:indexRetangulo.php"); 

        //echo "Pedro Coelho";
    }

    if ($salvar == "Salvar") {
        $retangulo = new Retangulo(NULL,$alturaRetangulo,$baseRetangulo,$cor,$retangulo_idTabuleiro);
        

        echo $idRetangulo,$alturaRetangulo,$baseRetangulo,$cor,$retangulo_idTabuleiro;
        $retangulo->inserir();

        header("location:indexRetangulo.php"); 

        //echo $quadrado;
        //echo "Salvou";
    }
    

?>