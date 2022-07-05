<?php
    class Usuario{
        private $idUsuario;
        private $nome = "";
        private $login = "";
        private $senha = "";

        public function __construct($idUsuario, $nome, $login, $senha){
            $this->setNome($nome);
            $this->setLogin($login);
            $this->setSenha($senha);
            $this->setIdUsuario($idUsuario);
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            if($nome > 0)
            $this->nome = $nome;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setLogin($login){
            if($login > 0)
            $this->login = $login;
        }
        
        public function getSenha(){
            return $this->senha;
        }

        public function setSenha($senha){
            if($senha > 0)
            $this->senha = $senha;
        }

        public function getIdUsuario(){
            return $this->idUsuario;
        }

        public function setIdUsuario($idUsuario){
            if($idUsuario > 0) 
            $this->idUsuario = $idUsuario;
        }

        public function __toString(){
            $str = "Id: ".$this->getIdUsuario().
            "<br><br>Login do Usuário: ".$this->getLogin().
            "<br><br>Nome: ".$this->getNome().
            "<br><br>Senha: ".$this->getSenha().
            "<br><br>";

            return $str;
        }

        public function inserir(){
            $pdo = Conexao:: getInstance();
            $stmt = $pdo->prepare('INSERT INTO usuario (nome, login, senha) VALUES (:nome, :login, :senha)');
            $stmt->bindValue(':nome', $this->getNome());
            $stmt->bindValue(':login', $this->getLogin());
            $stmt->bindValue(':senha', $this->getSenha());
            
            return $stmt->execute();
            
        }

        public function excluir(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM usuario WHERE idUsuario = :idUsuario');
            $stmt->bindValue(':idUsuario',$this->getIdUsuario(), PDO::PARAM_STR);
            
            return $stmt->execute();

            //$stmt->debugDumpParams();
        }

        public function editar() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE `usuario` SET `nome` = :nome, `login` = :logs, `senha` = :senha WHERE (`idUsuario` = :idUsuario);");
            $stmt->bindValue(':idUsuario', $this->getIdUsuario(), PDO::PARAM_INT);
            $stmt->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(':logs', $this->getLogin(), PDO::PARAM_STR);
            $stmt->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function buscarUsuario(){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM usuario';
            if($idUsuario > 0){
                $query .= ' WHERE idUsuario = :idUsuario';
                $stmt->bindParam(':idUsuario', $idUsuario);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        public function listarTabuleiro($id){
            $usuario = new Usuario("","","","");
            $lista = $usuario->buscarUsuario($id);
            return listarTabuleiro(array('idTabuleiro'), $lista);
    
        }

        public function efetuaLogin($login, $senha){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

                $sql = "SELECT * FROM usuario WHERE login = :login AND senha = :senha";
                $logar = $conexao->prepare($sql);
                $logar->bindParam(':login', $login);
                $logar->bindParam(':senha', $senha);
                $logar->execute();
                if($logar->rowCount()>0){
                    return true;    
                } else{
                    return false;
                } 
                
        }
    }

?>