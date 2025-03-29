<?

class DataBase{
    private $host;
    private $db_name;
    private $userName;
    private $passWord;
    private $DbConnection;

    public function __construct($servidor, $nomeBanco, $usuario, $senha){
        $this->host = $servidor;
        $this->db_name = $$nomeBanco;
        $this->userName = $usuario;
        $this->passWord = $senha;
        $this->DbConnection = $this->getConnection();
    }

    public function getConnection(){
        try{
            $conexao = new PDO("mysql:host={$this->host};db_name={$this->db_name}",$this->userName, $this->passWord);  
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
    private $tabelName = 'motos';

    public function __construct($conexaoBD){
        $this->conexao = $conexaoBD;
    }

    public function listarMotos(){
        $query = " SELECT * FROM " . $this->tabelName;

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

    public function inserirMoto($mot_cod, $mot_modelo, $mot_fabricante, $mot_opcionais, $mot_cor){
        $query = " INSERT INTO " . $this->tabelName . " (mot_cod, mot_modelo, mot_fabricante, mot_opcionais, mot_cor) VALUES (:mot_cod, mot_modelo, :mot_fabricante, :mot_opcionais, :mot_cor) ";
        
        try{
            $result = $this->conexao->prepare($query);

            $result->bindPram(':mot_cod', $mot_cod);
            $result->bindPram(':mot_modelo', $mot_modelo);
            $result->bindPram(':mot_fabricante', $mot_fabricante);
            $result->bindPram(':mot_opcionais', $mot_opcionais);
            $result->bindPram(':mot_cor', $mot_cor);

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
        $query = " UPDATE " . $this->tabelName . " SET :mot_modelo = :mot_modelo, mot_fabricante = :mot_fabricante, mot_opcionais = :mot_opcionais, mot_cor = :mot_cor WHERE mot_cod = :mot_cod ";

        try{
            $result = $this->conexa->prepare($query);

            $result->bindPram(":mot_cod", $mot_cod);
            $result->bindPram(":mot_modelo", $mot_modelo);
            $result->bindPram(":mot_fabricante", $mot_fabricante);
            $result->bindPram(":mot_opcionais", $mot_opcionais);
            $result->bindPram(":mot_cor", $mot_cor);

            $result->execute();

            if ($result->rowCount() > 0) {
                return true;
            }
            else{
                return false;
            }
        }
        catch (PDOException $e){
            echo "Erro ao atualizar os dadso da moto. " . $e->getmessage();
        }
    }

    public function deletarMoto($mot_cod){
        $query = "DELETE FROM " . $this->tabelName . "WHERE mot_cod = :mot_cod";
        
        try{
            $result = $this->conexao->prepare($query);

            $result->bindPram(":mot_cod", $mot_cod);

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
}