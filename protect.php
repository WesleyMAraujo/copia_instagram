<?php 
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {//verifica se existe uma sessão valida para proceguir, se não, o acesso é barrado
    die("Você não pode acessar esta pagina porque não esta logado.<p><a href=\"login.php\">entrar</a></p>");
}
?>

