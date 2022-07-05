<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php 
require_once "menu.php";
?>

<form action="acaoUsuario.php" method="post">
  <!-- <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div> -->
  
  <center>
  <div class="container" style="margin-top: 10%;"><br>
    <label for="login"><b>Login</b></label>
    <input type="text" placeholder="Insira o seu Login" name="logar" required>
    <br><br><br>

    <label for="psw"><b>Senha</b></label>
    <input type="password" placeholder="Insira a sua Senha" name="senha" required>
    <br><br><br>
    <input type="submit" name="login" id="login" value="login" class="btn btn-outline-info">
    </center>
    <!-- <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> -->
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
  </div>
</form>
</body>
</html>