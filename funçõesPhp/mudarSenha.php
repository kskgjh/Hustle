<?php
    include_once('../config.php');
    
    //Se estiver logado
    if (isset($_SESSION['usuario'])){
        //Puxa o email da sessão e as informações
        $email = $_SESSION['usuario']['email'];
        $confirm = $_POST['confirm'];
        $senha = $_POST['senha'];
    } 
    //Caso contrario 
    else {
        //Somente puxa as informações
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    }

    //Busca a senha da conta com email correspondente 
        $sql1 = "SELECT senha from tb_usuario where email= '$email'";

        //Tenta buscar
        if($consulta1 = mysqli_query($conexao, $sql1)){
            //Salva a senha atual da conta
            $senhaAtual = $consulta1 -> fetch_all();
            
            if(isset($confirm)){ //Caso esteja logado 
                if($senhaAtual[0][0] !== $confirm){ //E a senha atual seja diferente da inserida
                    //Retorna 1 ao javascript
                    echo 1;
                    return;
                }}
                //Caso não esteja logado 
            if ($senhaAtual[0][0] == $senha ){ //e a senha inserida seja
                echo 1;
                return;
            }

            $sql2 = "UPDATE tb_usuario set senha = '$senha' where email = '$email'";
            if ($consulta2 = mysqli_query($conexao, $sql2)){
                echo 'boa'; 
            } 
            else {
                echo mysqli_error($conexao);
            }
        }
        //Caso nao consiga retorna o erro
        else {
            echo mysqli_error($conexao);
        }
?>