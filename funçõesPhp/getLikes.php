<?php 
include_once ('../config.php');

//Puxa o caodigo da publicação
$id = $_POST['cod_publi'];

//Cria a consulta em mysql
$sql = "SELECT cod_like from tb_curtida where cod_publi = '$id'";

//Tenta consultar o banco
if($consulta = mysqli_query($conexao, $sql)){
    //Caso consiga, conta os like na publicação e retorna ao javascript
    $quantidade = mysqli_num_rows($consulta);
    echo $quantidade;
    return;

}

//Caso falhe retrona o erro
die('erro no banco de dados');

?>

