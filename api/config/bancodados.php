<?php
class BancoDados{

    private $servidor = "35.197.112.231";
    private $nome_bd = "atacadao";
    private $nome_usuario = "atacadao";
    private $senha = "atacadao";
    public $conexao;

    public function conectaBanco(){

        $this->conexao = null;

        try{
            $this->conexao = new PDO("mysql:host=" . $this->servidor . ";dbname=" . $this->nome_bd, $this->nome_usuario, $this->senha);
            $this->conexao->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conexao;
    }
}
