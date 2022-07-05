<?php

    require_once "AutoLoad.class.php";

    class Circulo extends Formas{
        private $idCirculo;
        private $raio;
        
        public function __construct($idCirculo, $raio, $cor, $idTabuleiro){
            parent::__construct($idCirculo, $cor, $idTabuleiro);
            $this->setRaio($raio);
        }

        public function getRaio(){ return $this->raio; }
        public function setRaio($raio){ $this->raio = $raio;}

        public function area() {
            $area = pi() * pow($this->raio, 2);
            return $area;
        }


        public function circunferencia() {
            $circunferencia = 2 * pi() * $this->raio;
            return $circunferencia;
        }

        public function diametro() {
            $diametro = 2 * $this->raio;
            return $diametro;
        }

        public function insere(){
            $sql = 'INSERT INTO circulo (raio, cor, circulo_idTabuleiro) 
            VALUES(:raio, :cor, :circulo_idTabuleiro)';
            $parametros = array(":raio"=> $this->getRaio(),
                                ":cor"=> $this->getCor(),
                                ":circulo_idTabuleiro"=> $this->getCirculo_IdTabuleiro());

            return parent::executaComando($sql, $parametros); 
        }

        public function editar(){
            $sql = 'UPDATE circulo SET raio = :raio, cor = :cor, circulo_idTabuleiro = :circulo_idTabuleiro WHERE idCirculo = :idCirculo';
            $parametros = array(":raio"=> $this->getRaio(),
                                ":cor"=> $this->getCor(),
                                ":circulo_idTabuleiro"=> $this->getCirculo_IdTabuleiro(),
                                ":idCirculo"=> $this->getIdCirculo());

            return parent::executaComando($sql, $parametros); 
        }

        public function excluir(){
            $sql ='DELETE FROM circulo WHERE idCirculo = :idCirculo';
            $parametros = array(":idCirculo" => $this->getIdCirculo());

            return parent::executaComando($sql, $parametros); 
        }

        public static function listar($cnst = 0, $procurar = ""){
            $sql = "SELECT * FROM circulo";
            if ($cnst > 0)
                switch($cnst){
                    case(1): $sql .= " WHERE raio like :procurar"; $procurar .="%"; break;
                    case(2): $sql .= " WHERE raio like :procurar"; $procurar .="%"; break;
                    case(3): $sql .= " WHERE cor like :procurar"; $procurar .="%"; break;
                    case(4): $sql .= " WHERE circulo_idTabuleiro = :procurar"; break;
                }

            $par = array();
            if ($cnst > 0)
                $par = array(':procurar'=>$procurar);
            return parent::buscar($sql, $par);
        }

        public function desenha(){
            $str = "<div style='border-radius: 50%; display: inline-block; width: ".$this->diametro()."vw; 
            height: ".$this->diametro()."vw; background: ".$this->getCor().";border: 5px solid".$this->getCor().";'></div><br>";
            return $str;
        }

        public function __toString(){
            $str = parent::__toString();
            $str .= "<br>O Raio do Círculo: ".$this->getRaio().
            "<br>A Área do Círculo: ".round($this->area(),2).
            "<br>A Circunferência do Círculo: ".round($this->circunferencia(),2).
            "<br>O Diâmetro do Círculo: ".round($this->diametro(),2);
            return $str;
        }

        public function calcArea(){}
        public function inserir(){}
    }
?>