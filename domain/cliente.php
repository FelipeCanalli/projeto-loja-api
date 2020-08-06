<?php 
// Esse arquivo é responsável com a comunicação com o banco e a preparação com o banco

class Cliente{
    public $idcli;
    public $nomecli;
    public $cpf;
    public $sexo;
    public $idcontato;
    public $idendereco;
    public $idusuario;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    // Função para listar todos os clientes cadastrados no banco de dados
    public function listar(){
        $query = "select * from tbcliente";

        // Será criada a variável stmt (Statement - Sentença)
        // para guardar a preparação da consulta select que será 
        // executada posteriormente
        $stmt = $this->conexao->prepare($query);

        // Executar a consulta e retornar os dados
        $stmt->execute();
        return $stmt;
    }

    /* -------------------------------------------------------------------------- */

    // Função para cadastrar um cliente no banco de dados
    public function cadastro(){
        $query = "insert into tbcliente set nomecli=:n, cpf=:c, sexo=:s, idcontato=:ic, idendereco=:ie, idusuario=:iu";
        
        $stmt = $this->conexao-> prepare($query);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmt->bindParam(":n", $this->nomecli);
        $stmt->bindParam(":c", $this->cpf);
        $stmt->bindParam(":s", $this->sexo);
        $stmt->bindParam(":ic", $this->idcontato);
        $stmt->bindParam(":ie", $this->idendereco);
        $stmt->bindParam(":iu", $this->idusuario);

        if ($stmt->execute()){
            return true;
        }else{
                return false;
            }
        }

    /* -------------------------------------------------------------------------- */

        // Função para alterar a senha de um usuário no banco de dados
        public function atualizarCliente(){
            $query = " update tbcliente set nomecli=:n, cpf=:c, sexo=:s, idcontato=:ic, idendereco=:ie, idusuario=:iu where idcli=:id";

            $stmt = $this->conexao-> prepare($query);

            // Vamos vincular os dados que vem do app ou navegador com os
            // campos de banco de dados (bind)
            $stmt->bindParam(":n",  $this->nomecli);
            $stmt->bindParam(":c", $this->cpf);
            $stmt->bindParam(":s", $this->sexo);
            $stmt->bindParam(":ic", $this->idcontato);
            $stmt->bindParam(":ie", $this->idendereco);
            $stmt->bindParam(":iu", $this->idusuario);
            $stmt->bindParam(":id", $this->idcli);


            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

    /* -------------------------------------------------------------------------- */

        // Função para apagar um usuário do banco de dados
        public function apagarCliente(){
            $query = "delete from tbcliente where idcli=:id";
        
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
