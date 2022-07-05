<?php

    require_once "AutoLoad.class.php";

    class Cubo extends Quadrado{
        private $idCubo;

        public function __construct($idCubo, $ladoCubo, $cor, $id) {
            parent::__construct($id, $ladoCubo, $cor, '');
            $this->setIdCubo($idCubo);
            $this->setCor($cor);
        }

        public function getIdCubo(){ return $this->idCubo; }
        public function setIdCubo($idCubo){ $this->idCubo = $idCubo;}

        public function getCor() { return $this->cor;}
        public function setCor($cor) { $this->cor = $cor;}
        
        public function areaCubo() {
            $area = 6 * pow($this->getLadoCubo(),2);
            return $area;
        }

        public function perimetroCubo() {
            $perimetro = $this->getLadoCubo() * 12;
            return $perimetro;
        }

        public function diagonalCubo() {
            $diagonal = $this->getLadoCubo() * sqrt(3);
            return $diagonal;
        }

        public function volumeCubo() {
            $volume = pow($this->getLadoCubo(),3);
            return $volume;
        }

        public function insere(){
            $sql = 'INSERT INTO cubo (cor, idQuadrado) 
            VALUES(:cor, :idQuadrado)';
            $parametros = array(":cor"=> $this->getCor(),
                                ":idQuadrado"=> $this->getId());

            return parent::executaComando($sql, $parametros); 
        }

        public function editar(){
            $sql = 'UPDATE cubo SET cor = :cor, idQuadrado = :idQuadrado WHERE idCubo = :idCubo';
            $parametros = array(":cor"=> $this->getCor(),
                                ":idQuadrado"=> $this->getId(),
                                ":idCubo"=> $this->getIdCubo());

            return parent::executaComando($sql, $parametros); 
        }

        public function excluir(){
            $sql ='DELETE FROM cubo WHERE idCubo = :idCubo';
            $parametros = array(":idCubo" => $this->getIdCubo());

            return parent::executaComando($sql, $parametros); 
        }

        public static function listar($cnst = 0, $procurar = ""){
            $sql = "SELECT * FROM cubo";
            if ($cnst > 0)
                switch($cnst){
                    case(1): $sql .= " WHERE idCubo like :procurar"; $procurar .= "%";break;
                    case(2): $sql .= " WHERE cor like :procurar"; $procurar .="%"; break;
                    case(3): $sql .= " WHERE idQuadrado = :procurar"; break;
                }

            $par = array();
            if ($cnst > 0)
                $par = array(':procurar'=>$procurar);
            return parent::buscar($sql, $par);
        }

        public function dividirCubo(){
            return $this->getLadoCubo() / 2;
        }

        public function desenha(){
            $cubo = "<div style='width: ".$this->getLadoCubo()."px; height: ".$this->getLadoCubo()."px; animation: rotate 10s infinite alternate; transform-style: preserve-3d;'>
                        <div style='background: linear-gradient(45deg, ".$this->getCor().", ".$this->getCor()."); border: 2px solid white; display: flex; width: ".$this->getLadoCubo()."px; height: ".$this->getLadoCubo()."px; 
                            position: absolute; transform: translateZ(".$this->dividirCubo()."px);'></div>
                        <div style='background: linear-gradient(45deg, ".$this->getCor().", ".$this->getCor()."); border: 2px solid white; display: flex; width: ".$this->getLadoCubo()."px; height: ".$this->getLadoCubo()."px; 
                            position: absolute; transform: rotateY(90deg) translateZ(".$this->dividirCubo()."px);'></div>
                        <div style='background: linear-gradient(45deg, ".$this->getCor().", ".$this->getCor()."); border: 2px solid white; display: flex; width: ".$this->getLadoCubo()."px; height: ".$this->getLadoCubo()."px; 
                            position: absolute; transform: rotateY(180deg) translateZ(".$this->dividirCubo()."px);'></div>
                        <div style='background: linear-gradient(45deg, ".$this->getCor().", ".$this->getCor()."); border: 2px solid white; display: flex; width: ".$this->getLadoCubo()."px; height: ".$this->getLadoCubo()."px; 
                            position: absolute; transform: rotateY(-90deg) translateZ(".$this->dividirCubo()."px);'></div>
                        <div style='background: linear-gradient(45deg, ".$this->getCor().", ".$this->getCor()."); border: 2px solid white; display: flex; width: ".$this->getLadoCubo()."px; height: ".$this->getLadoCubo()."px; 
                            position: absolute; transform: rotateX(90deg) translateZ(".$this->dividirCubo()."px);'></div>
                        <div style='background: linear-gradient(45deg, ".$this->getCor().", ".$this->getCor()."); border: 2px solid white; display: flex; width: ".$this->getLadoCubo()."px; height: ".$this->getLadoCubo()."px; 
                            position: absolute; transform: rotateX(-90deg) translateZ(".$this->dividirCubo()."px);'></div>
                    </div><br><br><br>";
            return $cubo;
        }

        public function __toString() {
            return  "<br>Id do Quadrado: ".$this->getId().
                    "<br>Id do Cubo: ".$this->getIdCubo().
                    "<br>Cor do Cubo: ".$this->getCor().
                    "<br>Área do Cubo: ".round($this->area(),2)." m²".
                    "<br>Perímetro do Cubo: ".round($this->perimetro(),2).
                    "<br>Diagonal do Cubo: ".round($this->diagonal(),2).
                    "<br>Volume do Cubo: ".round($this->volume(),2);
        }
    }
?>