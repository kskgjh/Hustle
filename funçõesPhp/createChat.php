<?php 
include_once ('../config.php');

//Puxa o codigo dos usuarios
$id_usuario_publi = $_POST['id_usuario_publi'];
$id_usuario_session = $_POST['id_usuario_session'];

//Cria o insert com os dados
$sql = "INSERT INTO tb_chat (cod_chat, cod_usuario_publi, cod_usuario_session)
        VALUES (null, '$id_usuario_publi', '$id_usuario_session')";

//Tenta inserir e se conseguir retorna 1 para o javascript        
if (mysqli_query($conexao, $sql)){
    echo 1;
    return;
}

//Caso falhe, retorna 0
echo 0;
