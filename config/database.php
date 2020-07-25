<?php

/*
A classe Database irá permitir a comunicação com o banco de dados.

Nesta classe teremos a string de conexão com o banco, bem como:
- Nome de usuário: "root"
- Senha "" -> vazio
- Banco de dados: dbloja
- Porta de comunicação: 3306
- Servidor: localhost (poderia ser o domínio)


E uma variável para a conexão com o banco de que será usada em outros arquivos. Portanto
essa variável deve ser pública.
*/

class Database{
    public $conexao;    // variavel de comunicação

    public function getConnection(){
        try{
            $conexao = new PDO("mysql:host=localhost;port=3306;dbname=dbloja","root","");

            // definir o tipo de caracter para o banco de dados no formato de utf8 para aceitar acentuação
            
            $conexao->exec("set name utf8");
        }
        catch(PDOExeception $e){
            echo "Erro ao estabelecer a conexão com o banco. "+$e->getMessage();
        }
        return $conexao;
    }
}
?>
