<?php 
include("conexao.php");
include("protect.php");
$usuario = $_SESSION['usuario'];//pega o nome da sessão

$arquivo = $_FILES["pub"];//pega o arquivo enviado pelo formulario
$nomedoArquivo = $arquivo['name'];//pega o nome do arquivo
$extensao = strtolower(pathinfo($nomedoArquivo,PATHINFO_EXTENSION));//pega a extensão do arquivo
$novoNome = uniqid();//da um nome unico com a função uniqueid()
$pasta = 'imagens/user/pub/';//recebe a pasta onde sera salvo



if ($extensao != "png" && $extensao != "jpg") {//analiza o formato do arquivo
    die("FORMATO DE ARQUIVO INVALIDO");
} else {
    $path = $pasta . $novoNome . "." . $extensao; //recebe a pasta junto com o novo nome e a extensão do arquivo
    if (move_uploaded_file($arquivo["tmp_name"], $path)) {
        $mysqli->query("INSERT INTO publicacoes VALUES('$usuario' ,'$path')") or die($mysqli->error);//faz o upload na tabela do banco de dados
    } else {
        die("FALHA AO ENVIAR O ARQUIVO");
    }
}
header('location: perfil.php');//volta para a pagina do perfil

?>