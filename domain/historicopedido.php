<?php

class HistoricoPedido{
    public $idcli;
    public $idpedido;
    public $datapedido;
    public $nomeproduto;
    public $preco;
    public $quantidade;
    public $tipo;
    public $valor;
    public $parcelas;
    public $valorparcela;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

        // Função para buscar
        public function listar(){
            $query = "select 
            pe.idpedido,
            pe.idcli,
            pe.datapedido,
            pr.nomeproduto,
            pr.preco,
            ip.quantidade,
            pg.tipo,
            pg.valor,
            pg.parcelas,
            pg.valorparcela
            from tbpedido pe inner join tbitenspedido ip on pe.idpedido=ip.idpedido
            inner join tbproduto pr on ip.idproduto=pr.idproduto
            inner join tbpagamento pg on pg.idpedido = pe.idpedido
            where pe.idcli=:id";
            
            // Preparando consulta para ser executada
            $stmt = $this->conexao->prepare($query);

            $stmt-> bindParam(":id", $this->idcli);

            $stmt->execute();

            return $stmt;
        }
}
?>