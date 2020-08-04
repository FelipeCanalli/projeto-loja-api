<?php

class Login{
    public $idusuario;
    public $nomeusuario;
    public $foto;
    public $nomecli;
    public $cpf;
    public $sexo;
    public $email;
    public $telefone;
    public $tipo;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

        // Função para buscar o usuário no banco
        public function login(){
            $query = "select 
            us.idusuario,
            us.nomeusuario,
            us.foto,
            cl.nomecli,
            cl.cpf,
            cl.sexo,
            ct.email,
            ct.telefone,
            en.tipo,
            en.logradouro,
            en.numero,
            en.complemento,
            en.bairro,
            en.cep
            from tbusuario us inner join tbcliente cl on us.idusuario=cl.idusuario
            inner join tbcontato ct on ct.idcontato=cl.idcontato
            inner join tbendereco en on en.idendereco=cl.idendereco
            where us.nomeusuario=:n and us.senha=:s; ";
            
            // Preparando consulta para ser executada
            $stmt = $this->conexao->prepare($query);

            $this->senha = md5($this->senha);

            $stmt-> bindParam(":n", $this->nomeusuario);
            $stmt-> bindParam(":s", $this->senha);

            $stmt->execute();

            return $stmt;
        }
}
?>