<?php

class Produto{
    public $idproduto;
    public $nomeproduto;
    public $descricao;
    public $preco;
    public $idfoto;

    // Iniciando o banco de dados 
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    public function listar(){
        $query = " select * from tbproduto ";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function detalheProduto($id){
        $query= "select p.idproduto, p.nomeproduto, p.descricao, p.preco, f.foto1,f.foto2, f.foto3, f.foto4
        from tbproduto p inner join tbfoto f on p.idfoto=f.idfoto where idproduto=:id";
        
        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt;
    }

    /* -------------------------------------------------------------------------- */
    public function listarTelaInicial(){
        $query= "select p.idproduto, p.nomeproduto, p.preco, f.foto1 from tbproduto p inner join tbfoto f on p.idfoto=f.idfoto;";
        
        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
?>   
