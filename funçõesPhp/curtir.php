<?php 
include_once ('../config.php');

//Puxa as informações 
$id = $_POST['cod_publi'];
$cod_usuario = $_POST['cod_usuario'];

//Cria um insert no banco com os dados
$sql = "INSERT INTO tb_curtida (cod_like, cod_usuario, cod_publi)
        values (null, '$cod_usuario', '$id')";
//Tenta inserir e caso consiga retorna 1 ao javascript
 if (mysqli_query($conexao, $sql)){
    echo 1;
    return;
 } 

//Caso falhe retorna 0
 echo 0;

 ?>