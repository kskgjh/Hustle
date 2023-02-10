//Função ver mais da biografia
$(document).ready(()=>{

   const bioP = document.getElementById('bio') 

   if (!bioP){
      return
   }
   
   const bio = bioP.innerText
   const Pbackup = document.getElementById('backup')
   const div = document.querySelector('.user-bio')
   const bioCompleta = document.getElementById('bioCompleta').innerText

   if (bio.includes("...")){
     btnVerMais = document.createElement('button')
     btnVerMais.innerText = "Ver Mais"

     div.appendChild(btnVerMais)

     btnVerMais.addEventListener("click", (e)=>{
         botao = e.path[0].innerText      
         console.log(botao)

         if (botao == "Ver Mais"){
            Pbackup.innerText = bio
         
            bioP.innerText = bioCompleta
         
            btnVerMais.innerText = "Mostrar menos"
         }
         
         if (botao == "Mostrar menos"){
            bioP.innerText = Pbackup.innerText
         
            btnVerMais.innerText = "Ver Mais"
         }

     })

   
    

   }
})

// 

function salvarEdit (nome, email, telefone, bio, estado, cidade, pergunta, resposta) {
   $.post("funçõesPhp/editarPerfil.php", 
           {   nome: nome,
               email: email,
               telefone: telefone, 
               bio: bio,
               estado: estado,
               cidade: cidade,
               pergunta: pergunta,
               resposta: resposta
            },
            (retorno)=>{
               if (retorno == 1){
                  window.location.reload()
               }
            })



}