<?php
include("conexao.php");
include("protect.php");
$usuario = $_SESSION['usuario'];//recebe o usuario

if (!isset($_FILES["perfil"])) {//verifica se existe algo enviado no formulario
    echo "Nenhuma foto enviada";
} else {
    $arquivo = $_FILES["perfil"];//recebe o arquivo
    $nomedoArquivo = $arquivo['name'];//revebe o nome do arquivo
    $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION));//recebe a extensão do arquivo
    $novoNome = uniqid();// recebe o novo nome do arquivo 
    $pasta = 'imagens/user/profile/';//recebe a pasta onde vai ser salvo

    $mysqli->query("DELETE FROM `foto_perfil` WHERE `foto_perfil`.`usuario` = '$usuario'");//deleta a foto q estava no perfil

    if ($extensao != "png" && $extensao != "jpg") {//verifica o formato do arquivo
        die("FORMATO DE ARQUIVO INVALIDO");
    } else {
        $path = $pasta . $novoNome . "." . $extensao;//recebe a pasta, o novo nome do arquivo e a extensão
        if (move_uploaded_file($arquivo["tmp_name"], $path)) {//move o arquivo para a pasta
            $mysqli->query("INSERT INTO foto_perfil(usuario, caminho)  VALUES('$usuario' ,'$path')") or die($mysqli->error);//adiciona na tabela o endereço do arquivo
        } else {
            die("FALHA AO ENVIAR O ARQUIVO");
        }
    }
    header('location: perfil.php');//volta para a apagina do perfil
}

?>
