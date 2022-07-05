<?php

    require_once "AutoLoad.class.php";
    
?>

<?php
    class Retangulo extends Formas{
        private $alturaRetangulo;
        private $baseRetangulo;
        private $idRetangulo;
        
        public function __construct($idRetangulo, $alturaRetangulo, $baseRetangulo, $cor, $retangulo_idTabuleiro){
            parent::__construct($idRetangulo, $cor, $retangulo_idTabuleiro);
            $this->setAlturaRetangulo($alturaRetangulo);
            $this->setBaseRetangulo($baseRetangulo);
        }

        public function getIdRetangulo(){ 
            return $this->idRetangulo; 
        }

        public function setIdRetangulo($idRetangulo){ 
            $this->idRetangulo = $idRetangulo;
        }   

        public function getAlturaRetangulo(){ return $this->alturaRetangulo; }
        public function setAlturaRetangulo($alturaRetangulo){ $this->alturaRetangulo = $alturaRetangulo;}

        public function getBaseRetangulo(){ return $this->baseRetangulo; }
        public function setBaseRetangulo($baseRetangulo){ $this->baseRetangulo = $baseRetangulo;}

        public function area() {
            $area = $this->baseRetangulo * $this->alturaRetangulo;
            return $area;
        }

        public static function inserir(){
            $sql = 'INSERT INTO formas.retangulo (alturaRetangulo, baseRetangulo, cor, retangulo_idTabuleiro) 
            VALUES(:alturaRetangulo, :baseRetangulo, :cor, :retangulo_idTabuleiro)';
            $parametros = array(":alturaRetangulo"=>$this->getAlturaRetangulo(), 
                                ":baseRetangulo"=>$this->getBaseRetangulo(), 
                                ":cor"=>$this->getCor(),
                                ":retangulo_idTabuleiro"=>$this->getTabuleiro_idTabuleiro());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM formas.retangulo WHERE idRetangulo = :idRetangulo';
            $parametros = array(":idRetangulo"=>$this->getIdRetangulo());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE formas.retangulo 
            SET alturaRetangulo = :alturaRetangulo, baseRetangulo = :baseRetangulo, cor = :cor, retangulo_idTabuleiro = :retangulo_idTabuleiro
            WHERE idRetangulo = :idRetangulo';
            $parametros = array(":alturaRetangulo"=>$this->getAlturaRetangulo(),
                                ":baseRetangulo"=>$this->getBaseRetangulo(),
                                ":cor"=>$this->getCor(),
                                ":retangulo_idTabuleiro"=>$this->getTabuleiro_idTabuleiro(),
                                ":idRetangulo"=>$this->getIdRetangulo());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($cnst = 0, $procurar = ""){
            $sql = "SELECT * FROM retangulo";
            if ($cnst > 0)
                switch($cnst){
                    case(1): $sql .= " WHERE idRetangulo like :procurar"; $procurar .= "%";break;
                    case(2): $sql .= " WHERE alturaRetangulo like :procurar"; $procurar .= "%";break;
                    case(3): $sql .= " WHERE baseRetangulo like :procurar"; $procurar .= "%";break;
                    case(4): $sql .= " WHERE cor like :procurar"; $procurar .= "%";break;
                    case(5): $sql .= " WHERE retangulo_idTabuleiro like :procurar"; $procurar .= "%";break;
                }

            $par = array();
            if ($cnst > 0)
                $par = array(':procurar'=>$procurar);
            return parent::buscar($sql, $par);
        }

        public function desenhar(){
            $str = "<div class='ts' style='width: ".$this->getBaseRetangulo()."vw; height: ".$this->getAlturaRetangulo()."vw; 
            background: ".$this->getCor().";border: 1px solid".$this->getCor().";'></div><br>";
            return $str;
        }

        public function __toString(){
           $str = parent::__toString();
           $str .= "<br>Altura:".$this->getAlturaRetangulo().
           "<br>Base:".$this->getBaseRetangulo().
           "<br>Área: ".round($this->area(),2);
           return $str;
        }

        // public function desenha(){}
        // public function calcArea(){}
        // public function inserir(){}
        // public function editar(){}
        // public function excluir(){}
        // public static function  listar($tipo = 0, $info = ""){}
        
    }