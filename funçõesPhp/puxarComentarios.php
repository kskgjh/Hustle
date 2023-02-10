<?php 
include_once('../config.php');

$cod_publi = $_POST['cod_publi'];

$sql = "SELECT * FROM tb_comentarios where cod_publi = '$cod_publi'";
if ($consulta  = mysqli_query($conexao, $sql)){
    $dados = $consulta ->fetch_all();
    echo json_encode($dados);
    return;
}

echo 1;

