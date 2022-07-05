<?php
   
        require "AutoLoad.class.php";
        include_once "conf/default.inc.php";
        require_once "conf/Conexao.php";

        $idTriangulo = isset($_POST['idTriangulo']) ? $_POST['idTriangulo'] : 0;
        $baseTriangulo = isset($_POST['baseTriangulo']) ? $_POST['baseTriangulo'] : 0;
        $ladoTriangulo1 = isset($_POST['ladoTriangulo1']) ? $_POST['ladoTriangulo1'] : 0;
        $ladoTriangulo2 = isset($_POST['ladoTriangulo2']) ? $_POST['ladoTriangulo2'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $triangulo_idTabuleiro = isset($_POST['triangulo_idTabuleiro']) ? $_POST['triangulo_idTabuleiro'] : 0;

        $acao = isset($_POST['editar']) ? $_POST['editar'] : "";

        $salvar = isset($_POST['salvar']) ? $_POST['salvar'] : "";

        //var_dump($cor);
    ?>

<?php

require_once "ProcessaTriangulo.php";

    if ($acao == "editar") {
        
        echo "Id:".$idTriangulo."<br>
            Base: ".$baseTriangulo."<br>
            Lado 1: ".$ladoTriangulo1."<br>
            Lado 2: ".$ladoTriangulo2."<br>
            cor: ".$cor."<br>
            Id Tabuleiro: ".$triangulo_idTabuleiro;
        
        $triangulo = new Triangulo($idTriangulo,$baseTriangulo,$ladoTriangulo1,$ladoTriangulo2,$cor,$triangulo_idTabuleiro);
        $triangulo->editar();

        header("location:indexTriangulo.php"); 

        //echo "Pedro Coelho";
    }

    if ($salvar == "Salvar") {
        $triangulo = new Triangulo(NULL,$baseTriangulo,$ladoTriangulo1,$ladoTriangulo2,$cor,$triangulo_idTabuleiro);
        $triangulo->inserir();

        header("location:indexTriangulo.php"); 

        //echo $quadrado;
        //echo "Salvou";
    }
    

?>
