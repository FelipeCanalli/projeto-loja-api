<?php 
// Esse arquivo é responsável com a comunicação com o banco e a preparação com o banco


class Usuario{
    public $idusuario;
    public $login;
    public $senha;
    public $foto;

    // criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    // Função para listar todos os usuários cadastrados no banco de dados

    public function listar(){
        $query = "select * from tbusuario";

        // Será criada a variável stmt (Statement - Sentença)
        // para guardar a preparação da consulta select que será 
        // executada posteriormente

        $stmt = $this->conexao->prepare($query);

        // executar a consulta e retornar os dados
        
        $stmt->execute();
        return $stmt;
    }
}
?>
