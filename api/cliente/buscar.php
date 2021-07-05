<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/core.php';
include_once '../config/bancodados.php';
include_once '../objetos/cliente.php';

$bancodados = new BancoDados();
$bd = $bancodados->conectaBanco();

$cliente = new Cliente($bd);

$cpf=isset($_GET["cpf"]) ? $_GET["cpf"] : "";
$nome=isset($_GET["nome"]) ? $_GET["nome"] : "";

$sql = $cliente->buscar($cpf, $nome);
$num = $sql->rowCount();

if($num>0){

    $clientes_arr=array();
    $clientes_arr["registros"]=array();

    while ($linha = $sql->fetch(PDO::FETCH_ASSOC)){
        extract($linha);

        $registro_cliente=array(
            "id" => $id,
            "cpf" => $cpf,
            "nome" => utf8_encode($nome),
            "dt_nascimento" => $dt_nascimento,
            "rg" => $rg
        );

        array_push($clientes_arr["registros"], $registro_cliente);
    }

    http_response_code(200);

    $retorno['sucesso'] = true;
    $retorno['mensagem'] = "Clientes encontrados";
    $retorno['dados'] = $clientes_arr;

    echo json_encode($retorno);
}

else{
    http_response_code(404);

    echo json_encode(
        array("message" => "Clientes não encontrados")
    );
}