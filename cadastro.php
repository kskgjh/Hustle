<?php
include('config.php'); // inclui conexao com o banco


if (isset($_POST['submit'])) { //se o botão de cadastro for pressionado:
    // puxa todas as informações
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $cidade = $_POST["estado"];
    $estado = $_POST["cidade"];
    $bio = $_POST["bio"];
    $pergunta = $_POST['pergunta'];
    $resposta = $_POST['resposta'];

    //cria uma busca pelo email cadastrado
    $sql1 = "SELECT * FROM tb_usuario WHERE email = '$email'";


    if ($consulta1 = mysqli_query($conexao, $sql1)){
        $confirm = mysqli_num_rows($consulta1);
        //se existir ele retorna sem cadastrar com a mensagem abaixo
        if($confirm > 0){
            $msg = "Ja existe uma conta com esse e-mail.";
            return;
        }
        
        else {
            //caso contrario segue

            //se existir foto de perfil 
            if($_FILES['foto']['size'] !== 0 ){
                //pega a extensão da imagem e cria um nome criptografado
                $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
                $nomeFoto = md5($_FILES['foto']['name']) . time() . '.' . $extensao;
                $diretorio = "uploadedImgs/";
            
                //e move a foto para a pasta de uploade
                move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $nomeFoto) or $msg = "Falha ao enviar arquivo.";
            }
            
    // cria um comando em formato Mysql
    $sql = "INSERT INTO tb_usuario (img, nome, telefone, email, senha, cidade, estado,cod_usuario,  bio, pergunta, resposta)
        Values ('$nomeFoto', '$nome', '$telefone', '$email', '$senha', '$cidade', '$estado',null, '$bio', '$pergunta', '$resposta')";

    // Realiza a insersão        
    $vamola = mysqli_query($conexao, $sql);

    
    if (mysqli_insert_id($conexao)) { // Se a insersão for um sucesso:
        header("Location: login.php");
    } else {
        $msg = "erro na inserção";
    }

        }
    }

    
}
?>
<!DOCTYPE html>
<html lang="pt-br" class='cadastrohtml'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
                     initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="javascript/fotoperfil.js" type="text/javascript" defer></script>
    <script src="https://kit.fontawesome.com/a3e7c2fbca.js" crossorigin="anonymous"></script>
    <script src="javascript/javascript.js" type="text/javascipt" defer></script>
    <title>
        Hustle - Cadastro
    </title>
</head>

<body>


        <main class='mainCadastro'>


            <form method="post" action="cadastro.php" name="cadastro" class="forms" enctype="multipart/form-data">
             
                    <h2 style='text-align: center;'><?php if (isset($msg)) {
                        echo $msg;
                        unset($msg);
                    }  ?>
                    </h2>
                    <div class='inputs'>
                        <div class='inputText'>

                 <div>
                        <input name="email" type="email" id="email" required placeholder="E-mail" />
                        <input type="password" autocomplete='on' id="senha2" placeholder="Senha" required />
                        <input type="password" autocomplete='on' id="senha" placeholder="Confirme a senha" name="senha" required />
                        <input name="telefone" type="tel" id="telefone" placeholder="Telefone"/>
                </div>
                <script type='text/javascript' src='javascript/validação.js'></script>
                <div>
                                

                            <input name="nome" type="text" id="nome" placeholder="Nome completo" required />
                            <input type="text" id="cidade" name="cidade" placeholder="Cidade">
                            <input type="text" name="estado" id="estado" placeholder="Estado">

                </div>

                </div>
            <div class='divLabel'>
                <label for="foto" class="formsLabel" tabindex="0">
                    <input type="file" accept="image/*" name="foto" id="foto" class="formsInputFoto"/>
                    <span class="fotoSpan"></span>
                </label>
            </div>
                        <div class='divBio'>
                            <textarea class="formsInputBio" name="bio" type="text" id="bio" placeholder="Escreva um pouco sobre seus trabalhos..."></textarea>
                        </div>
                </div>
                    <div class='pergunta'>Crie uma pergunta pessoal e sua resposta para recuperação de senha:
                        <label for='pergunta'>Pergunta:
                            <input class='formsInput' type='text' name='pergunta' placeholder='Pergunta...' required>
                        </label>
                        <label for='resposta'>Resposta:
                            <input class='formsInput' type='text' name='resposta' placeholder='Dê preferência a respostas curtas' required>
                        </label>
                        </label>


                    </div>
                    <div class='divbtn'>
                        <div>
                            <button type="submit" name="submit" class="btn" id="cadastrar">Enviar</button>
                        </div>
                        <div>
                            <a href="login.php" class="aDobotao">
                                <button type="button" class="btn" placeholder="Fazer login">Voltar</button></a>
                            </a>
                        </div>


                        
                    </div>
            
        </main>
</body>


</html>