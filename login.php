<?php
include_once ('config.php');

    //detecta se o usuario tentou realizar o login e inicia o processo
    if(isset($_POST['emailL']) && isset($_POST['senhaL'])){
        $emailL = $_POST["emailL"];
        $senhaL = $_POST["senhaL"];
            //identifica se só tem 1 cadastro com essas infos
            if(!(empty($emailL) or empty($senhaL))){
                $sql="SELECT * from tb_usuario where email = '$emailL' and senha='$senhaL'";
                $res = mysqli_query($conexao,$sql);
                $linha = mysqli_num_rows($res);

                    if($linha==0){
                        session_destroy();
                        $msg = "Login ou senha incorretos!";
                      
                    }
                    else {
                        $sql_query = mysqli_query($conexao, $sql) or die("Falha no banco: " . $mysqli->error);
                        $usuario = $sql_query->fetch_assoc();
                        $_SESSION['usuario'] = $usuario;    
                        header("Location: contratar.php");
                        }
            }
            else{
                    session_destroy();
                    $msg = "Existem dois cadastros com este e-mail";
                    exit;
                }
            }
        
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link   rel="stylesheet" 
            href="styles/stylekau.css">
  
    <meta   name="viewport" 
            content="width=device-width, initial-scale=1.0">
    <link   rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Hustle - Log in</title>
</head>

<body>
<div class='inicializar'>
            <h1>HUSTLE</h1>
    </div>
            <!-- Formulario de login -->
    <div class="container" id="container">
        <div class="form-container
                    log-in-container">
            <form   action="login.php"
                    method="post">
                <h1>Login</h1>
                <?php if(isset($msg)){echo("<p class='msgErro'>" . $msg . "</p>");} ?>
                <input  type="email" 
                        placeholder="Email" 
                        name="emailL" 
                        id="emailL"
                        required/>
                <input  type="password" 
                        placeholder="Password" 
                        name="senhaL" 
                        id="senhaL"
                        required/>
                    <a href="esqueceuSenha.php" class='aSenha'>Esqueceu a senha?</a>
                        <button type="submit"
                                class='btn'
                                name="submit">Log In</button>
                    <a href="cadastro.php">
                        <button type="button"
                                class='btn' 
                                name="cadastro">Cadastrar-se</button>
                    </a>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1 class='hustle'>Hustle</h1>
                    <p>Acesse e descrubra novos serviços!</p>
                </div>
            </div>
        </div>
    </div>

    

</body>

</html>