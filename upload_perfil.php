<?php
include("conexao.php");
include("protect.php");
$usuario = $_SESSION['usuario'];

if (!isset($_FILES["perfil"])) {
    echo "Nenhuma foto enviada";
} else {
    $arquivo = $_FILES["perfil"];
    $nomedoArquivo = $arquivo['name'];
    $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION));
    $novoNome = uniqid();
    $pasta = 'imagens/user/profile/';

    $mysqli->query("DELETE FROM `foto_perfil` WHERE `foto_perfil`.`usuario` = '$usuario'");

    if ($extensao != "png" && $extensao != "jpg") {
        die("FORMATO DE ARQUIVO INVALIDO");
    } else {
        $path = $pasta . $novoNome . "." . $extensao;
        if (move_uploaded_file($arquivo["tmp_name"], $path)) {
            $mysqli->query("INSERT INTO foto_perfil(usuario, caminho)  VALUES('$usuario' ,'$path')") or die($mysqli->error);
        } else {
            die("FALHA AO ENVIAR O ARQUIVO");
        }
    }
    header('location: perfil.php');
}

?>
