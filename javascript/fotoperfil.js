var inputFile = document.querySelector(".formsInputFoto");
var span = document.querySelector(".fotoSpan");
var spanTxt = "<i class='fa-solid fa-image'></i>";
span.innerHTML = spanTxt;

inputFile.addEventListener('change', function(e) {
    const inputTarget = e.target;
    const file = inputTarget.files[0];
    
    if (file){
       const reader = new FileReader();
        reader.addEventListener('load', function(e){
            const readerTarget = e.target;

            const img = document.createElement('img');
            img.src = readerTarget.result;
            img.classList.add('fotoJs');
            span.innerHTML = "";
            span.appendChild(img);
        })
       reader.readAsDataURL(file);
      
    }else{
        span.removeAttribute('style');
        span.innerHTML = "<i class='fa-solid fa-image'></i>";
    }
})

