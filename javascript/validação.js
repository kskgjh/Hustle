const senha = document.getElementById('senha');
const senha2 = document.getElementById('senha2');
senha.addEventListener('input', function(){validate(senha)});
senha2.addEventListener('input', function(){validate(senha2)});


function validate(item){
  if (item==senha2){
    if(item.value ===senha.value) item.setCustomValidity('');
    else item.setCustomValidity('As senhas digitadas não são iguais.');
  }
}