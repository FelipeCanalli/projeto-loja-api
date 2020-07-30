<?php

class Foto{
    public $idfoto;
    public $foto1;
    public $foto2;
    public $foto3;
    public $foto4;

    // Iniciando o banco de dados 
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    public function listar(){
        $query = " select * from tbfoto ";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
?>   
