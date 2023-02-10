$(document).ready(()=>{

    btn = document.getElementById('submit')
    email = document.getElementById('email')
    btn.addEventListener('click', ()=>{
        console.log('clicou')
            $.post("funçõesPhp/puxarPergunta.php", {email: email.value}, (retorno)=>{
                if (retorno == '1'){
                    span = document.createElement('span')
                    span.innerText = "Nenhumma pergunta encontrada."
                    span.classList.remove("hidden")

                    div = document.getElementById('input')
                    div.appendChild(span)

                    console.log('sem pergunta')
                    return
                }
                dados = JSON.parse(retorno)
                console.log(dados)

                pergunta = dados[0][0]
                resposta = dados[0][1]

                puxarPergunta(email.value, pergunta, resposta)
            })   
    })
})

function puxarPergunta(email, pergunta, resposta){
    div = document.querySelector('.content')

    h1 = document.createElement('h1')
    h1.innerText = pergunta+'?'

    input = document.createElement('input')
    input.classList.add('formsInput')
    input.type = 'text'

    button = document.createElement('button')
    button.classList.add('btn')
    button.innerText = 'Enviar'
    
    span = document.createElement('span')
    span.classList.add('hidden')
    

    divInput = document.createElement('div')
    divInput.classList.add('divInput')

    divInput.appendChild(span)
    divInput.appendChild(input)
    
    div.innerText = ''
    div.classList.add('box')
    div.appendChild(h1)
    div.appendChild(divInput)
    div.appendChild(button)

    button.addEventListener('click', ()=>{
        respostaUser = input.value
        input.value = ''
        if(respostaUser == resposta){
            console.log('respondeu certo')
            mudarSenha(email)
            return
        }

        console.log('respondeu errado')
        span.innerText = "Resposta errada, tente novamente."
        span.classList.remove('hidden')
        
    })
}


function mudarSenha(email){
    div = document.querySelector('.content')
    divInput = document.createElement('div')

    h1 = document.createElement('h1')
    h1.innerText = 'Escolha e confirme uma nova senha:'

    input1 = document.createElement('input')
    input1.type = 'password'
    input1.classList.add('formsInput')
    input1.placeholder = "Senha"

    input2 = document.createElement('input')
    input2.type = 'password'
    input2.classList.add('formsInput')
    input2.placeholder = "Confirme a senha"

    button = document.createElement('button')
    button.innerText = 'Trocar'
    button.classList.add('btn')

    span = document.createElement('span')
    span.classList.add('hidden')
    span.id = 'span'
    
    div.innerText = ''
    div.appendChild(h1)
    divInput.appendChild(span)
    divInput.appendChild(input1)
    divInput.appendChild(input2)
    div.appendChild(divInput)
    div.appendChild(button)

    button.addEventListener('click', ()=>{
        senha1 = input1.value
        senha2 = input2.value

        if (senha1 == senha2){
            trocar(email, senha1)
            return
        }

        span.innerText = 'As senhas não coincidem.'
        span.classList.remove('hidden')
    })
}

function trocar (email, senha){

    $.post ('funçõesPhp/mudarSenha.php', {email: email,
                                         senha: senha}, (retorno)=>{
                                            console.log(retorno)
                                            if (retorno == 1){

                                                span = document.getElementById('span')
                                                console.log(span)
                                                span.innerText = "A nova senha não pode ser igual a anterior";
                                                span.classList.remove('hidden')
                                                return
                                            }

                                                console.log('mudou') 
                                                content = document.querySelector('.content')                                           

                                                span = document.createElement('span')

                                                h1 = document.createElement('h1')
                                                h1.innerText = 'Senha alterada com sucesso.'

                                                btn = document.createElement('button')
                                                btn.classList.add('btn')
                                                btn.innerText = 'Login'
                                                

                                                content.innerText = ''
                                                content.appendChild(span)
                                                content.appendChild(h1)
                                                content.appendChild(btn)

                                                btn.addEventListener('click', ()=>{
                                                    window.location.href = 'login.php'
                                                })
                                         })
}
