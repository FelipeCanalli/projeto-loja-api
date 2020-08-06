<?php 
// Esse arquivo é responsável com a comunicação com o banco e a preparação com o banco

class ItensPedido{
    public $iditens;
    public $idpedido;
    public $idproduto;
    public $quantidade;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    // Função para listar todos os Itens Pedido cadastrados no banco de dados
    public function listar(){
        $query = "select * from tbitenspedido";

        // Será criada a variável stmt (Statement - Sentença)
        // para guardar a preparação da consulta select que será 
        // executada posteriormente
        $stmt = $this->conexao->prepare($query);

        // Executar a consulta e retornar os dados
        $stmt->execute();
        return $stmt;
    }

    /* -------------------------------------------------------------------------- */

    // Função para cadastrar no banco de dados
    public function cadastro(){
        $query = "insert into tbitenspedido set idpedido=:ip, idproduto=:ipr, quantidade=:q ";
        
        $stmt = $this->conexao-> prepare($query);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmt->bindParam(":ip", $this->idpedido);
        $stmt->bindParam(":ipro", $this->idproduto);
        $stmt->bindParam(":q", $this->quantidade);

        if ($stmt->execute()){
            return true;
        }else{
                return false;
            }
        }

    /* -------------------------------------------------------------------------- */

        // Função para atualizar no banco de dados
        public function atualizarItensPedido(){
            $query = " update tbitenspedido set idpedido=:ip, idproduto=:ipr, quantidade=:q where iditens=:id";

            $stmt = $this->conexao-> prepare($query);

            // Vamos vincular os dados que vem do app ou navegador com os
            // campos de banco de dados (bind)
            $stmt->bindParam(":ip", $this->idpedido);
            $stmt->bindParam(":ipr", $this->idproduto);
            $stmt->bindParam(":q", $this->quantidade);
            $stmt->bindParam(":id", $this->iditens);


            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
}
?>
