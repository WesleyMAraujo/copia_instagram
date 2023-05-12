<?php 
include("conexao.php");

/* $mysqli->query("INSERT INTO usuarios VALUES('$usuario' ,'$path')"); */

if (isset($_POST["cad-usuario"]) || isset($_POST['cad-senha'])) { //verifica se existe
    if (strlen($_POST["cad-usuario"]) == 0) { //verifica o tamanho do usuario
        echo "Preencha seu usuario";
    } else if (strlen($_POST['cad-senha'])  == 0) { //verifica se o tamanho da senha é igual a 0
        echo "Preencha sua senha";
    } else {
        $usuario = $mysqli->real_escape_string($_POST["cad-usuario"]);
        $senha = $mysqli->real_escape_string($_POST['cad-senha']);

        $mysqli->query("INSERT INTO usuarios(usuario, senha) VALUES('$usuario' ,'$senha')");
        echo "Cadastro efetuado com sucesso:<a href=\"login.php\">Fazer Login</a>";

        header("Locale: login.php");
    }
        
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            text-align: center;
        }

        section {
            border: 1px solid black;
            border-radius: 10px;
            max-width: 500px;
            height: 300px;
            margin: auto;
            margin-top: 20vh;
        }

        form {
            margin-top: 10vh;
            padding: 20px;
        }
        
        p {
            padding: 5px;
        }

        input {
            padding: 10px;
        }
        button {
            padding: 10px;
        }
    </style>
</head>

<body>
    <section>
        <h1>Cadastre sua conta</h1>
        <form action="" method="post">
            <p>
                <label>usuario</label>
                <input type="text" name="cad-usuario">
            </p>
            <p>
                <label>Senha</label>
                <input type="password" name="cad-senha">
            </p>
            <button type="submit">Cadastrar</b>
       
    </section>

</body>

</html>