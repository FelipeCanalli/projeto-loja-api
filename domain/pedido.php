<?php 
// Esse arquivo é responsável com a comunicação com o banco e a preparação com o banco

class Pedido{
    public $idpedido;
    public $idcli;
    public $datapedido;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    // Função para listar todos os pedidos cadastrados no banco de dados
    public function listar(){
        $query = "select * from tbpedido";

        // Será criada a variável stmt (Statement - Sentença)
        // para guardar a preparação da consulta select que será 
        // executada posteriormente
        $stmt = $this->conexao->prepare($query);

        // Executar a consulta e retornar os dados
        $stmt->execute();
        return $stmt;
    }

    /* -------------------------------------------------------------------------- */

    // Função para cadastrar um pedido no banco de dados
    public function cadastrarPedido(){
        $query = "insert into tbpedido set idcli=:id";
        
        $stmt = $this->conexao-> prepare($query);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmt->bindParam(":id", $this->idcli);

        if ($stmt->execute()){
            return true;
        }else{
                return false;
            }
        }
}
?>
