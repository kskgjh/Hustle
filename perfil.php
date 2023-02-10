<?php
include_once('config.php');

if(!isset($_SESSION['usuario'])){
  header("Location: login.php");
}

if (isset($_SESSION['dadosPerfil'])) {
  $dados = $_SESSION['dadosPerfil'];
} else {
  $dados = $_SESSION['usuario'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/styleperfil.css">
  <link rel="stylesheet" href="styles/styleFeed.css">
  <link rel="stylesheet" href="styles/styleComentario.css">
  <script src="https://kit.fontawesome.com/a3e7c2fbca.js" crossorigin="anonymous"></script>
  <script src='javascript/jQuery.js' type='text/javascript'></script>
  <script src='javascript/perfil.js'></script>
  <script src="javascript/comentarios.js"></script>
  <script src='javascript/alterarFoto.js'></script>
  <script src="javascript/javascript.js"></script>
  <title><?php echo $dados['nome'];  ?></title>
</head>

<body>

  <header>
    <div class="cabeçalho">
      <nav role="navigation">
        <div id="menuToggle">
          <input type="checkbox" id='menuInput'/>
          <span></span>
          <span></span>
          <span></span>
          <ul id="menu" class='nav'>
            <a href="chat.php">
              <li>Conversas</li>
            </a>
            <a href='trocarsenha.php'>
              <li>Trocar senha</li>
            </a>
            <a href="Contratar.php">
              <li>Contratar</li>
            </a>
            <a href="procurar.php">
              <li>Procurar</li>
            </a>
            <a href="logout.php">
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

    <div class="countainer">
      <div class="profile-header">
        <div class="profile-img-div">
          <label for='inputFoto' class='labelFotoPerfil'>
            <span>
              <img id='img' class='profile-img' 
                            src="<?php echo $dados['img'] ? "uploadedImgs/" . $dados['img'] : "img/default-profile.jpg"; ?>">
              <i class="fa-solid fa-image"></i>
            </span>
              <input type='file' accept="image/*" id='inputFoto' class='hidden' />
          </label>


          <div class='modal' style="display: none;" id='modal'>
            <div class='content'>

            </div>
          </div>

        </div>
        <div class="profile-nav-info">
          <h3><?php echo $dados['nome']; ?> </h3>
          <div>
            <p> <?php echo $dados['cidade']? $dados['cidade'] : "Cidade não informada"; ?> </p>
            <p><?php echo $dados['estado']? $dados['estado'] : "Estado não informado"; ?></p>
          </div>
        </div>
        <div class="profile-option">
        <?php if($_SESSION['usuario']['cod_usuario'] == $dados['cod_usuario']) {?>

          <div>
              <span id='spanEdit' class='editarPerfil'>...</span>
                <div class='dropDown'>
                  <a id='editarPerfil'>Editar Perfil</a>
                  <a id='excluirPerfil'>Excluir conta</a>
          </div>
          <script>
              btnEdit = document.getElementById('editarPerfil')
              btnEdit.addEventListener('click', ()=>{
                switchModal('modalEdit')

              })

              btnEx = document.getElementById('excluirPerfil')
              btnEx.addEventListener('click', ()=>{
                switchModal('modalExcluir')
              })
      

          </script>

              <div class='modal' id='modalExcluir' style='display: none;' >
                <div class='confirm'>
                  <h1> Tem certeza que deseja excluir a sua conta? </h1>
                  <div>
                    <button class='btn' id='confirmarExcluir'>Confirmar</button>
                    <button class='btn'id='cancelarExcluir'>Cancelar</button>
                  </div>
                </div>
              </div>

              <script>
              btnCancelarExcluir = document.getElementById('cancelarExcluir')
              btnCancelarExcluir.addEventListener('click', ()=>{
                window.location.reload()
              })

              btnExcluir = document.getElementById('confirmarExcluir')
              btnExcluir.addEventListener('click', ()=>{
                $.post("funçõesPhp/excluirPerfil.php", (retorno)=>{
                  if (retorno == 1){
                    console.log('aqui')
                    window.location.reload()
                    return
                  }
                      alert(retorno)
                })
              })
            </script>


          <div class='modalEdit' id='modalEdit' style="display: none;">
            <div class='contentEdit'>
              
              <div>
              <label>Nome: 
                <input type='text' id='nomeEdit' value="<?php echo $_SESSION['usuario']['nome']; ?>">
              </label>
              <label>Email:
                <input type='text' id='emailEdit' value="<?php echo $_SESSION['usuario']['email']; ?>">
              </label>
              <label>Telefone:
                <input type='text' id='numEdit' value='<?php echo $_SESSION['usuario']['telefone']; ?>'> 
        </label>
              <label>Biografia:
                <textarea type='text' id='bioEdit'><?php echo $_SESSION['usuario']['bio']; ?></textarea>
              </label>
        </div>
              <div>
              <label>Estado:
                <input type='text' id='estadoEdit' value='<?php echo $_SESSION['usuario']['estado']; ?>'>
              </label>
              <label>Cidade:
                <input type='text' id='estadoEdit' value='<?php echo $_SESSION['usuario']['cidade']; ?>'>
              </label>
              <div class='recSenha'>
                  <label>Pergunta:
                    <input type='text' id='estadoEdit' value='<?php echo $_SESSION['usuario']['pergunta']; ?>'>
                  </label>
                  <label>Resposta:
                    <input type='text' id='estadoEdit' value='<?php echo $_SESSION['usuario']['resposta']; ?>'>
                  </label>
              </div>
        </div>
        
            <button class='btn' id='salvarEdit'>Salvar</button>
            <button class='btn' id='cancelarEdit'>Cancelar</button>
     
            </div>
        
        </div>
          <script>
            btnCancelar = document.getElementById('cancelarEdit')
            btnCancelar.addEventListener('click', ()=>{
              window.location.reload()
            })

            btnSalvar = document.getElementById('salvarEdit')
            btnSalvar.addEventListener('click', (e)=>{
                console.log(e)

                const infos = e.path[1]

                const div1 = infos.children[0]

                const nome = div1.children[0].children[0].value
                const email = div1.children[1].children[0].value
                const telefone = div1.children[2].children[0].value
                const bio = div1.children[3].children[0].value

                const div2 = infos.children[1]

                const estado = div2.children[0].children[0].value
                const cidade = div2.children[1].children[0].value
                const pergunta = div2.children[2].children[0].children[0].value
                const resposta = div2.children[2].children[1].children[0].value

                salvarEdit(nome, email, telefone, bio, estado, cidade, pergunta, resposta)
            })
            </script>

          <?php } ?>  

        </div>
        </div>
      </div>
          <script>
            const btnEditar = document.getElementById('spanEdit')
            const menu = document.querySelector('.dropDown')
            btnEditar.addEventListener('click', ()=>{
              if(menu.classList.contains('showDropDown')){
                menu.classList.remove('showDropDown')
                return
              }

                menu.classList.add('showDropDown')
            })
            </script>
      <div class="main-bd">
        <div class="left-side">
          <div class="profile-side">
            <div>
            <p class="mobile-no">
              <i class="fa fa-phone"> </i>
              <?php echo $dados['telefone']?$dados['telefone'] : "Não informado"; ?>
            </p>
            <p class="e-mail">
              <i class="fa fa-envelope"></i>
              </i><?php echo $dados['email'] ?>
            </p>
            </div>

            <?php if($dados['bio'] !== ""){ ?>
            <div class="user-bio">
              <h3>Biografia</h3>
              <p id='bioCompleta' style="display: none;"><?php echo $dados['bio']; ?></p>
              <p id='bio'>
                <?php echo mb_strimwidth($dados['bio'], 0, 50, '...'); ?>
              </p>
              <p id='backup' style="display: none;"></p>
            </div>
              <?php } ?>

            <div class="profile-btn">
              <button class="chatbtn" id='btnChat'>
                <i class="fa fa-comment"></i>Chat
              </button>

            </div>

            <script>
              btnChat = document.getElementById('btnChat')
              btnChat.addEventListener('click', () => {
                window.location.href = 'chat.php'
              })
            </script>
          </div>
        </div>
  
        <div class="right-side">
          <div class="posts">
            <ul>
              <li>Posts</li>
            </ul>
            <div class='postagens'>


              <?php
              $id = $dados['cod_usuario'];
              //CRIA O SELECT
              $consulta = "SELECT * FROM tb_publi where cod_usuario = '$id' order by cod_publi desc";

              //SE A CONEXAO FOR UM SUCESSO
              if ($publis = mysqli_query($conexao, $consulta)) {

                //SALVA O NUMERO DE PUBLICAÇÕES
                $linhas = mysqli_num_rows($publis);
                if ($linhas == 0) {
                  echo "
          <div class='standart'>
            <h1>Comece a publicar!!</h1>
            <div>
            <button class='btn' id='btnCont'> Contratar </button>
            <button  class='btn' id='btnProc' href='procurar.php'> Procurar serviços </button>
            </div>
          </div>

          <script> 
                  btnCont = document.getElementById('btnCont')
                  btnCont.addEventListener('click', ()=> {
                    console.log('clicou')
                    window.location.href = 'contratar.php'
                  })
                   
                  btnProc = document.getElementById('btnProc')
                  btnProc.addEventListener('click', ()=> {
                    console.log('clicou')
                    window.location.href = 'procurar.php'
                  })
                  
          </script>
        ";
                }
                //INICIA UM LOOP PARA MOSTRAR CADA UMA
                for ($i = 0; $i < $linhas; $i++) {

                  //SALVA AS INFOS NECESSARIAS 

                  $dadosPubli = mysqli_fetch_array($publis);
                  $id_usuario_publi = $dadosPubli['cod_usuario'];
                  $id_publi = $dadosPubli['cod_publi'];

                  //CONSULTA AS INFOS DO USUARIO 
                  $consulta2 = "SELECT img, nome FROM tb_usuario where cod_usuario= '$id_usuario_publi'";
                  $dados2 = mysqli_query($conexao, $consulta2);
                  $dadosUser = mysqli_fetch_array($dados2);

                  //E PUXA A IMAGENS DE CADA PUBLICAÇÃO ESPECIFICA
                  $consulta3 = "SELECT nomeImg FROM tb_img_publi where cod_publi=$id_publi";
                  $imgs = mysqli_query($conexao, $consulta3);
                  $quantidade = mysqli_num_rows($imgs);


                  //INICIA A INTERFACE DA PUBLICAÇÃO
                  echo "<div class='cardpubli' id='cardpubli_" . $dadosPubli['cod_publi'] . "'>";

                  echo
                  " 
        <div class='publi1'>
          <img class='imgPerfil' src='uploadedImgs/" .  $dadosUser['img'] . "'>            
          <h2 class='publinome'>" . $dadosUser['nome'] . "</h2>
          <h2 class='publidata'>  - " . $dadosPubli['data'] . "</h2>
        </div>
        <div class='publitxt'>
           <h2 class='publitxt'>" . $dadosPubli['descricao'] . "</h2>
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
          <i class='fa-solid fa-comment' id='comBtn_" . $dadosPubli['cod_publi'] . "'></i>

          <input type='checkbox' class='hidden' id='like_" . $id_publi . "_input' />

      <a class='aDobotao' onclick='validarChat(" . $id_usuario_publi . "," . $id . ")'>
      <i class='fa-regular fa-paper-plane'></i>
      </a>

      </div>
    ";


                  //verificar se publiação ja foi curtida
                  echo "<script>
        var id_publi = '$id_publi';
        var id_session = '$id';

        verificar(id_publi, id_session);
        
        id_publi = undefined;
        id_session = undefined;

        comBtn = document.getElementById('comBtn_" . $dadosPubli['cod_publi'] . "')
        comBtn.addEventListener('click', ()=>{
            criarInputCom(" . $dadosPubli['cod_publi'] . ",'" .  $_SESSION['usuario']['img'] . "',' " .  $_SESSION['usuario']['nome'] . "')
        })
    </script>";

                  echo "</div>";
                }
              }
              ?>

            </div>
          </div>
        </div>
      </div>
  </main>

</body>

</html>

<?php unset($dados, $_SESSION['dadosPerfil']); ?>