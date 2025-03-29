<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alterarDadosMoto.css">
    <title>Alterar dados da Moto</title>
</head>
<body>
    <div id="centro-alterar">
        <h2>Alterar dados da Moto</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-cadastro">
            <label for="mot_cod">Código da Moto: </label>
            <input type="text" id="mot_cod" name="mot_cod" class="input-field"><br>
            <label for="mot_modelo">Modelo da Moto: </label>
            <input type="text" id="mot_modelo" name="mot_modelo" class="input-field"><br>
            <label for="mot_fabricante">Fabricante da Moto: </label>
            <input type="text" id="mot_fabricante" name="mot_fabricante" class="input-field"><br>
            <label for="mot_opcionais">Opcionais da moto: </label>
            <input type="text" id="mot_opcionais" name="mot_opcionais" class="input-field"><br>
            <label for="mot_cor">Cor da Moto: </label>
            <input type="text" id="mot_cor" name="mot_cor" class="input-field"><br>
            <input type="submit" value="Alterar dados da moto" class="btn-submit">
        </form>

        <?php
        require_once "../DataBase.php";
        $localHost = 'localhost';
        $nomeBD = 'provap1';
        $user = 'root';
        $senha = 'Co123456789';

        $bd = new DataBase($localHost, $nomeBD, $user, $senha);
        $conexao = $bd->getConnection();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['mot_cod']) && !empty($_POST['mot_modelo']) && !empty($_POST['mot_fabricante']) && !empty($_POST['mot_opcionais']) && !empty($_POST['mot_cor']))  {
            $mot_cod = $_POST["mot_cod"];
            $mot_modelo = $_POST["mot_modelo"];
            $mot_fabricante = $_POST["mot_fabricante"];
            $mot_opcionais = $_POST["mot_opcionais"];
            $mot_cor = $_POST["mot_cor"];

            $bdMotos = new DBMotos($conexao);
            if ($bdMotos->alterarMoto($mot_cod, $mot_modelo, $mot_fabricante, $mot_opcionais, $mot_cor)) {
                echo "Dados alterado sucesso!";
            }
            else {
                echo "Erro ao alterar os dados da Moto.";
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