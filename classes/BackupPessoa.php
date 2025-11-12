<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



class Pessoa_____
{



    private $conexao;

    private $sqlQuery;

    private $id_pessoa;
    private $nome_pessoa;
    private $tipo_pessoa;
    private $status_pessoa;
    private $documento_pessoa;
    private $pwd;




    function __construct()
    {
        include_once 'Conexao.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $banco = $objConectar->Conectar();

        //criar uma instancia dessa nova conexao
        $this->setConexao($banco);
    }



    function getConexao()
    {
        return $this->conexao;
    }



    function setConexao($conexao)
    {
        $this->conexao = $conexao;
    }

    /**
     * Get the value of sqlQuery
     */
    public function getSqlQuery()
    {
        return $this->sqlQuery;
    }

    /**
     * Set the value of sqlQuery
     *
     * @return  self
     */
    public function setSqlQuery($sqlQuery)
    {
        $this->sqlQuery = $sqlQuery;

        return $this;
    }

    public function  logarPessoa()
    {

        $sql = "select  ps.nome_pessoa as 'nome', un.nomeUnidade as 'nomeUnidade', st.descricaoStatus as 'descricaoStatus' , 
        tp.descricaotipo_pessoa as 'tipo_pessoa', ps.pwd, ps.documento_pessoa  as 'documento_pessoa',  ps.*, st.*, tp.*, un.*
        from pessoas ps 
        inner join unidade un on un.responsavelUnidade = ps.id_pessoa  
        inner join status st on st.idStatus = ps.status_pessoa 
        inner join tipo_pessoa tp on tp.idtipo_pessoa = ps.tipo_pessoa
         where documento_pessoa = '" . $this->getdocumento_pessoa() . "'  and pwd= '" . $this->getPwd() . "' ";

        $executar = mysqli_query($this->getConexao(), $sql);

        $retorno = array();

        while ($row = mysqli_fetch_assoc($executar)) {
            $dados[] = $row;
            $retorno['condicao'] = true;
            $retorno['dados'] = $dados;
        }
        if (!isset($dados)) {
            $retorno['condicao'] = false;
        }

        return $retorno;
    }

    public function  pesquisarCPF($cpf)
    {
        $sql = "select * from pessoas where documento_pessoa = '" . $cpf . "'";


        $executar = mysqli_query($this->getConexao(), $sql);

        $retorno = array();

        while ($row = mysqli_fetch_assoc($executar)) {
            $dados[] = $row;
            $retorno['condicao'] = true;
            $retorno['dados'] = $dados;
            
        }
        if (!isset($dados)) {
            $retorno['condicao'] = false;
        }

        return $retorno;
    }

    public function   inserirPessoasAgendamento()
    {
        try {

            $sql = "   INSERT INTO  pessoas ( `nome_pessoa`, `tipo_pessoa`,`status_pessoa`, `documento_pessoa`) 
            VALUES ('" . $this->getnome_pessoa() . "', '" . $this->gettipo_pessoa() . "', '" . $this->getstatus_pessoa() . "', '" . $this->getdocumento_pessoa() . "');";



            $executar = mysqli_query($this->getConexao(), $sql);

            if ($executar == true) {

                return true;
            } else {

                return false;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Get the value of id_pessoa
     */
    public function getid_pessoa()
    {
        return $this->id_pessoa;
    }

    /**
     * Set the value of id_pessoa
     *
     * @return  self
     */
    public function setid_pessoa($id_pessoa)
    {
        $this->id_pessoa = $id_pessoa;

        return $this;
    }

    /**
     * Get the value of nome_pessoa
     */
    public function getnome_pessoa()
    {
        return $this->nome_pessoa;
    }

    /**
     * Set the value of nome_pessoa
     *
     * @return  self
     */
    public function setnome_pessoa($nome_pessoa)
    {
        $this->nome_pessoa = $nome_pessoa;

        return $this;
    }

    /**
     * Get the value of tipo_pessoa
     */
    public function gettipo_pessoa()
    {
        return $this->tipo_pessoa;
    }

    /**
     * Set the value of tipo_pessoa
     *
     * @return  self
     */
    public function settipo_pessoa($tipo_pessoa)
    {
        $this->tipo_pessoa = $tipo_pessoa;

        return $this;
    }

    /**
     * Get the value of status_pessoa
     */
    public function getstatus_pessoa()
    {
        return $this->status_pessoa;
    }

    /**
     * Set the value of status_pessoa
     *
     * @return  self
     */
    public function setstatus_pessoa($status_pessoa)
    {
        $this->status_pessoa = $status_pessoa;

        return $this;
    }

    /**
     * Get the value of documento_pessoa
     */
    public function getdocumento_pessoa()
    {
        return $this->documento_pessoa;
    }

    /**
     * Set the value of documento_pessoa
     *
     * @return  self
     */
    public function setdocumento_pessoa($documento_pessoa)
    {
        $this->documento_pessoa = $documento_pessoa;

        return $this;
    }

    /**
     * Get the value of pwd
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }
}
