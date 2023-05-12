<?php

include("conexao.php");
include("protect.php");
$usuario = $_SESSION['usuario'];
?>

<!doctype html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/style.css">
    <style>
        #user-infos {
            padding-top: 70px;
            padding-left: 10px;
            text-align: center;
        }

        #outputImg {
            border-radius: 50%;
            width: 80px;
            height: 80px;
        }

        .dropdown {
            display: inline-flex;
            padding: 10px;
        }

        .dropdown-menu {
            padding: 20px;
            width: 500px;
            height: 200px;
        }

        #pubUser {
            margin: auto;
            max-width: 1000px;
            padding: 50px;
        }

        #outputImgPub {
            padding: 10px;
            width: 400px;
            height: 400px;
            border: 1px solid white;


        }
    </style>
</head>
<?php 
$usuario = $_SESSION['usuario'];
?>
<body>]
    <!-- Cabeçalho -->
    <header id="cabecalho-usuario">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">⚙️</a>
                <a href="logout.php">Sair</a>
                <a href="#">🙍</a>
            </div>
        </nav>
    </header>

    <div id="user-infos">
        <?php
        $sql = $mysqli->query("SELECT * FROM foto_perfil WHERE usuario LIKE '$usuario'");
        
        if ($sql->num_rows == 0) {
        ?>
            <p>Sem foto</p>
        <?php
        } else {
            while ($imprimir = $sql->fetch_assoc()) {
                $imprimir_perfil = $imprimir['caminho'];
                echo "<img id=\"outputImg\" src=\"$imprimir_perfil\">";
            }
        ?>

        <?php
        }
        ?>

        <h1 id="nome-usuario"><?php echo $usuario;?></h1>
        <h3 id="usuario-descrição"></h3>

        <div class="dropdown">

            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Mudar foto de perfil
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <form action="upload_perfil.php" method="post" enctype="multipart/form-data">

                    <label for="imagem">selecione uma imagem</label>
                    <input type="file" name="perfil" id="perfil"> <br> <br>
                    <input type="submit" value="Enviar foto">

                </form>

            </div>

        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Mudar Nome de usuario
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <p>Digite um novo nome de usuario</p>
                <input type="text" name="" id="novoNome">
                <button onclick="loadNome()">confirmar</button>
            </div>
        </div>
        <hr>
    </div>

    <div id="pubUser" style="text-align: center;">
        <div class="btn-group dropup">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ➕
            </button>
            <div class="dropdown-menu">
                <!-- upload de publicações -->
                <form action="upload_pub.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="pub" id="pub">
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>

        <!-- <div id="imagesContainer"></div> -->

        <?php
        $sql = $mysqli->query("SELECT * FROM publicacoes WHERE usuario LIKE '$usuario'");

        if ($sql->num_rows == 0) {
        ?>
            <p>nenhuma publicação</p>
        <?php
        } else {
            while ($pubs = $sql->fetch_assoc()) {
                $imprimir_pub = $pubs['caminho'];
                echo "<br> <img id=\"outputImgPub\" src=\"$imprimir_pub\" style=\"border: 1px solid white;\">";
            }
        ?>

        <?php
        }
        ?>



    </div>

    <footer id="rodape">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div id="menu" style="margin: auto;">
                <a href="index.html">🏠</a>
                <a href="#">🌐</a>
                <a href="#">📺</a>
                <a href="#">✉️</a>
                <a href="perfil.html">🙋‍♂️</a>
            </div>
        </nav>
    </footer>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        if (window.location.search.includes("voltando=true")) {
            setTimeout(function() {
                location.reload();
            }, 1000); // Recarrega a página após 1 segundo (1000ms)
        }
    </script>
</body>


</html>