<?php 
include_once('../config.php');

$id = $_SESSION['usuario']['cod_usuario'];
$foto = $_FILES['image'];

$extensao = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
$nomeFoto = md5($foto['name']) . time() . '.' . $extensao;
$diretorio = "../uploadedImgs/";
$foto['name'] = $nomeFoto;



move_uploaded_file($foto['tmp_name'], $diretorio . $nomeFoto) or die("Falha ao mover foto");

$sql = "UPDATE tb_usuario
        set img ='$nomeFoto'
        where cod_usuario = '$id' ";
    if (mysqli_query($conexao, $sql)){
        $_SESSION['usuario']['img'] = $nomeFoto;
        echo $nomeFoto;
        return;
    }

    echo 0;


?>