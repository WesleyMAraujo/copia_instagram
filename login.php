<?php
include('conexao.php');

/* var_dump($mysqli); */

if (isset($_POST["usuario"]) || isset($_POST['senha'])) { //verifica se existe
    if (strlen($_POST["usuario"]) == 0) { //verifica o tamanho do email
        echo "Preencha seu usuario";
    } else if (strlen($_POST['senha'])  == 0) { //verifica se o tamanho da senha é igual a 0
        echo "Preencha sua senha";
    } else {
        //mantem a segurança para q caracteres especiais não interfiram
        $email = $mysqli->real_escape_string($_POST["usuario"]);
        $senha = $mysqli->real_escape_string($_POST['senha']);


        //codigo para consultar a tabela do banco de dados, onde a pesquisa é feita a partir do que foi digitado no formulario
        $sql_code = "SELECT * from usuarios where usuario = '$email' and senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do codigo SQL:" . $my->error);

        $quantidade = $sql_query->num_rows; //recebe o numero de linhas

        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();
            if (!isset($_SESSION)) {//verifica se a sessão não existe, se não existir a sessão é criada
                session_start();
            }
            $_SESSION['usuario'] = $usuario['usuario'];//caso usuario e senha estajão corretos o acesso para o perfil é liberado
            header("Location: perfil.php");
        } else {
            echo "Falha ao logar email ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

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
        <h1>Acesse sua conta</h1>
        <form action="" method="post">
            <p>
                <label>Email</label>
                <input type="text" name="usuario">
            </p>
            <p>
                <label>Senha</label>
                <input type="password" name="senha">
            </p>
            <button type="submit">entrar</button>
            <button><a href="cadastrar.php">cadastrar-se</a></button>
            
    </section>

</body>

</html>