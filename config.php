<?php 
session_start(); //inicia sessão
$dbName = 'hustle';
$dbHost = 'localhost';
$dbPassword= '';
$dbUsername = 'root';
// declara informações para conexao com Mysql

// Cria o banco e conecta com o servidor
$banco = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$conexao = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName) or die('Falha na conexão com o banco'. error_log($conexao));


// função para debugar php
function consoleLog($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP: " . $output . "' );</script>";
}


?>

