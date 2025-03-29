<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inserirMoto.css">
    <title>Listar Motos por Nome</title>
</head>
<body>
    <div id="centro-listarPornome">
        <h2>Listar Motos por Nome</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-cadastro">
            <label for="mot_modelo">informe o modelo da moto: </label>
            <input type="text" id="mot_modelo" name="mot_modelo" class="input-field"><br>
            <input type="submit" value="procurar modelo da moto" class="btn-submit">
        </form>

        <?php
        require_once "../DataBase.php";
        $localHost = 'localhost';
        $nomeBD = 'provap1';
        $user = 'root';
        $senha = 'Co123456789';

        $bd = new DataBase($localHost, $nomeBD, $user, $senha);
        $conexao = $bd->getConnection();

        $bdMotos = new DBMotos($conexao);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $mot_modelo = $_POST["mot_modelo"];

            $moto = $bdMotos->buscarRegistroMoto($mot_modelo);

            if ($moto) { 
                echo "<br>";
                echo "Dados da Moto";
                echo "<li class='li-cli'>";
                echo "Código da Moto: " . $moto["mot_cod"] . "<br>";
                echo "Modelo da Moto: " . $moto["mot_modelo"] . "<br>";
                echo "Fabricante da Moto: " . $moto["mot_fabricante"] . "<br>";
                echo "Opcionais da Moto: " . $moto["mot_opcionais"] . "<br>";
                echo "Cor da Moto: " . $moto["mot_cor"] . "<br>";
                echo "</li>";
                echo "</ul>";
            }
            else {
                echo "Nem uma moto encontrada com o modelo " . $mot_modelo;
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