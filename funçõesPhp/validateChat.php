<?php
include_once ('../config.php');

$id_publi = $_POST['id_usuario_publi']; //41
$id_session = $_POST['id_usuario_session']; //42


$sql1 = "SELECT * from tb_chat
         where cod_usuario_publi = '$id_publi' and cod_usuario_session = '$id_session'";

$sql2 = "SELECT * FROM tb_chat 
         where cod_usuario_publi = '$id_session' and cod_usuario_session = '$id_publi'";

$result1 = mysqli_num_rows(mysqli_query($conexao, $sql1));
$result2 = mysqli_num_rows(mysqli_query($conexao, $sql2));

if ($result1 + $result2 < 1){
    echo 1;
} else {
    echo 0;
}

?>