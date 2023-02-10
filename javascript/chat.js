function validarChat(id_usuario_publi, id_usuario_session){
   //Se os códigos forem iguais 
   if (id_usuario_publi === id_usuario_session){
      //Faz um log porem nao retorna nada
      console.log('impossivel criar chat consigo mesmo.')
      
      } else {

         //caso contrario envia as informações para validar se o chat ja exist
                  $.post('funçõesPhp/validateChat.php', // <-- Envia para o arquivo

                     {id_usuario_publi: id_usuario_publi, // <-- Os códigos dos usuarios
                     id_usuario_session: id_usuario_session},

                     //E realiza a função com o retorno
                     function (validar){

                        //Se retornou 1
                        if (validar == 1){
                           //Puxa a função para criar o chat
                           createChat(id_usuario_publi, id_usuario_session);
                           return
                        } 

                        //Caso retorne 0 redireciona o usuario para o chat
                        window.location.href = 'chat.php'
                  })
   }
}




function createChat(id_usuario_publi, id_usuario_session){
   console.log("criando chat");
   //Envia os códigos para o PHP criar o chat 
      $.post('funçõesPhp/createChat.php', // <-- Envia para esse arquivo

             { id_usuario_publi: id_usuario_publi, // <-- Essas informações
               id_usuario_session: id_usuario_session}, 

               function (retorno){ //E realiza a função com o retorno 
                  
                     if(retorno == 1){    //Caso seja 1
                     //Redireciona para o chat
                     console.log("chat criado");
                     window.location.href = './chat.php';
                     return
                     } 

                     //Caso retorne 0 retorna o erro
                     alert('falha ao criar chat');

                     
                 
         })
      } 


function header (cod_chat, cod_session){ 

   //Envia o código do chat que será feita a busca 
      $.post('funçõesPhp/puxarUser.php', // <-- Envia 
      
      {cod_chat: cod_chat}, function (retorno){
      chat = document.getElementById("chat")
      chat.innerText = ""
      dados = JSON.parse(retorno);

      imagem = document.createElement("img");
      imagem.src = dados.img?`uploadedImgs/${dados.img}`:"img/default-profile.jpg"

      h1 = document.createElement('h1');
      h1.innerText = dados.nome;
      
      div = document.createElement("div");
      div.appendChild(imagem);
      div.appendChild(h1);
      div.classList.add('header');



      chat = document.getElementById('chat');
      chat.appendChild(div);

      mensagem(cod_chat, cod_session);
      
   })
}

function mensagem (cod_chat, id_2){

   $.post ("funçõesPhp/puxarMsg.php", {cod_chat: cod_chat}, function (dados){
      chat = document.getElementById('chat')
         if (dados == 1){
            div = document.createElement("div");
            div.classList.add("mensagens");
            chat.appendChild(div);
            inputMensagem(cod_chat); 
         } 
         else {
            mensagens = JSON.parse(dados);
          

               div = document.createElement('div')
               div.classList.add('mensagens')
               chat.appendChild(div)
                  
            mensagens.forEach(element => {
               cod_usuario = element[0]
               mensagemFinal = element[1]
               
                  if (cod_usuario == id_2){

                     h1 = document.createElement('h1')
                     h1.innerText = mensagemFinal;
                     h1.classList.add('mensagemH1')

                     div.appendChild(h1)
                     h1 = undefined
                  } else {
                     h2 = document.createElement('h2')
                     h2.innerText = mensagemFinal;

                     div.appendChild(h2)
                     h2 = undefined
                  }
                  
            });


            inputMensagem(cod_chat)
         }
      })

   }



function inputMensagem(cod_chat){
   chat = document.getElementById('chat');

   div = document.createElement("div");
   div.classList.add("inputMsg");

   input = document.createElement("input");
   input.type = "text";

   input.placeholder = "Escreva aqui..."
   input.id = "mensagem_"+cod_chat;

   icone = document.createElement('i')
   icone.classList.add('fa-solid')
   icone.classList.add("fa-share")

   div.appendChild(input);
   div.appendChild(icone)
   chat.appendChild(div);

   
   input_pronto = document.getElementById(`mensagem_${cod_chat}`);

   input_pronto.addEventListener('keyup', (e) => {

     if (e.key == "Enter"){
      if (input_pronto.value == ''){
         return
      }
         const mensagem = input_pronto.value;
         enviarMsg(cod_chat, mensagem)
      }
   })

   icone.addEventListener('click', () => {
      const mensagem = input_pronto.value;
      enviarMsg(cod_chat, mensagem)
   })
}

function enviarMsg(cod_chat, mensagem){
   output = document.querySelector('.mensagens')
   h2 = document.createElement('h2')
   h2.innerText = mensagem
   output.appendChild(h2)


   $.post("./funçõesPhp/enviarMsg.php",{cod_chat: cod_chat, 
      mensagem: mensagem}, (retorno) => {

               if(retorno == 1){
               input_pronto.value = ''
               }
               else if (retorno == 0){
               alert('nao deu')
               }

})

}

function conversaSwitch(id){
   
   const conversas = document.querySelectorAll('.conversa')
   const radio = document.getElementById(id)
   console.log(radio)
   conversas.forEach(element =>{
      console.log(element)     
      
      
      console.log('removeu?')
      element.classList.add('conversa')
      element.classList.remove('conversaAtivo')
   


      if (element.id == `label_${id}`){
         console.log('selecionou')
         
         element.classList.add('conversaAtivo')
      
      } 

  
   })
   
}