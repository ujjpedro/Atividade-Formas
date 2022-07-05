<?php
 
    // require_once "AutoLoad.class.php";
    require_once ("classes/Formas.class.php");
    class Triangulo extends Formas{
        private $baseTriangulo;
        private $ladoTriangulo1;
        private $ladoTriangulo2;

        public function __construct($idTriangulo, $cor, $triangulo_idTabuleiro, $baseTriangulo, $ladoTriangulo1, $ladoTriangulo2) {
            parent::__construct($idTriangulo, $cor, $triangulo_idTabuleiro);
            $this->setBaseTriangulo($baseTriangulo);
            $this->setLadoTriangulo1($ladoTriangulo1);
            $this->setLadoTriangulo2($ladoTriangulo2);
        }

        public function getBaseTriangulo(){ 
            return $this->baseTriangulo; 
        }

        public function setBaseTriangulo($baseTriangulo){ 
            $this->baseTriangulo = $baseTriangulo;
        }      

        public function getLadoTriangulo1(){ 
            return $this->ladoTriangulo1; 
        }

        public function setLadoTriangulo1($ladoTriangulo1){ 
            $this->ladoTriangulo1 = $ladoTriangulo1;
        }      

        public function getLadoTriangulo2() {
            return $this->ladoTriangulo2;
        }

        public function setLadoTriangulo2($ladoTriangulo2) {
                $this->ladoTriangulo2 = $ladoTriangulo2;
        }

        
        public function insere(){
            $sql = 'INSERT INTO triangulo (baseTriangulo, ladoTriangulo1, ladoTriangulo2, cor, triangulo_idTabuleiro) 
            VALUES(:baseTriangulo, :ladoTriangulo1, :ladoTriangulo2, :cor, :triangulo_idTabuleiro)';
            $parametros = array(":baseTriangulo"=> $this->getBaseTriangulo(),
                                ":ladoTriangulo1"=> $this->getLadoTriangulo1(),
                                ":ladoTriangulo2"=> $this->getLadoTriangulo2(),
                                ":cor"=> $this->getCor(),
                                ":triangulo_idTabuleiro"=> $this->getTriangulo_idTabuleiro());
        }


        public function editar(){
            $sql = 'UPDATE triangulo SET baseTriangulo = :baseTriangulo, ladoTriangulo1 = :ladoTriangulo1, ladoTriangulo2 = :ladoTriangulo2, cor = :cor,  triangulo_idTabuleiro =  :triangulo_idTabuleiro WHERE idTriangulo = :idTriangulo';
            $parametros = array(":baseTriangulo"=> $this->getBaseTriangulo(),
                                ":ladoTriangulo1"=> $this->getLadoTriangulo1(),
                                ":ladoTriangulo2"=> $this->getLadoTriangulo2(),
                                ":cor"=> $this->getCor(),
                                ":triangulo_idTabuleiro"=> $this->getTriangulo_idTabuleiro(),
                                ":idTriangulo"=> $this->getIdTriangulo());

            return parent::executaComando($sql, $parametros); 
        }

        
        public function excluir(){
            $sql ='DELETE FROM triangulo WHERE idTriangulo = :idTriangulo';
            $parametros = array(":idTriangulo" => $this->getIdTriangulo());

            return parent::executaComando($sql, $parametros); 
        }

        public static function listar($cnst = 0, $procurar = ""){
            $sql = "SELECT * FROM triangulo";
            if ($cnst > 0)
                switch($cnst){
                    case(1): $sql .= " WHERE idTriangulo like :procurar"; $procurar .="%"; break;
                    case(2): $sql .= " WHERE cor like :procurar"; $procurar .="%"; break;
                    case(3): $sql .= " WHERE triangulo_idTabuleiro like :procurar"; $procurar .="%"; break;

                }
            
            $par = array();
            if ($cnst > 0)
                $par = array(':procurar'=>$procurar);
            return parent::buscar($sql, $par);
        }

        public function __toString() {
            $str = parent::__toString();
            $str .= "Base Triangulo: ".$this->getBaseTriangulo()."<br>".
                    "Lado Triangulo1: ".$this->getLadoTriangulo1()."<br>".
                    "Lado Triangulo2: ".$this->getLadoTriangulo2()."<br>".
                    "Tipo do Triangulo: ".$this->tipo()."<br>";
            return $str;
        }
        
        public function tipo(){
            if($this->getBaseTriangulo() == $this->getLadoTriangulo1() && $this->getLadoTriangulo1() == $this->getLadoTriangulo2()){
                return "Triangulo Equilátero";
            }elseif($this->getBaseTriangulo() == $this->getLadoTriangulo1() || $this->getBaseTriangulo() == $this->getLadoTriangulo2() || $this->getLadoTriangulo1() == $this->getLadoTriangulo2()){
                return "Triangulo Isóceles";
            }else{
                return "Triangulo Escaleno";
            }
        }

        public function desenhar(){
            // $str = "<div class='ts' style='width: ".$this->getBaseRetangulo()."vw; height: ".$this->getAlturaRetangulo()."vw; 
            // background: ".$this->getCor().";border: 1px solid".$this->getCor().";'></div><br>";
            // return $str;
             $str = "<div style='width: 0px; height: 0px; border-left: ".$this->baseTriangulo."px solid transparent; border-right: ".$this->ladoTriangulo1."px solid transparent; border-bottom: ".$this->ladoTriangulo2."px solid ".parent::getCor().";'></div><br>";
             return $str;
         }

        public function desenha(){}
        public function calcArea(){}
        public function inserir(){}
        // public function editar(){}
        // public function excluir(){}
        // public static function  listar($tipo = 0, $info = ""){}
    }

?>



