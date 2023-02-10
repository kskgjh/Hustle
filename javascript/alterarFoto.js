$(document).ready(()=>{

    let  input = document.getElementById('inputFoto')
    const content = document.querySelector('.content')
    
    
    input.addEventListener('change', (e)=>{

      input = e.target
      file = input.files[0]

    if (file){
        content.innerHTML = ""

        const img = document.createElement('img')
        img.src = URL.createObjectURL(file)
        img.classList.add('contentImg')
        content.appendChild(img)

        const btn1 = document.createElement('button')
        btn1.innerText = "Salvar"

        const btn2 = document.createElement('button')
        btn2.innerText = "Cancelar"

        const divBtns = document.createElement('div')
        divBtns.classList.add('contentBtnDiv')

        divBtns.appendChild(btn1)
        divBtns.appendChild(btn2)
        content.appendChild(divBtns)

        switchModal('modal')

        btn2.addEventListener('click', ()=>{
            console.log('CANCELOU')
            window.location.reload()
        })

        btn1.addEventListener('click', ()=>{
            
            const conteudo = new FormData()
            conteudo.append("image", file)
            console.log(conteudo)
                $.ajax({    url: "funçõesPhp/alterarFoto.php",
                            type: "POST",
                            data: conteudo,
                            processData: false,
                            contentType: false,
                            success:function(retorno){
                                if (retorno == 0){
                                    switchModal('modal')
                                    alert('Falha ao alterar foto, tente novamente mais tarde...')
                                }

                              
                                    window.location.reload()
                            }
                })
        })
    }
})
    })

function switchModal (id){
    console.log('alterando modal')

    const modal = document.getElementById(id)
    const dysModal = modal.style.display

    if (dysModal == 'none'){
        modal.style.display = "block"
        return
    }

    modal.style.display = "none"
  
  }