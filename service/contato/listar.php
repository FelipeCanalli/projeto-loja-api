<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/contato.php";

$database = new Database();
$db = $database->getConnection();
$contato= new Contato($db);

$rs = $contato->listar();

if($rs->rowCount()>0){
    $contato_arry["saida"] = array();

    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){  
    extract($linha);
    $array_item = array(    
        "idcontato"=>$idcontato,
        "email"=>$email,
        "telefone"=>$telefone,
    );
    array_push($contato_arry["saida"],$array_item);
    }
    header("HTTP/1.0 200");
    echo json_encode($contato_arry);
}else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há nenhum contato cadastrado"));
}
?>
