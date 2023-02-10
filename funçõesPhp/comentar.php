<?php 

include_once('../config.php');
//Puxa as informações necessárias 
$comentario = $_POST['comentario'];
$cod_publi = $_POST['cod_publi'];
$id = $_SESSION['usuario']['cod_usuario'];

//Cria o insert em sql
$sql = "INSERT INTO tb_comentarios (cod_comentario, cod_publi, cod_usuario, comentario)
                    values (null, '$cod_publi', '$id', '$comentario')";
//Tenta inserir e se conseguir retorna 1 ao javascript
    if ($consulta = mysqli_query($conexao, $sql)){
        echo 1;
        return;
    }
