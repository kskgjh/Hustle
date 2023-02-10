<?php
include_once ('../config.php');

$id = $_POST['cod_publi'];
$cod_usuario = $_POST['cod_usuario'];


$sql = "SELECT * from tb_curtida where cod_publi = '$id' and cod_usuario= '$cod_usuario'";
$consulta = mysqli_query($conexao, $sql);





if (mysqli_num_rows($consulta) < 1){
    $verificar = 0;
}elseif(mysqli_num_rows($consulta) > 0){
    $verificar = 1;
}
echo $verificar;