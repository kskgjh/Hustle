<?php 
include_once('../config.php');

//Puxa o usuario logado
$id = $_POST['id'];

//Cria a consulta
$sql = "SELECT nome, img FROM tb_usuario where cod_usuario= '$id'";

//Tenta consultar o banco e caso conseguir, envia os dados para o javascript
if ($consulta = mysqli_query($conexao, $sql)){
    $dados = $consulta ->fetch_row();
    echo json_encode($dados);
    return;
}
//Caso falhe retorna o erro
die('Não foi possivel comentar');

?>
