<?php
include('config.php');
if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
}



if (isset($_POST['submit'])) { // se o botao de envio for clicado 

  //declara as variaveis utilizadas
  $diretorio = "uploadedImgs/";
  $id = $_SESSION['usuario']['cod_usuario'];
  $publi = $_POST['txtpubli'];
  $cod_cat = 0;
  $diretorio = "uploadedImgs/";


  //cria a consulta mysqli e a executa
  $sql = "SELECT * from tb_publi where descricao='$publi' and cod_usuario='$id'";
  $validar = mysqli_query($conexao, $sql);
  //retorna o numero de linhas
  $return = mysqli_num_rows($validar);
  unset($sql);


  if ($return == 0) {  //se retornar zero



    //cria o insert dos dados e o executa
    $sql = "INSERT INTO tb_publi (cod_publi, descricao, data, cod_usuario, cod_cat)
                    VALUES (null, '$publi', now(), '$id', '$cod_cat') ";
    $vaipoha = mysqli_query($conexao, $sql) or $msg = "erro com a publi" . mysqli_error($conexao);

    //puxa o id da publicação feita
    $id_publi = mysqli_insert_id($conexao);


    //se a imagem 1 existir
    if ($_FILES['fotopubli1']['size'] > 0) {
      //retorna a extensão e cria um nome unico 
      $extensao1 = strtolower(pathinfo($_FILES['fotopubli1']['name'], PATHINFO_EXTENSION));
      $nomeFoto1 = md5($_FILES['fotopubli1']['name']) . time() . '.' . $extensao1;

      //envia o arquivo para a pasta de upload
      move_uploaded_file($_FILES['fotopubli1']['tmp_name'], $diretorio . $nomeFoto1) or $msg = "Falha ao enviar arquivo1.";

      //e realiza um insert da foto no banco
      $insert1 = "INSERT INTO tb_img_publi (cod_img_publi, nomeImg, cod_usuario, cod_publi)
                            VALUES (null, '$nomeFoto1' , '$id', '$id_publi')";
      $result1 = mysqli_query($conexao, $insert1) or die("erro: " . mysqli_error($conexao));
    }
    if ($_FILES['fotopubli2']['size'] > 0) {
      $extensao2 = strtolower(pathinfo($_FILES['fotopubli2']['name'], PATHINFO_EXTENSION));
      $nomeFoto2 = md5($_FILES['fotopubli2']['name']) . time() . '.' . $extensao2;

      move_uploaded_file($_FILES['fotopubli2']['tmp_name'], $diretorio . $nomeFoto2) or $msg = "Falha ao enviar arquivo2.";

      $insert2 = "INSERT INTO tb_img_publi (cod_img_publi, nomeImg, cod_usuario, cod_publi)
                            VALUES (null, '$nomeFoto2' , '$id', '$id_publi')";

      $result2 = mysqli_query($conexao, $insert2) or die("erro: " . mysqli_error($conexao));
    }

    if ($_FILES['fotopubli3']['size'] > 0) {
      $extensao3 = strtolower(pathinfo($_FILES['fotopubli3']['name'], PATHINFO_EXTENSION));
      $nomeFoto3 = md5($_FILES['fotopubli3']['name']) . time() . '.' . $extensao3;

      move_uploaded_file($_FILES['fotopubli3']['tmp_name'], $diretorio . $nomeFoto3) or $msg = "Falha ao enviar arquivo3.";

      $insert3 = "INSERT INTO tb_img_publi (cod_img_publi, nomeImg, cod_usuario, cod_publi)
                VALUES (null, '$nomeFoto3' , '$id', '$id_publi')";

      $result3 = mysqli_query($conexao, $insert3) or die("erro: " . mysqli_error($conexao));
    }

    if ($_FILES['fotopubli4']['size'] > 0) {
      $extensao4 = strtolower(pathinfo($_FILES['fotopubli4']['name'], PATHINFO_EXTENSION));
      $nomeFoto4 = md5($_FILES['fotopubli4']['name']) . time() . '.' . $extensao4;

      move_uploaded_file($_FILES['fotopubli4']['tmp_name'], $diretorio . $nomeFoto4) or $msg = "Falha ao enviar arquivo4.";

      $insert4 = "INSERT INTO tb_img_publi (cod_img_publi, nomeImg, cod_usuario, cod_publi)
                VALUES (null, '$nomeFoto4' , '$id', '$id_publi')";

      $result4 = mysqli_query($conexao, $insert4) or die("erro: " . mysqli_error($conexao));
    }
  }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/stylefeed.css">
  <link rel="stylesheet" href="styles/styleComentario.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a3e7c2fbca.js" crossorigin="anonymous"></script>
  <script src='javascript/jQuery.js' type='text/javascript'></script>
  <script src='javascript/javascript.js' type='text/javascript'></script>

  <title>Procurar</title>
</head>

<body class='body'>
<header>
  <div class="cabeçalho">
    <nav role="navigation">
      <div id="menuToggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul id="menu" class='nav'>
          <a  href="perfil.php">
            <li>Perfil</li>
          </a>
          <a  href="chat.php">
            <li>Conversas</li>
          </a>
          <a  href='trocarsenha.php'>
            <li>Trocar a senha</li>
          </a>
          <a  href="Contratar.php">
            <li>Contratar</li>
          </a>
          <a  href="logout.php">
            <li>Sair</li>
          </a>

        </ul>
      </div>
    </nav>
  </div>

</header>

<main class='main'>
  <!-- FORMULARIO DE PUBLIAÇÃO0-->
  <div class='cardform'>
    <?php if (isset($msg)) {
      echo ('<h1>' . $msg . '</h1>');
      unset($msg);
    } ?>
    <form method='post' action='procurar.php' enctype='multipart/form-data'>
      <div class='containertxt'>
        <div>
          <img src='<?php echo $_SESSION['usuario']['img']? "uploadedImgs/".$_SESSION['usuario']['img'] : "img/default-profile.jpg"; ?>' class='fotoPerfil'>
        </div>

        <div>
          <label for='txtpubli' class="labelTxt">
            <input for='txtpubli' class='inputxtarea' id='txtpubli'>
            <textarea class='txtpubli' name='txtpubli' id='txtpubli' strlen='max:300'> </textarea>
          </label>
        </div>
      </div>
      <!-- INPUT DE FOTOS -->
      <div class='containerpubli'>
        <div class='fotopubli'>
          <label class='labelfoto' onclick="imgReact('fotopubli1', 'span1', 'fotoLabel')">
            <span class='spanfoto' id='span1'><i class="fa-solid fa-image"></i></span>
            <input type='file' accepts='image/*' id='fotopubli1' name='fotopubli1' class='hidden'>
          </label>

          <label class='labelfoto' onclick="imgReact('fotopubli2', 'span2', 'fotoLabel')">
            <span class='spanfoto' id='span2'><i class="fa-solid fa-image"></i></span>
            <input type='file' id='fotopubli2' accepts='image/*' name='fotopubli2' class='hidden'>
          </label>

          <label class='labelfoto' onclick="imgReact('fotopubli3', 'span3', 'fotoLabel')">
            <span class='spanfoto' id='span3'><i class="fa-solid fa-image"></i></span>
            <input type='file' accepts='image/*' id='fotopubli3' name='fotopubli3' class='hidden'>
          </label>

          <label class='labelfoto' onclick="imgReact('fotopubli4', 'span4', 'fotoLabel')">
            <span class='spanfoto' id='span4'><i class="fa-solid fa-image"></i></span>
            <input type='file' accepts='image/*' name='fotopubli4' id=fotopubli4 class='hidden'>
          </label>
        </div>


        <div class='divbtn'>
          <button type='submit' id='submit' name='submit' class='btn' style='scale: 0.9;' onclick=submitForm()>Publicar</button>
          <script type="text/javascript" src="javascript/javascript.js"></script>
        </div>
      </div>
    </form>
  </div>
  <div>
  <div class='divSearch'>
      <input  type='search' id='searchBar' class='search' placeholder='Procure por uma publicação'/>
    </div>

    <!-- REALIZA O REQUEST DE TODA A TABELA DE PUBLICAÇÕES -->
    <?php
     $id = $_SESSION['usuario']['cod_usuario'];
    //CRIA O SELECT
    $consulta = "SELECT * FROM tb_publi where cod_cat = 0 order by cod_publi desc";

    //SE A CONEXAO FOR UM SUCESSO
    if ($publis = mysqli_query($conexao, $consulta)) {

      //SALVA O NUMERO DE PUBLICAÇÕES
      $linhas = mysqli_num_rows($publis);

      //INICIA UM LOOP PARA MOSTRAR CADA UMA
      for ($i = 0; $i < $linhas; $i++) {

        //SALVA AS INFOS NECESSARIAS 
        
        $dadosPubli = mysqli_fetch_array($publis);
        $id_usuario_publi = $dadosPubli['cod_usuario'];
        $id_publi = $dadosPubli['cod_publi'];

        $data = implode(array_reverse(str_split($dadosPubli['data'], 4)));

        
        //CONSULTA AS INFOS DO USUARIO 
        $consulta2 = "SELECT * FROM tb_usuario where cod_usuario= '$id_usuario_publi'";
        $dados2 = mysqli_query($conexao, $consulta2);
        $dadosUser = mysqli_fetch_array($dados2);

        //E PUXA A IMAGENS DE CADA PUBLICAÇÃO ESPECIFICA
        $consulta3 = "SELECT nomeImg FROM tb_img_publi where cod_publi=$id_publi";
        $imgs = mysqli_query($conexao, $consulta3);
        $quantidade = mysqli_num_rows($imgs);


        //INICIA A INTERFACE DA PUBLICAÇÃO
        echo "<div class='cardpubli' id='cardpubli_".$dadosPubli['cod_publi']."'>";

        echo
        " 
        <div class='publi1' id='div_".$id_usuario_publi."'>
          <img class='imgPerfil' src='uploadedImgs/" .  $dadosUser['img'] . "'>  
          <div>          
          <h2 class='publinome'>" . $dadosUser['nome'] . "</h2>
          <h2 class='publidata'>  - " . $data . "</h2>
          </div>
        </div>

        <script>
        div_".$id_usuario_publi." = document.getElementById('div_".$id_usuario_publi."')
        div_".$id_usuario_publi.".addEventListener('click', ()=>{
          criarPerfil(".json_encode($dadosUser).")
        })
        </script>
        <div>
        <div class='publitxt'>
           <h2 class='publitxt'>" . $dadosPubli['descricao'] . "</h2>
        </div>
        </div>
        ";


        if ($quantidade > 0) {
          echo "<div class='imagens'>";
          for ($x = 0; $x < $quantidade; $x++) {

            $fotos = mysqli_fetch_array($imgs);
            echo  "  
                     
                        <img class='foto' src='uploadedImgs/" . $fotos['nomeImg'] . "'>          
                     
                      ";
          }
          echo "</div>";
        }

        $sql = "SELECT * FROM tb_curtida where cod_publi = '$id_publi'";
        $select = mysqli_query($conexao, $sql);
        $curtidas = mysqli_num_rows($select);
        unset($sql);


        echo "
      <div class='midia'>   
      <div>
          <span class='Ncurtidas' id='span_" . $id_publi . "'>" . $curtidas . "</span>
          <label for='like_" . $id_publi . "_input' onclick='like(" . $id_publi . "," . $id . ")'>
            <i class='fa-solid fa-heart' id='coracao_" . $id_publi . "' ></i>
          </label>
      </div>
          <i class='fa-solid fa-comment' id='comBtn_".$dadosPubli['cod_publi']."'></i>

          <input type='checkbox' class='hidden' id='like_" . $id_publi . "_input' />

      <a class='aDobotao' onclick='validarChat(" . $id_usuario_publi . "," . $id . ")'>
      <i class='fa-regular fa-paper-plane'></i>
      </a>

      </div>
    ";

        echo "<script>
        var id_publi = '$id_publi';
        var id_session = '$id';

        verificar(id_publi, id_session);
        
        id_publi = undefined;
        id_session = undefined;

        comBtn = document.getElementById('comBtn_".$dadosPubli['cod_publi']."')
        comBtn.addEventListener('click', ()=>{
            criarInputCom(".$dadosPubli['cod_publi'].",'" .  $_SESSION['usuario']['img'] . "',' ".$_SESSION['usuario']['nome']."')
        })

    </script>";
        echo "</div>";
      }
    }
    ?>
  </div>
</main>
  <script>
  
      barra = document.getElementById('searchBar')
      barra.addEventListener('keyup', ()=>{
          pesquisa(barra.value)
      })

  </script>
  <script src='javascript/chat.js' type='text/javascript'></script>
  <script src="javascript/comentarios.js" type='text/javascript'></script>
  </body>

</html>