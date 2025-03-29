<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="deletarMoto.css">
    <title>Deletar Moto</title>
</head>
<body>
<div id="centro-deletar">
        <h2>Deletar Moto</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-cadastro">
            <label for="mot_cod">Código da Moto: </label>
            <input type="text" id="mot_cod" name="mot_cod" class="input-field"><br>
            <input type="submit" value="Deletar Moto" class="btn-submit">
        </form>

        <?php
        require_once "../DataBase.php";
        $localHost = 'localhost';
        $nomeBD = 'provap1';
        $user = 'root';
        $senha = 'Co123456789';

        $bd = new DataBase($localHost, $nomeBD, $user, $senha);
        $conexao = $bd->getConnection();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mot_cod = $_POST["mot_cod"];

            $bdMotos = new DBMotos($conexao);
            if ($bdMotos->deletarMoto($mot_cod)) {
                echo "Moto deletada com sucesso!";
            }
            else {
                echo "Erro ao deletar a Moto.";
            }
        }
        ?>

        <br>
        <a href="../index.php">
            <button type="button">Voltar ao Menu de escolhas</button>
        </a>
</body>
</html>