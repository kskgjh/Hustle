<?php 
include_once ("../config.php");

//Puxa as informações 
$id = $_POST['cod_publi'];
$cod_usuario = $_POST['cod_usuario'];

//Cria um delete em mysql com os dados
$sql = "DELETE FROM tb_curtida where cod_publi= '$id' and cod_usuario = '$cod_usuario'";

//Tenta deletar e caso consiga retorna 1 ao javascript
if (mysqli_query($conexao, $sql)){
    echo 1;
    return;
} 

//Caso falhe retorna 0
echo 0;

?>