<?php
include_once('../config.php');

$id = $_SESSION['usuario']['cod_usuario'];

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$bio = $_POST['bio'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$pergunta = $_POST['pergunta'];
$resposta = $_POST['resposta'];

$sql = "UPDATE tb_usuario set
            nome = '$nome',
            email = '$email',
            telefone = '$telefone',
            bio = '$bio',
            estado = '$estado',
            cidade = '$cidade',
            pergunta = '$pergunta',
            resposta = '$resposta'
            where cod_usuario = '$id'    
        ";
        if (mysqli_query($conexao, $sql)){
            unset($sql);
            $sql = "SELECT * from tb_usuario where cod_usuario = '$id'";
            
                if ($consulta = mysqli_query($conexao, $sql)) {
                    $dados = $consulta ->fetch_assoc();
                    $_SESSION['usuario'] = $dados;
                }
            echo 1;
            return;
        }

    

        echo mysqli_error($conexao);
