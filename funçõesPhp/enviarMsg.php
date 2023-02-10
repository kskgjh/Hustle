<?php
include_once ('../config.php');

//Puxa as informações 
$id = $_SESSION['usuario']['cod_usuario'];
$cod_chat = $_POST['cod_chat'];
$mensagem = $_POST['mensagem'];

//Cria o insert com os dados
$sql = "INSERT INTO tb_mensagem (cod_msg, mensagem, cod_chat, cod_usuario)
        VALUES (null, '$mensagem', '$cod_chat', '$id')";

//Tenta inserir e caso consiga retorna 1 ao javascirpt
if($insert = mysqli_query($conexao, $sql)){
    echo 1;
    return;
}
//Caso falhe retorna 0 
echo 0;

?>