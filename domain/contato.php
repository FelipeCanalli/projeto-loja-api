<?php 

class Contato{
    public $idcontato;
    public $email;
    public $telefone;

    // Iniciando o banco de dados 
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    // Função para listar todos os contatos cadastrados no banco de dados
    public function listar(){
        $query = " select * from tbcontato ";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    /* -------------------------------------------------------------------------- */

    // Função para cadastrar um novo contato no banco de dados
    public function cadastro(){
        $query = "insert into tbcontato set email=:e, telefone=:t";
    
        //Prepare a $query
        $stmt = $this->conexao-> prepare($query);

        // Vinculando os dados
        $stmt->bindParam(":e", $this->email);
        $stmt->bindParam(":t", $this->telefone);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    /* -------------------------------------------------------------------------- */

    // Função para apagar um contato do banco de dados
    public function apagarContato(){
        $query = "delete from tbcontato where idcontato=:id";
        
        $stmt = $this->conexao-> prepare($query);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmt->bindParam(":id", $this->idcontato);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }  
    }
}
?>
