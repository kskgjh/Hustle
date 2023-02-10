<?php
include 'config.php';
if (!isset($_SESSION['usuario'])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/styleChat.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a3e7c2fbca.js" crossorigin="anonymous"></script>
    
    <title>Chat</title>
</head>

<body>
    <header>
    <!-- MENU -->
    <div class="cabeçalho">
        <nav role="navigation">
            <div id="menuToggle">
                <input type="checkbox" id='menuInput'/>
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu" class='nav'>
                    <a  href="perfil.php">
                        <li>Perfil</li>
                    </a>
                    <a  href='trocarsenha.php'>
                        <li>Trocar senha </li>
                    </a>
                    <a  href="contratar.php">
                        <li>Contratar</li>
                    </a>
                    <a  href="procurar.php">
                        <li>Procurar</li>
                    </a>
                    <a  href="logout.php">
                        <li>Sair</li>
                    </a>

                </ul>
            </div>
        </nav>
    </div>
</header>

<script>
    
  
</script>

<main>


<div class='contatos' id='contatos'>
<?php

 $id = $_SESSION['usuario']['cod_usuario'];

 //cria uma busca por todos os chats que envolvem o usuario da sessão 
$sql = "SELECT * FROM tb_chat where cod_usuario_publi = '$id'
        or cod_usuario_session = '$id'";

    //caso consiga buscar 
    if ($select = mysqli_query($conexao, $sql)){
        //reotrna o numero de conversas
        $linhas = mysqli_num_rows($select);

        //se nao existir mostra um output padrão 
        if($linhas == '0'){
           echo "<h3 class='Sconversa'>Ops... Nenhuma conversa encontrada.</h3>";
        }
 
        unset($sql);

        //itera o numero de conversas necessários para criar todos os cards
        for ($r = 0; $r<$linhas; $r++){
            //puxa as informações
            $dados = mysqli_fetch_array($select);
         
            //alinha corretamente quem é o usuario da sessão (id) e o outro (id_2)
            if ($dados['cod_usuario_publi'] == $id){
                $id_2 = $dados['cod_usuario_session'];
            } elseif ($dados['cod_usuario_session'] == $id) {
                $id_2 = $dados['cod_usuario_publi'];
            }

            //cria as buscas para as informações do usuario 2 
                $sql = "SELECT nome, img FROM tb_usuario where cod_usuario = '$id_2'";

                //e a ultima mensagem enviada
                $sql2 = "SELECT mensagem from tb_mensagem where cod_chat = '$dados[cod_chat]' order by cod_msg desc limit 1";

                //busca e salva as informações
                $consulta2 = mysqli_query($conexao, $sql2);
                $ultimaMsg = $consulta2 ->fetch_row();
                $consulta = mysqli_query($conexao, $sql);
                $usuario2 = mysqli_fetch_array($consulta);


            echo "<label for = '". $dados['cod_chat'] ."' class='conversa'
                         onclick='header(".$dados['cod_chat']. ", ".$id_2.")'
                         id = 'label_". $dados['cod_chat'] ."'>
                         ";

                echo "<div class='divimg'>

                        <img class ='conversaImg' src='uploadedImgs/" . $usuario2['img'] . "'>
                      </div>";
                echo "<div class='ultimaMsg'>
                        <h1>" . $usuario2['nome'] . "</h1>";
                        if ($ultimaMsg != ''){
                            $ultimaMsg = mb_strimwidth($ultimaMsg[0], 0,25,'...');

                            echo "<h2>".$ultimaMsg."</h2>";
                        }
                echo "</div>";
            echo "</label>";

            echo "<input name='conversas' class='hidden' type='radio' onchange='conversaSwitch(".$dados['cod_chat']. ")' id='".$dados['cod_chat']. "'>";

                




        }
    }
    

?>
</div>

<div class='chat' id='chat'>
    <div>
    <span></span>
    <h1 class='standartH1'> Entre em um chat...</h1>
    </div>
    <div class='standart'> 
        <img src='img/gif2.gif'>
    </div>
    <div>
    <span></span>
    </div>
</div>

</main>
<script  src="javascript/chat.js" type='text/javascript' ></script>
<script  src="javascript/Jquery.js" type='text/javascript' ></script>


</body>


</html>