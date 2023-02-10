<?php
include_once ("../config.php");



$cod_chat = $_POST['cod_chat'];
$sql = "SELECT cod_usuario, mensagem FROM tb_mensagem where cod_chat = '$cod_chat'";


if($consulta = mysqli_query($conexao, $sql)){
$dados = $consulta ->fetch_all();

    if ($dados == ""){
        echo 1;
    } 
    else {
        echo json_encode($dados);
}
}
else {
    $retorno = "Erro mysqli: ";
    echo $retorno;
}

?>