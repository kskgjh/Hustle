function criarInputCom (cod_publi, img, nome) {
    console.log(`criando input: cod_publi:${cod_publi}, img:${img}, nome:${nome}`)
    const confirmar = document.getElementById('box_'+cod_publi)
    const  nomeimg = img
 
    if (!confirmar){
    const box = document.createElement('div');
    box.id = 'box_'+cod_publi

    const card = document.getElementById(`cardpubli_${cod_publi}`)
        console.log(card)
    const input = document.createElement('textarea');

    const img = document.createElement('img')    
    img.src = nomeimg? `uploadedImgs/${nomeimg}` : "img/default-profile.jpg"

    const icone = document.createElement('i')
    icone.classList.add('fa-solid')
    icone.classList.add("fa-share")

    const divInput = document.createElement('div')
    divInput.classList.add('input')
    divInput.id = `comentarioInput_${cod_publi}`

    divInput.appendChild(img)
    divInput.appendChild(input)
    divInput.appendChild(icone)

    box.appendChild(divInput)    

    card.appendChild(box)

    icone.addEventListener('click', () => {
        comentario = input.value
        $.post('funçõesPhp/comentar.php', { cod_publi: cod_publi,
                                            comentario: comentario}, (retorno) => {
                                                if (retorno == 1){
                                                input.value = ""
                                                divComentario = document.createElement('div')
                                                divComentario.classList.add('comentario')
                                                div = document.createElement('div')
                                                let  img = document.createElement('img')    
                                                img.src = `uploadedImgs/${nomeimg}`

                                                h2 = document.createElement('h2')
                                                h2.innerText = nome

                                                h1 = document.createElement('h1')
                                                h1.innerText = comentario

                                                divComentario.appendChild(img)
                                                div.appendChild(h2)
                                                div.appendChild(h1)
                                                divComentario.appendChild(div)

                                                box.insertBefore(divComentario, box.children[1])
                                                return
                                                }

                                                alert('falha ao comentar')
                                            })
        

    })    

    puxarcomenatrios(cod_publi)

    
    }
    else {
        confirmar.remove()
    }


}



function puxarcomenatrios(cod_publi) {

    const box = document.getElementById('box_'+cod_publi)

    $.post('funçõesPhp/puxarComentarios.php', {cod_publi: cod_publi}, (retorno)=>{
        const dados = JSON.parse(retorno)
        dados.forEach(element => {
            const divComentario = document.createElement('div')
            let comentario = element[3]
            let id = element[2]
            if (comentario == ''){
                return
            }

            $.post('funçõesPhp/commUser.php', {id : id}, (retorno)=>{
                infos = JSON.parse(retorno)
                let nome = infos[0]
                let nomeimg = infos[1]

                h2 = document.createElement('h2')
                h2.innerText = nome

                h1 = document.createElement('h1')
                h1.innerText = comentario

                let img = document.createElement('img')
                img.src = nomeimg?`uploadedImgs/${nomeimg}`:"img/default-profile.jpg"

                
                div = document.createElement('div')
                div.appendChild(h2)
                div.appendChild(h1)
               
                divComentario.classList.add('comentario')
                divComentario.appendChild(img)
                divComentario.appendChild(div)
                box.appendChild(divComentario)
            })

            


            
        });

        
    })

}