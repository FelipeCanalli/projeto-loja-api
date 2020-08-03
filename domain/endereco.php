<?php

class Endereco{
    public $idendereco;
    public $tipo;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;

    // Iniciando o banco de dados 
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    // Função para listar todos os endereços cadastrados no banco de dados
    public function listar(){
        $query = " select * from tbendereco ";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    /* -------------------------------------------------------------------------- */

    // Função para cadastrar um novo endereço no banco de dados
    public function cadastro(){
        $query = "insert into tbendereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:cep";
    
        //Prepare a $query
        $stmt = $this->conexao-> prepare($query);

        // Vinculando os dados
        $stmt->bindParam(":t", $this->tipo);
        $stmt->bindParam(":l", $this->logradouro);
        $stmt->bindParam(":n", $this->numero);
        $stmt->bindParam(":c", $this->complemento);
        $stmt->bindParam(":b", $this->bairro);
        $stmt->bindParam(":cep", $this->cep);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    /* -------------------------------------------------------------------------- */

    // Função para apagar um endereço do banco de dados
    public function apagarEndereco(){
        $query = "delete from tbendereco where idendereco=:id";

        //Prepare a $query
        $stmt = $this->conexao-> prepare($query);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmt->bindParam(":id", $this->idendereco);
    
        if ($stmt->execute()){
            return true;
            }else{
            return false;
        }
    }

    /* -------------------------------------------------------------------------- */

        // Função para alterar dados de endereço no banco de dados
        public function alterarEndereco(){
            $query = " update tbendereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:cep where idendereco=:id ";

            $stmt = $this->conexao-> prepare($query);

            // Vamos vincular os dados que vem do app ou navegador com os
            // campos de banco de dados (bind)
            $stmt->bindParam(":t",  $this->tipo);
            $stmt->bindParam(":l",  $this->logradouro);
            $stmt->bindParam(":n",  $this->numero);
            $stmt->bindParam(":c",  $this->complemento);
            $stmt->bindParam(":b",  $this->bairro);
            $stmt->bindParam(":cep", $this->cep);
            $stmt->bindParam(":id", $this->idendereco);

            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }    
        }
}
?>   
