<?php 
include("conexao.php");
include("protect.php");
$usuario = $_SESSION['usuario'];

$arquivo = $_FILES["pub"];
$nomedoArquivo = $arquivo['name'];
$extensao = strtolower(pathinfo($nomedoArquivo,PATHINFO_EXTENSION));
$novoNome = uniqid();
$pasta = 'imagens/user/pub/';



if ($extensao != "png" && $extensao != "jpg") {
    die("FORMATO DE ARQUIVO INVALIDO");
} else {
    $path = $pasta . $novoNome . "." . $extensao;
    if (move_uploaded_file($arquivo["tmp_name"], $path)) {
        $mysqli->query("INSERT INTO publicacoes VALUES('$usuario' ,'$path')") or die($mysqli->error);
    } else {
        die("FALHA AO ENVIAR O ARQUIVO");
    }
}
header('location: perfil.php');

?>