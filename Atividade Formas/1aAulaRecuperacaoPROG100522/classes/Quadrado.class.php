<?php

require_once "AutoLoad.class.php";

    class Quadrado extends Formas{
        private $id;
        private $lado = 0.000;
        private $cor = "";
        private $tabuleiro_idTabuleiro;

        public function __construct($id,$lado, $cor, $tabuleiro_idTabuleiro){
            $this->setLado($lado);
            $this->setCor($cor);
            $this->setId($id);
            $this->setTabuleiro_idTabuleiro($tabuleiro_idTabuleiro);
        }

        public function getLado(){
            return $this->lado;
        }

        public function setLado($lado){
            if($lado > 0)
            $this->lado = $lado;
        }

        public function getCor(){
            return $this->cor;
        }

        public function setCor($cor){
            if(strlen($cor) > 0)
            $this->cor = $cor;
        }
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            if($id > 0) 
            $this->id = $id;
        }

        public function getTabuleiro_idTabuleiro(){
            return $this->tabuleiro_idTabuleiro;
        }

        public function setTabuleiro_idTabuleiro($tabuleiro_idTabuleiro){
            if($tabuleiro_idTabuleiro > 0) 
            $this->tabuleiro_idTabuleiro = $tabuleiro_idTabuleiro;
        }


        public function __toString(){
            $str = "Id: ".$this->getId().
            "<br><br>Cor do Quadrado: ".$this->getCor().
            "<br><br> Numero de Lados: ".$this->getLado().
            "<br><br>".
            "Id do Tabuleiro: ".$this->getTabuleiro_idTabuleiro().
            "<br><br>".
            "Area do Quadrado: ".$this->area().
            "<br><br>".
            "Perimetro do Quadrado: ".$this->perimetro().
            "<br><br>".
            "Diagonal: ".$this->diagonal().
            "<br><br>";

            return $str;
        }

        public function area(){
            return ($this->lado * $this->lado);
        }

        public function perimetro(){
            return ($this->lado * 4);
        }

        public function diagonal(){
            return ($this->lado * sqrt(2));
        }

        public function inserir(){
            // $pdo = Conexao:: getInstance();
            $sql = "INSERT INTO quadrado (lado, cor, tabuleiro_idTabuleiro) VALUES (:lado, :cor, :tabuleiro_idTabuleiro)";
            $parametros = array(":lado"=>$this->getLado(),
                                ":cor"=>$this->getCor(),
                                ":tabuleiro_idTabuleiro"=>$this->getTabuleiro_idTabuleiro());

            return parent::executaComando($sql,$parametros);
            
        }

        public function excluir(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM quadrado WHERE id = :id');
            $par = array('id'=>$this->getId());
            $stmt->bindValue(':id',$this->getId(), PDO::PARAM_STR);
            
            return $stmt->execute();

            //$stmt->debugDumpParams();
        }

        public function editar() {
            $sql = "UPDATE quadrado
                    SET lado = :lado, cor = :cor, tabuleiro_idTabuleiro = :tabuleiro_idTabuleiro
                    WHERE id = :id";

            $par = array(':lado'=>$this->getLado(),
                        ':cor'=>$this->getCor(),
                        ':tabuleiro_idTabuleiro'=>$this->getTabuleiro_idTabuleiro(),
                        ':id'=>$this->getId());
            return parent:: executaComando($sql,$par);
        }

        // public function buscarQuadrado(){
        //     require_once("conf/Conexao.php");

        //     $conexao = Conexao::getInstance();

        //     $query = 'SELECT * FROM quadrado';
        //     if($id > 0){
        //         $query .= ' WHERE id = :id';
        //         $stmt->bindParam(':id', $id);
        //     }
        //         $stmt = $conexao->prepare($query);
        //         if($stmt->execute())
        //             return $stmt->fetchAll();
        
        //         return false;

        // }

        
        public static function listar($tipo = 0, $info = ""){
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM quadrado";
            if ($tipo > 0)
                switch($tipo){
                    case(1): $sql .= " WHERE id like :info"; $info .="%"; break;
                    case(2): $sql .= " WHERE lado like :info"; $info .="%"; break;
                    case(3): $sql .= " WHERE cor like :info"; $info .="%"; break;
                    case(4): $sql .= " WHERE tabuleiro_idTabuleiro = :info"; break;
                }

            if ($tipo > 0)
                $par = array(':info'=>$info);
            else
                $par = array();
            return parent::buscar($sql,$par);
        }

        public function desenha(){
            $x = "<div style='height: ".$this->getLado()."vh; 
                    width: ".$this->getLado()."vh;
                    background-color:".$this->getCor().";'></div>";
            return $x;
        }

        public function calcArea(){
            //TODO: implementar o cálculo...
        }
    }

?>