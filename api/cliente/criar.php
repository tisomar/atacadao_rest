<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/bancodados.php';
include_once '../objetos/cliente.php';

$bancodados = new BancoDados();
$bd = $bancodados->conectaBanco();

$cliente = new Cliente($bd);

$dados = json_decode(file_get_contents("php://input"));

if(
    !empty($dados->cpf) &&
    !empty($dados->nome) &&
    !empty($dados->dt_nascimento) &&
    !empty($dados->rg)
){

    $cliente->cpf = $dados->cpf;
    $cliente->nome = $dados->nome;
    $cliente->dt_nascimento = date('Y-m-d H:i:s');
    $cliente->rg = $dados->rg;

    $existe_cpf = $cliente->lerCPF($cliente->cpf);


    if(!empty($existe_cpf)){

        $cliente->id = $existe_cpf['id'];
        $cliente->atualizar();
        $cliente = $cliente->lerCPF($cliente->cpf);
        http_response_code(200);

        $retorno['sucesso'] = true;
        $retorno['mensagem'] = "Cliente atualizado.";
        $retorno['dados'] = $cliente;

        echo json_encode($retorno);
        return;
    }{

        if($cliente->criar()){
            $cliente = $cliente->lerCPF($cliente->cpf);
            http_response_code(201);
            $retorno['sucesso'] = true;
            $retorno['mensagem'] = "Cliente criado.";
            $retorno['dados'] = $cliente;
            echo json_encode($retorno);
            return;
        }

        else{
            http_response_code(503);

            echo json_encode(array("message" => "Não foi possível criar o cliente."));
            return;
        }
    }

}

else{

    http_response_code(400);

    echo json_encode(array("message" => "Não foi possível atualizar o cliente. Dados incompletos"));
}