
<?php

    //include_once 'conf/Conexao.php';
    //require_once 'conf/conf.inc.php';

    require_once('Database.class.php');

    abstract class Formas extends Database{
        private $id;
        private $cor;
        private $tabuleiro_idTabuleiro;
        private static $contador = 0;

        public function __construct($id, $cor, $tabuleiro_idTabuleiro) {
            $this->setId($id);
            $this->setCor($cor);
            $this->setTabuleiro_idTabuleiro($tabuleiro_idTabuleiro);
            self::$contador = self::$contador + 1;
        }

        public function getId(){ 
            return $this->id; 
        }

        public function setId($id){ 
            $this->id = $id;
        }      

        public function getCor() {
            return $this->cor;
        }

        public function setCor($cor) {
            if (strlen($cor) > 0)    
                $this->cor = $cor;
        }

        public function getTabuleiro_idTabuleiro() {
            return $this->tabuleiro_idTabuleiro;
        }

        public function setTabuleiro_idTabuleiro($tabuleiro_idTabuleiro) {
            if ($tabuleiro_idTabuleiro >  0)
                $this->tabuleiro_idTabuleiro = $tabuleiro_idTabuleiro;
        }

        public function __toString() {
            return  "[Forma]<br>id: ".$this->getId()."<br>".
                    "Cor: ".$this->getCor()."<br>".
                    "Id do Tabuleiro: ".$this->getTabuleiro_idTabuleiro()."<br>".
                    "Contador: ".self::$contador."<br>";
        }

        public static function inserira($cor, $tabuleiro_idTabuleiro){
            $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('INSERT INTO recuperacao.quadrado (cor, tabuleiro_idTabuleiro) VALUES (:cor, :tabuleiro_idTabuleiro)');
                $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
                $stmt->bindParam(':tabuleiro_idTabuleiro', $tabuleiro_idTabuleiro, PDO::PARAM_INT);
                return $stmt->execute();
        }

        public static function excluira($id){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('DELETE FROM quadrado WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public static function editara($id, $cor, $tabuleiro_idTabuleiro){
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE quadrado SET cor = :cor, tabuleiro_idTabuleiro = :tabuleiro_idTabuleiro WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':cor', $cor, PDO::PARAM_STR);
            $stmt->bindValue(':tabuleiro_idTabuleiro', $tabuleiro_idTabuleiro, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public abstract function desenha();
        public abstract function calcArea();
        public abstract function inserir();
        public abstract function editar();
        public abstract function excluir();
        public abstract static function  listar($tipo = 0, $info = "");
    }
?>