<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inserirMoto.css">
    <title>Cadastrar Moto</title>
</head>
<body>
    <div id="centro-inserir">
        <h2>Cadastrar Moto</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-cadastro">
            <label for="mot_modelo">Modelo da Moto: </label>
            <input type="text" id="mot_modelo" name="mot_modelo" class="input-field"><br>
            <label for="mot_fabricante">Fabricante da Moto: </label>
            <input type="text" id="mot_fabricante" name="mot_fabricante" class="input-field"><br>
            <label for="mot_opcionais">Opcionais da moto: </label>
            <input type="text" id="mot_opcionais" name="mot_opcionais" class="input-field"><br>
            <label for="mot_cor">Cor da Moto: </label>
            <input type="text" id="mot_cor" name="mot_cor" class="input-field"><br>
            <input type="submit" value="Cadastrar Moto" class="btn-submit">
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
            $mot_modelo = $_POST["mot_modelo"];
            $mot_fabricante = $_POST["mot_fabricante"];
            $mot_opcionais = $_POST["mot_opcionais"];
            $mot_cor = $_POST["mot_cor"];

            $bdMotos = new DBMotos($conexao);
            if ($bdMotos->inserirMoto($mot_modelo, $mot_fabricante, $mot_opcionais, $mot_cor)) {
                echo "Moto cadastrada com sucesso!";
            }
            else {
                echo "Erro ao cadastrar a Moto.";
            }
        }
        ?>

        <br>
        <a href="../index.php">
            <button type="button">Voltar ao Menu de escolhas</button>
        </a>
    </div>
</body>
</html>