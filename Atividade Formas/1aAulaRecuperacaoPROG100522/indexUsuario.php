<!DOCTYPE html>
<?php 
    include_once "acao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    $idUsuario = 0;
    if ($acao == 'editar'){
        $idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : "";
    if ($idUsuario > 0)
        $dados = buscarDados($idUsuario);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Cadastro de Usuário</title>
    
</head>
<body>

<?php 
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3 style="font-weight: bold">Criar Cadastro</h3><hr>
        
    <form method="post" action="ProcessaUsuario.php">
        <div>
            <label>Nome:</label><br>
            <input type="name" name="nome" value="<?php if($acao == "editar") echo $dados['nome'];?>" placeholder="Insira um nome"> 
        </div>
        <br>
        <div>
            <label>Login (email):</label><br>
            <input type="name" name="login" value="<?php if($acao == "editar") echo $dados['login'];?>" placeholder="Insira um Login (email)">
        </div>
        <br>
        <div>
            <label>Senha:</label><br>
            <input type="password" name="senha" value="<?php if($acao == "editar") echo $dados['senha'];?>" placeholder="Insira uma senha">
        </div>
        <!-- <p> Escolha o Tabuleiro </p>
                    <select name="id" id="id" class="form-select">> -->
                        <?php
                        //require_once ("Quadrado.class.php");
                        //    echo listarTabuleiro(0);
                        //?>

    <br>
    <input  type="hidden" name="idUsuario" value="<?php echo $idUsuario;?>">


    <button value="Salvar" id="salvar" name="salvar" type="submit" class="btn btn-outline-info">Salvar</button>

    </form>

    </div>

    <!-- Aqui separa a criação de um quadrado para o listar dos quadrados -->

    <hr style="width: 98.7%; margin-left: 12px;">

    <br>

    <?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;

?>

    <script>
        function excluir(url){
            if (confirm("Deseja excluir o item?"))
                location.href = url;
        }
    </script>
    
    <div class="margin-top">
        <div class="container-fluid">
            <form method="post">
                <div class="form-group col-6">
                    <h3 style="font-weight: bold">Procurar Usuário</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                
                    <br>

                    <div>
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Nome<br>
                        <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> Login<br>
                    <br>
                    </div>
                        <button type="submit" name="salvar" value="Salvar" class="btn btn-outline-info">Buscar</button>
                    
                </div>
              
                <br>

            </form>

            <table class="table table-striped">
            <tr><td><b>Id</b></td>
                <td><b>Nome</b></td>
                <td><b>Login</b></td>
                <td><b>Senha</b></td>
                <td><b>Visualizar</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM usuario
                                        WHERE idUsuario LIKE '$procurar%' 
                                        ORDER BY idUsuario");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM usuario
                                        WHERE nome LIKE '$procurar%' 
                                        ORDER BY nome");}

            else if($busca == 3){
                $consulta = $pdo->query("SELECT * FROM usuario 
                                        WHERE login LIKE '$procurar%'
                                        ORDER BY login");}
        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
                // $cor = str_replace('#','%23', $linha['cor']);
        ?>
        <tr><td><?php echo $linha['idUsuario'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td><?php echo $linha['login'];?></td>
            <td type="password"><?php echo $linha['senha'];?></td>
            <td><a href="showUsuario.php?idUsuario=<?php echo $linha['idUsuario']?>&login=<?php echo $linha['login']?>&nome=<?php echo $linha['nome']?>&senha=<?php echo $linha['senha']?>"><img src="img/visualizador.png" style="width: 1.8vw;"></td></a>
            <!-- <td><a href="show.php"> <img src="img/visualizador.png" style="width: 1.8vw;"></a> -->
            <td><a href='editarUsuario.php?acao=editar&idUsuario=<?php echo $linha['idUsuario'];?>&nome=<?php echo $linha['nome'];?>&login=<?php echo $linha['login'];?>&senha=<?php echo $linha['senha'];?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo "<a href=javascript:excluir('acaoUsuario.php?acao=excluir&idUsuario={$linha['idUsuario']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>