<?php
include_once('../config.php');

$email = $_POST['email'];

$sql = "SELECT pergunta, resposta from tb_usuario where email = '$email'";

if ($consulta = mysqli_query($conexao, $sql)){
            if ($consulta == ''){
                echo 1;
                return;
            }
    $dados = $consulta ->fetch_all();
    echo json_encode($dados);
} else {
    echo mysqli_error($conexao);
}
?>