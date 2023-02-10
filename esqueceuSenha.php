<?php 
include_once('config.php')


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles/styleEsenha.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="javascript/jQuery.js"></script>
    <script src="javascript/esqueceuSenha.js" type='text/javascript'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
</head>
<body>

<div class='content'>
    <forms  method="post" class='box' action='esqueceuSenha.php'>
        <h1>Trocar senha</h1>
        
            <div id='input'>
                <input class='formsInput' placeholder="Insira seu e-mail" id='email' type='text' name='email'>
            </div>
            <div>
                <button class='btn' id='submit'>Enviar</button>
                <a href="login.php" class='btn'>Voltar</a>
            </div>
    


</div>
</forms>

</body>
</html>
