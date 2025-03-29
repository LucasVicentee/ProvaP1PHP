<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="listarMotos.css">
    <title>Listar Motos</title>
</head>
<body>
    <div id="centro-listar">
        <h2>Lista de Motos</h2>

        <?php
        require_once "../DataBase.php";
        $localHost = 'localhost';
        $nomeBD = 'provap1';
        $user = 'root';
        $senha = 'Co123456789';

        $bd = new DataBase($localHost, $nomeBD, $user, $senha);
        $conexao = $bd->getConnection();

        $bdMotos = new DBMotos($conexao);

        $listaMotos = $bdMotos->listarMotos();

        if (!empty($listaMotos)) {
            echo "<ul>";
            foreach ($listaMotos as $moto) {
                echo "<li class='li-cli'>";
                echo "Código da Moto: " . $moto["mot_cod"] . "<br>";
                echo "Modelo da Moto: " . $moto["mot_modelo"] . "<br>";
                echo "Fabricante da Moto: " . $moto["mot_fabricante"] . "<br>";
                echo "Opcionais da Moto: " . $moto["mot_opcionais"] . "<br>";
                echo "Cor da Moto: " . $moto["mot_cor"] . "<br>";
                echo "</li>";
                echo "</ul>";
            }
        }
        else {
            echo "<p> Nem uma moto encontrada </p>";
        }
        ?>

        <a href="../index.php">
            <button type="button">Voltar ao Menu</button>
        </a>
    </div>
</body>
</html>