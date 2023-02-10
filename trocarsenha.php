<?php
include('config.php');
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/styleTsenha.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a3e7c2fbca.js" crossorigin="anonymous" defer></script>
  <script src='javascript/jQuery.js' type='text/javascript' defer></script>
  <title>Trocar senha</title>
</head>
<header>
  <div class="cabeçalho">
    <nav role="navigation">
      <div id="menuToggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul id="menu">
          <a href="perfil.php">
            <li>Perfil</li>
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
<body>
<main>
            <div class='container'>
              <h1>TROCAR SENHA </H1>
              <span class='span' id='span'></span>
              <div class='confirm'>

                  <input type='password' name='confirm1' id='senha' placeholder='Senha atual'>
                  <input type='password' name='confirm2' id='senha2' placeholder='Confirme a senha'>


              </div>
              <div class='new'>

                  <input type='password' id='novasenha' placeholder='Nova senha'>
                  <button type='submit' id='submit' class='btn'>Enviar</button>
                  <a href='contratar.php' >
                    <button name='index' id='href' type='buttom' class='btn'>Voltar</button>
                  </a>

              </div>


    </div>

</main>
<script>

          const btn = document.getElementById('submit')
          const span = document.getElementById('span')
          const input1 = document.getElementById('senha')
          const input2 = document.getElementById('senha2')
          const input3 = document.getElementById('novasenha')

          input1.addEventListener('keydown', ()=>{
            span.innerText = ""
          })

          btn.addEventListener('click', ()=>{
            const senha1 = input1.value
            const senha2 = input2.value
            const novaSenha = input3.value

              if (senha1 !== senha2){
                span.style.color = 'red'
                span.innerText = "As senhas não coincidem"
                return
              }

              // if (senha2 == novaSenha){
              //   span.style.color = 'red'
              //   span.innerText = 'A Nova senha não pode ser igual a anterior';
              //   return
              // }

              $.post('funçõesPhp/mudarSenha.php', {senha: novaSenha,
                                                   confirm: senha2}, (retorno)=>{
                console.log(retorno)
                if (retorno == 1){
                  console.log('ai nao ne')
                  span.style.color = 'red'
                  span.innerText = 'Senha incorreta.'
                  return
                }
                span.style.color = 'green'
                span.innerText = 'Senha Alterada com sucesso.'
              })



              input1.value = ''
              input2.value = ''
              input3.value = ''

          })

</script>
</body>

</html>