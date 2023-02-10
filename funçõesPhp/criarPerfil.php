<?php
include ('../config.php');
//Puxa os dadods do perfil clicado
$dados = $_POST['dados'];

//Cria uma variavel global com os dados
$_SESSION['dadosPerfil'] = $dados;

//Retorna 1 para o javascript quando terminar 
echo 1;

?>