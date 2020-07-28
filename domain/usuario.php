<?php 
    // Esse arquivo é responsável com a comunicação com o banco e a preparação com o banco

class Usuario{
    public $idusuario;
    public $login;
    public $senha;
    public $foto;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

/* -------------------------------------------------------------------------- */

    // Função para listar todos os usuários cadastrados no banco de dados
    public function listar(){
        $query = "select * from tbusuario";

        // Será criada a variável stmt (Statement - Sentença)
        // para guardar a preparação da consulta select que será 
        // executada posteriormente
        $stmt = $this->conexao->prepare($query);

        // Executar a consulta e retornar os dados
        $stmt->execute();
        return $stmt;
    }

/* -------------------------------------------------------------------------- */

             // Função para cadastrar um usuário no banco de dados
            public function cadastro(){
            $query = "insert into tbusuario set login=:l, senha=:s, foto=:f";
        
            $stmt = $this->conexao-> prepare($query);

            // Encriptografar a senha com o uso de md5
            $this->senha = md5($this->senha);

            // Vamos vincular os dados que vem do app ou navegador com os
            // campos de banco de dados (bind)
            $stmt->bindParam(":l", $this->login);
            $stmt->bindParam(":s", $this->senha);
            $stmt->bindParam(":f", $this->foto);

            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
}
?>
