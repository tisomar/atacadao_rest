<?php
class Cliente{

    private $conexao;
    private $nome_tabela = "tbl_clientes";

    public $id;
    public $cpf;
    public $nome;
    public $dt_nascimento;
    public $rg;

    public function __construct($bd){
        $this->conexao = $bd;
    }

    function criar(){

        $consulta = "INSERT INTO
                " . $this->nome_tabela . "
            SET
                cpf=:cpf, nome=:nome, dt_nascimento=:dt_nascimento, rg=:rg";

        $sql = $this->conexao->prepare($consulta);

        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->dt_nascimento=htmlspecialchars(strip_tags($this->dt_nascimento));
        $this->rg=htmlspecialchars(strip_tags($this->rg));

        $sql->bindParam(":cpf", $this->cpf);
        $sql->bindParam(":nome", $this->nome);
        $sql->bindParam(":dt_nascimento", $this->dt_nascimento);
        $sql->bindParam(":rg", $this->rg);

        if($sql->execute()){
            return true;
        }

        return false;

    }

    function atualizar(){

        $consulta = "UPDATE
                " . $this->nome_tabela . "
            SET
                cpf = :cpf,
                nome = :nome,
                dt_nascimento = :dt_nascimento,
                rg = :rg
            WHERE
                id = :id";

        $sql = $this->conexao->prepare($consulta);

        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->dt_nascimento=htmlspecialchars(strip_tags($this->dt_nascimento));
        $this->rg=htmlspecialchars(strip_tags($this->rg));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $sql->bindParam(':cpf', $this->cpf);
        $sql->bindParam(':nome', $this->nome);
        $sql->bindParam(':dt_nascimento', $this->dt_nascimento);
        $sql->bindParam(':rg', $this->rg);
        $sql->bindParam(':id', $this->id);

        if($sql->execute()){
            return true;
        }

        return false;
    }

    function buscar($cpf, $nome){

        $consulta = "SELECT id, cpf, nome, dt_nascimento, rg
            FROM
                " . $this->nome_tabela . " c
            WHERE
                c.cpf = ? OR c.nome LIKE ?";

        $sql = $this->conexao->prepare($consulta);
        $nome=htmlspecialchars(strip_tags($nome));
        $nome = "%{$nome}%";
        if(!empty($cpf)){
            $sql->bindParam(1, $cpf);
        }
        if(!empty($nome)){
            $sql->bindParam(2, $nome);
        }

        $sql->execute();

        return $sql;
    }

    function lerCPF($cpf){

        $consulta = "SELECT id, cpf, nome, dt_nascimento, rg
            FROM
                " . $this->nome_tabela . " c
            WHERE
                c.cpf = ?";

        $sql = $this->conexao->prepare($consulta);

        $sql->bindParam(1, $cpf);

        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

}