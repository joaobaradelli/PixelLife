<?php

session_start();
$logado = true;
if (!isset($_SESSION['email']) == true and !isset($_SESSION['senha']) == true) {
    
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['usuario']);
    unset($_SESSION['logado']);
    $logado = false;
    header('location: ../../../login.php');
}


if (isset($_POST['concluir']) && $_POST['senhaAntiga'] == $_SESSION['senha']) {

    include_once('../../../config.php');

    $usuario = $_SESSION['usuario'];
    $antiga_senha = $_SESSION['senha'];
    $novo_senha = $_POST['nova'];
    $email = $_SESSION['email'];

    $sql = "UPDATE usuario
    SET senha = '$novo_senha'
    WHERE nome_usuario = '$usuario' and email = '$email' and senha = '$antiga_senha'";

    $result = $conexao->query($sql);

    $_SESSION['senha'] = $novo_senha;
    header('location:../myprofile.php');

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" href="documentos/LogoRosa.png">
    <link rel="stylesheet" href="css/senha.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@200;300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>Modificar Dados | PixelLife</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <nav class="nav" id="nav1">
        <div class="container">
            <div class="logo">
                <a href="../../../index.php" style="border-bottom: none;"><img src="documentos/LogoPixelLife.png" width="130px"
                        height="60px" style="margin-top: 3px;"></a>
            </div>
            <div class="main_list" id="mainListDiv">
                <ul>
                    <li><a href="../../../index.php">Home</a></li>
                    <li><a href="../../../plano.php">Assine</a></li>
                    <li><a href="../../../envioImagem.php">Upload</a></li>
                    <?php
                    if ($_SESSION['logado'] == true) {

                        echo '<li><a class="navLogin" href="../../../myprofile.php">' . $_SESSION['usuario'] . '</a></li>';

                    } elseif ($_SESSION['logado'] == false) {


                        echo '<li><a href="../../../cadastro.php">Cadastro</a></li>
							<li><a class="navLogin" href="../../../login.php">Login</a></li>';
                    }


                    ?>
                </ul>

            </div>


            <div class="media_button">
                <button class="main_media_button" id="mediaButton">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <div class="all">
        <a href="../myprofile.php" class="btClose"><img class="close" src="../../../documentos/close.png"></a>
        <P CLASS="tituloUpload">Alterar a senha</P>
        <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
            </div>
            <label for="titulo" class="text">Senha antiga:</label></br>
            <input type="text" name="senhaAntiga" class="cxdt" required></br>
            <label for="descricao" class="text">Nova senha:</label></br>
            <input type="text" name="nova" class="cxdt" required></br>
            <hr style="background-color: black;">
            </hr>
            <input class="btUpload" type="submit" value="Concluir" name="concluir">
        </form>
    </div>



</body>

</html>