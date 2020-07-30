<?php

// Vamos construir os cabeçalhos para trabalho com a api
header("Acess-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

/*
    Para efetuar excluir de dados no banco é preciso 
    informar a api que essa ação irá ocorrer com o método
    DELETE, que é responsável pela exclusão de dados da api
*/

header("Access-Control-Allow-Methods:DELETE");

include_once "../../config/database.php";

include_once "../../domain/usuario.php";

$database = new Database();
$db = $database->getConnection();   
$usuario = new Usuario($db);

/*
    O cliente irá enviar os dados no formato Json. Porém
    nós precisamos dos dados no formato php para cadastrar
    em banco de dados.
    Para realizar essa conversão iremos usar o comando json_decode.
    Assim o cliente envia os dados e estes serão convertidos para php.
*/

$data = json_decode(file_get_contents("php://input"));

// Verificando se os dados vindos do usuário estão preenchidos
if(!empty($data->idusuario)){
    $usuario->idusuario = $data->idusuario;

    if($usuario->apagarUsuario()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"Usuário apagado com sucesso"));

    }else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível apagar o usuário"));
    }

    }else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
    }
?>
