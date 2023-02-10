<?php
include_once ('../config.php');
$id = $_SESSION['usuario']['cod_usuario'];

$cod_chat = $_POST['cod_chat'];

$sql = "SELECT * FROM tb_chat where cod_chat= '$cod_chat'";
if($consulta = mysqli_query($conexao, $sql)){
    $dadosChat = mysqli_fetch_array($consulta);
    unset($consulta, $sql);

        if ($dadosChat['cod_usuario_session'] === $id){
            $id_header = $dadosChat['cod_usuario_publi'];
        } 
        else {
            $id_header = $dadosChat['cod_usuario_session'];
        }

            $sql = "SELECT nome, img FROM tb_usuario WHERE cod_usuario = '$id_header'";
            if ($consulta = mysqli_query($conexao, $sql)){
                $dadosUserHeader = mysqli_fetch_array($consulta);
                unset($sql, $consulta);
                echo json_encode($dadosUserHeader);
            }
            else {
                echo "erro 2";
            }


} else {
    echo "erro 1";
}


?>