<?php 
include_once('../config.php');

$id= $_SESSION['usuario']['cod_usuario'];

    $sql = "DELETE FROM tb_usuario where cod_usuario = '$id'";

        if (mysqli_query($conexao, $sql)){
  
            unset($sql);
        }else{
            return mysqli_error($conexao);
        }

        $sql = "DELETE from tb_img_publi where cod_usuario = '$id'";
                
            if (mysqli_query($conexao, $sql)){
         
                unset($sql);
            }else{
                return mysqli_error($conexao);
            }

        $sql = "DELETE from tb_publi where cod_usuario = '$id'";

            if (mysqli_query($conexao, $sql)){
               
                unset($sql);
            } else{
                return mysqli_error($conexao);
            }

        
        $sql = "DELETE FROM tb_curtida where cod_usuario = '$id'";

            if(mysqli_query($conexao, $sql)){
           
                unset($sql);
            }else{
                return mysqli_error($conexao);
            }

        $sql = "DELETE FROM tb_mensagem where cod_usuario = '$id'";
            
            if(mysqli_query($conexao, $sql)){

                unset($sql);
            }else{
                return mysqli_error($conexao);
            }
        
        $sql = "DELETE FROM tb_chat where cod_usuario_publi = '$id' or cod_usuario_session = '$id'";
            
            if(mysqli_query($conexao, $sql)){

                unset($sql);
            }else{
                return mysqli_error($conexao);
            }

            unset($_SESSION['usuario']);

            echo 1;

            ?>