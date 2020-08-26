<?php 
class Cadastro{
    // cliente 
    public $idcli;
    public $nomecli;
    public $cpf;
    public $sexo;
    public $idcontato;
    public $idendereco;
    public $idusuario;
    // contato
    public $email;
    public $telefone;
    // endereeco 
    public $tipo;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;
    // usuário
    public $nomeusuario;
    public $senha;
    public $foto;

    public function __construct($db){
        $this->conexao = $db;
    }

/* -------------------------------------------------------------------------- */
// Cadastro -> Usuário

    public function cadastro(){
        $query = "insert into tbusuario set nomeusuario=:l, senha=:s, foto=:f";
        
        $stmtu = $this->conexao->prepare($query);

        // Encriptografar a senha com o uso de md5
        $this->senha = md5($this->senha);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmtu->bindParam(":l", $this->nomeusuario);
        $stmtu->bindParam(":s", $this->senha);
        $stmtu->bindParam(":f", $this->foto);

        // vamos executar a consulta para realizar o cadastro na tabela usuario
        $stmtu->execute();
        // vamos obter o id gerado neste cadastro e colocar dentro da váriavel idusuario
        $this->idusuario = $this->conexao->lastInsertId();

/* -------------------------------------------------------------------------- */
// Cadastro -> Contato

        $query = "insert into tbcontato set email=:e, telefone=:t";
    
        //Prepare a $query
        $stmtc = $this->conexao-> prepare($query);

        // Vinculando os dados
        $stmtc->bindParam(":e", $this->email);
        $stmtc->bindParam(":t", $this->telefone);

        $stmtc->execute();
        $this->idcontato = $this->conexao->lastInsertId();

/* -------------------------------------------------------------------------- */
// Cadastro -> Endereço

        $query = "insert into tbendereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:cep";
    
        //Prepare a $query
        $stmte = $this->conexao-> prepare($query);

        // Vinculando os dados
        $stmte->bindParam(":t", $this->tipo);
        $stmte->bindParam(":l", $this->logradouro);
        $stmte->bindParam(":n", $this->numero);
        $stmte->bindParam(":c", $this->complemento);
        $stmte->bindParam(":b", $this->bairro);
        $stmte->bindParam(":cep", $this->cep);

        $stmte->execute();
        $this->idendereco = $this->conexao->lastInsertId();

/* -------------------------------------------------------------------------- */
// E por último por conta dos id, cadastro do cliente

        $query = "insert into tbcliente set nomecli=:n, cpf=:c, sexo=:s, idcontato=:ic, idendereco=:ie, idusuario=:iu";
        
        $stmt = $this->conexao->prepare($query);

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
}
?>
