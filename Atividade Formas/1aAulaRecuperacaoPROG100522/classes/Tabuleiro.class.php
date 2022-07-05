<?php
    class Tabuleiro{
        private $idTabuleiro;
        private $lado = 0.000;

        public function __construct($idTabuleiro,$lado){
            $this->setLado($lado);
            $this->setIdTabuleiro($idTabuleiro);
        }

        public function getLado(){
            return $this->lado;
        }

        public function setLado($lado){
            if($lado > 0)
            $this->lado = $lado;
        }

        public function getIdTabuleiro(){
            return $this->idTabuleiro;
        }

        public function setIdTabuleiro($idTabuleiro){
            if($idTabuleiro > 0) 
            $this->idTabuleiro = $idTabuleiro;
        }

        public function __toString(){
            $str = "Id: ".$this->getIdTabuleiro().
            "<br><br> Numero de Lados: ".$this->getLado().
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
            $pdo = Conexao:: getInstance();
            $stmt = $pdo->prepare('INSERT INTO tabuleiro (lado) VALUES (:lado)');
            $stmt->bindValue(':lado', $this->getLado());
            
            return $stmt->execute();
            
        }

        public function excluir(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM tabuleiro WHERE idTabuleiro = :idTabuleiro');
            $stmt->bindValue(':idTabuleiro',$this->getIdTabuleiro(), PDO::PARAM_STR);
            
            return $stmt->execute();

            //$stmt->debugDumpParams();
        }

        public function editar() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE `tabuleiro` SET `lado` = :lado WHERE (`idTabuleiro` = :idTabuleiro);");
            $stmt->bindValue(':idTabuleiro', $this->getIdTabuleiro(), PDO::PARAM_INT);
            $stmt->bindValue(':lado', $this->getLado(), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function listar($buscar = 0, $procurar = ""){
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM tabuleiro";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE idtabuleiro = :procurar"; break;
                    case(2): $sql .= " WHERE lado like :procurar"; break;
                }
            $stmt = $pdo->prepare($sql);
            if ($buscar > 0)
                $stmt->bindValue(':procurar', $procurar, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function listarTabuleiro($tipo = 0, $info = ""){
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM tabuleiro";
            if ($tipo > 0)
                switch($tipo){
                    case(1): $sql .= " WHERE idTabuleiro like :info"; $info .="%"; break;
                    case(2): $sql .= " WHERE lado like :info"; $info .="%"; break;
                }

            $stmt = $pdo->prepare($sql);
            if ($tipo > 0)
                $stmt->bindValue(':info', $info, PDO::PARAM_STR);
                $stmt->execute();
            return $stmt->fetchAll();
        }
        
        public function buscarTabuleiro($idTabuleiro){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM tabuleiro';
            if($idTabuleiro > 0){
                $query .= ' WHERE idTabuleiro = :idTabuleiro';
                $stmt->bindParam(':idTabuleiro', $idTabuleiro);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }
    }

?>