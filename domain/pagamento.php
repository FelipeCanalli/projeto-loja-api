<?php 
// Esse arquivo é responsável com a comunicação com o banco e a preparação com o banco

class Pagamento{
    public $idpagamento;
    public $idpedido;
    public $tipo;
    public $descricao;
    public $valor;
    public $parcelas;
    public $valorparcela;
    public $idcli;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    // Função para listar todos os pagamentos cadastrados no banco de dados
    public function listar(){
        $query = "select * from tbpagamento";

        // Será criada a variável stmt (Statement - Sentença)
        // para guardar a preparação da consulta select que será 
        // executada posteriormente
        $stmt = $this->conexao->prepare($query);

        // Executar a consulta e retornar os dados
        $stmt->execute();
        return $stmt;
    }

    /* -------------------------------------------------------------------------- */

    // Função para cadastrar um pagamento no banco de dados
    public function cadastro(){

        $queryPedido = "insert into tbpedido set idcli=:id";
        
        $stmtPedido = $this->conexao->prepare($queryPedido);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmtPedido->bindParam(":id",$this->idcli);

        $stmtPedido->execute();
        
        $this->idpedido = $this->conexao->lastInsertId();

    /* -------------------------------------------------------------------------- */

        $query = "insert into tbpagamento set idpedido=:ip, tipo=:t, descricao=:d, valor=:v, parcelas=:p, valorparcela=:vp";
        
        $stmt = $this->conexao-> prepare($query);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmt->bindParam(":ip",$this->idpedido);
        $stmt->bindParam(":t",$this->tipo);
        $stmt->bindParam(":d",$this->descricao);
        $stmt->bindParam(":v",$this->valor);
        $stmt->bindParam(":p",$this->parcelas);
        $stmt->bindParam(":vp",$this->valorparcela);

        if ($stmt->execute()){
            return true;
        }else{
                return false;
            }
        }
}
?>
