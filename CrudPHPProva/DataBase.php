<?php
class DataBase{
    private $host;
    private $db_name;
    private $userName;
    private $passWord;
    private $DbConnection;

    public function __construct($servidor, $nomeBanco, $usuario, $senha){
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->userName = $usuario;
        $this->passWord = $senha;
        $this->DbConnection = $this->getConnection();
    }

    public function getConnection(){
        try{
            $conexao = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->userName, $this->passWord);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        }
        catch(PDOException $e){
            echo "Erro com a conexão do banco de dados." . $e->getMessage();
            exit();
        }
        return $conexao;
    }
}

class DBMotos {
    private $conexao;
    private $tableName = 'motos';

    public function __construct($conexaoBD){
        $this->conexao = $conexaoBD;
    }

    public function listarMotos(){
        $query = " SELECT * FROM " . $this->tableName;

        try{
            $result = $this->conexao->prepare($query);
            $result->execute();

            $dados = $result->fetchALL(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo "Erro ao listar as motos." . $e->getMessage();
        }

        return $dados;
    }

    public function inserirMoto($mot_modelo, $mot_fabricante, $mot_opcionais, $mot_cor){
        $query = " INSERT INTO " . $this->tableName . " (mot_modelo, mot_fabricante, mot_opcionais, mot_cor) VALUES (:mot_modelo, :mot_fabricante, :mot_opcionais, :mot_cor) ";
        
        try{
            $result = $this->conexao->prepare($query);

            $result->bindParam(':mot_modelo', $mot_modelo);
            $result->bindParam(':mot_fabricante', $mot_fabricante);
            $result->bindParam(':mot_opcionais', $mot_opcionais);
            $result->bindParam(':mot_cor', $mot_cor);

            if($result->execute()){
                return true;
            }
            else{
                return false;
            };
        }
        catch(PDOException $e){
            echo "Erro PDO. " . $e->getMessage();
        }
    }

    public function alterarMoto($mot_cod, $mot_modelo, $mot_fabricante, $mot_opcionais, $mot_cor){
        $query = " UPDATE " . $this->tableName . " SET mot_modelo = :mot_modelo, mot_fabricante = :mot_fabricante, mot_opcionais = :mot_opcionais, mot_cor = :mot_cor WHERE mot_cod = :mot_cod ";

        try{
            $result = $this->conexao->prepare($query);

            $result->bindParam(":mot_cod", $mot_cod);
            $result->bindParam(":mot_modelo", $mot_modelo);
            $result->bindParam(":mot_fabricante", $mot_fabricante);
            $result->bindParam(":mot_opcionais", $mot_opcionais);
            $result->bindParam(":mot_cor", $mot_cor);

            $result->execute();

            if ($result->rowCount() > 0) {
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e){
            echo "Erro ao atualizar os dados da moto. " . $e->getMessage();
        }
    }

    public function deletarMoto($mot_cod){
        $query = "DELETE FROM " . $this->tableName . " WHERE mot_cod = :mot_cod";
        
        try{
            $result = $this->conexao->prepare($query);

            $result->bindParam(":mot_cod", $mot_cod);

            $result->execute();

            if($result->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        catch(PDOException $e){
            echo "Erro ao apagar os dados da moto ";
        }
    }

    public function buscarRegistroMoto($mot_busca){
        $query = " SELECT * FROM  " . $this->tableName . " WHERE mot_modelo = :mot_modelo ";

        try{
            $result = $this->conexao->prepare($query);

            $result->bindParam(":mot_modelo", $mot_busca);

            $result->execute();

            $moto = $result->fetch(PDO::FETCH_ASSOC);

            if($moto){
                return $moto;
            }
            else{
                echo "Moto não encontrada.";
                return null;
            }
        }
        catch(PDOException $e){
            echo "Erro ao buscar o resgitro da moto. " . $e->getMessage();
        }

        return $moto;
    }
}