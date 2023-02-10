
 function like(id_publi, id_usuario){
  const input = document.getElementById("like_"+id_publi+"_input");
  const coracao = document.getElementById("coracao_"+id_publi);

    if (!input.checked){
  
     coracao.setAttribute('style', "color:red; transition:all  1000ms ease-out; ");
     
      $.post('funçõesPhp/validarLike.php', {cod_publi: id_publi,
                                            cod_usuario: id_usuario}, function (dados) {

                                           
                                if (dados == 0){
                                  curtir(id_publi, id_usuario);
                                }else if (dados == 1){
                                  descurtir(id_publi, id_usuario);
                                  get_likes(id_publi, id_usuario);
                                }      
      })
    }
    else{
      descurtir(id_publi, id_usuario);
      coracao.setAttribute('style', "color:black; transition:all  1000ms ease-out;");
    }  
 }

 function verificar(id_publi, id_session) {
  const input = document.getElementById("like_" + id_publi + "_input");
  const coracao = document.getElementById("coracao_" + id_publi);

  $.post('funçõesPhp/validarLike.php', {
      cod_publi: id_publi,
      cod_usuario: id_session
    },
    function(dados) {
      if (dados == 0) {
        console.log("feito: nao curtiu");

      } else if (dados == 1) {
        input.checked = true;
        coracao.setAttribute('style', "color:red; transition:all  1000ms ease-out; ");
        console.log("feito: curtiu");
      }

    })
}



 function get_likes(id_publi){
  $.post ('funçõesPhp/getLikes.php', {cod_publi: id_publi}, function (quantidade){
    span = document.getElementById('span_' + id_publi);
    span.innerHTML = quantidade;
  })


 }
function curtir(id_publi, id_usuario){
  $.post('funçõesPhp/curtir.php', {cod_publi: id_publi,
                                  cod_usuario: id_usuario}, function (consulta){
                                    if (consulta == 1){
                                      get_likes(id_publi);
                                    } else if (consulta == 0){
                                      alert ("problema ao curir");
                                    }
  })
}

function descurtir(id_publi, id_usuario){
  $.post('funçõesPhp/descurtir.php', {cod_publi: id_publi,
    cod_usuario: id_usuario}, function (del){
        if (del == 1){
          get_likes(id_publi);
        }
        else if (del == 0){
          alert ("Falha ao descurtir");
        }
    })
}



function imgReact (id_input, id_span, classe_foto){
  console.log('começou');
    const inputFile = document.getElementById(id_input);
    const span = document.getElementById(id_span);


    inputFile.addEventListener('change', function(e){
      const inputTarget = e.target;
      const file = inputTarget.files[0];

      if (file){
        const reader = new FileReader();
        reader.addEventListener('load', function(x){
          const readerTarget = x.target;

          const img = document.createElement('img');
          img.src = readerTarget.result;
          img.classList.add(classe_foto);
          span.innerHTML = '';
          span.append(img);
          console.log('mudou?');
        })
        reader.readAsDataURL(file);

      }else{

        console.log('cancelou');
      }

    })


}

function criarPerfil(dados){
  console.log(dados)
  console.log('aqui')
  $.post('funçõesPhp/criarPerfil.php', {dados: dados}, (retorno)=>{
    if(retorno == 1){
      console.log('done')
      window.location.assign("perfil.php")
    }
  })
}



function verificar(id_publi, id_session) {
  const input = document.getElementById("like_" + id_publi + "_input");
  const coracao = document.getElementById("coracao_" + id_publi);
  $.post('funçõesPhp/validarLike.php', {
      cod_publi: id_publi,
      cod_usuario: id_session
    },
    function(dados) {
      if (dados == 0) {


      } else if (dados == 1) {
        input.checked = true;
        coracao.setAttribute('style', "color:red; transition:all  1000ms ease-out; ");

      }

    })
}


function pesquisa(value){

  const pesquisa = value.toLowerCase()
  const publitxt = document.getElementsByClassName('publitxt')

  Array.from(publitxt).forEach(element => {
      textoPubli = element.textContent.toLowerCase()
      
      publi = element.parentElement.parentElement
      publi.classList.add('hidden')
        if(textoPubli.includes(pesquisa)){
          publi.classList.remove('hidden')
        }
    
  });

}