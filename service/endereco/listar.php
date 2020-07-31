<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";
include_once "../../domain/endereco.php";

$database = new Database();
$db = $database->getConnection();
$endereco= new Endereco($db);

$rs = $endereco->listar();

if($rs->rowCount()>0){
    $endereco_arry["saida"] = array();

    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){  
    extract($linha);
    $array_item = array(    
        "idendereco"=>$idendereco,
        "tipo"=>$tipo,
        "logradouro"=>$logradouro,
        "numero"=>$numero,
        "complemento"=>$complemento,
        "bairro"=>$bairro,
        "cep"=>$cep
    );
    array_push($endereco_arry["saida"],$array_item);
    }
    header("HTTP/1.0 200");
    echo json_encode($endereco_arry);
}else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há fotos cadastradas"));
}
?>
