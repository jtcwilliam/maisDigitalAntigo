<?php



class Pessoa
{




    private $sqlQuery;

    private $id_pessoa;
    private $nome_pessoa;
    private $tipo_pessoa;
    private $status_pessoa;
    private $documento_pessoa;
    private $email_usuario;
    private $unidade;
    private $prefixo_doc;
    private $valida_tipo_cadastro;

    private $confirmaTermo;


    private $senha;
    private $confirme;



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $PdoConn;





    //mexer na conexão para retornar os dados conexao, usuario e senha



    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }




    public function  logarAgendamento($cpf, $senha, $cpfNatural)
    {
        try {


            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("select * from pessoa where documento_pessoa=:cpf  and pwd= :pwd  ");

            $stmt->execute(array(':cpf' => $cpf, ':pwd' => $senha));

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();
            $i = 0;

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;

                $i++;
                session_start();
                $_SESSION['usuariosLogados']['dados'] = $dados;
                $_SESSION['usuariosLogados']['cpfDoUsuario'] = $cpfNatural;

                $_SESSION['usuariosLogados']['condicao'] = true;
            }

            if (empty($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }






    public function  pesquisarCPF($cpf)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("select *, UPPER(\"nome_pessoa\") as \"nome_pessoa\" from pessoa where documento_pessoa=:cpf   ");

            $stmt->execute(array(':cpf' => $cpf));

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();
            $i = 0;

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
                $i++;
            }

            if (empty($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    ///fazer essa classe igual a da backup pessoa

    /*
        $sql = "   INSERT INTO  pessoas ( `nome_pessoa`, `tipo_pessoa`,`status_pessoa`, `documento_pessoa`) 
            VALUES ('" . $this->getnome_pessoa() . "',  '" . $this->gettipo_pessoa() . "', '" . $this->getstatus_pessoa() . "', '" . $this->getdocumento_pessoa() . "');";
*/
    public function  inserirPessoasAgendamento()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("  INSERT INTO  pessoas ( nome_pessoa, tipo_pessoa,status_pessoa, documento_pessoa, prefixo_doc, valida_tipo_cadastro, email_usuario, pwd, termoUso   ) 
            values (:nome_pessoa, :tipo_pessoa, :status_pessoa, :documento_pessoa, :prefixo_doc, :valida_tipo_cadastro,  :email_usuario, :pwd, :termoUso ) ");

            $stmt->bindValue(':nome_pessoa',  $this->getnome_pessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':tipo_pessoa', $this->gettipo_pessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':documento_pessoa', md5($this->getdocumento_pessoa()), PDO::PARAM_STR);
            $stmt->bindValue(':status_pessoa', $this->getstatus_pessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':prefixo_doc', $this->getprefixo_doc(), PDO::PARAM_STR);
            $stmt->bindValue(':valida_tipo_cadastro', $this->getvalida_tipo_cadastro(), PDO::PARAM_STR);
            $stmt->bindValue(':email_usuario', $this->getemail_usuario(), PDO::PARAM_STR);
            $stmt->bindValue(':pwd', $this->getSenha(), PDO::PARAM_STR);
            $stmt->bindValue(':termoUso', $this->getConfirmaTermo(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  inserirFuncionarioPrefs()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("  INSERT INTO  pessoas ( nome_pessoa, tipo_pessoa,status_pessoa, documento_pessoa, email_usuario, unidade, prefixo_doc) 
            values (:nome_pessoa, :tipo_pessoa, :status_pessoa, :documento_pessoa, :email_usuario, :unidade, :prefixo_doc) ");



            $stmt->bindValue(':nome_pessoa',  $this->getnome_pessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':tipo_pessoa', $this->gettipo_pessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':documento_pessoa', md5($this->getdocumento_pessoa()), PDO::PARAM_STR);
            $stmt->bindValue(':status_pessoa', $this->getstatus_pessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':email_usuario', $this->getemail_usuario(), PDO::PARAM_STR);
            $stmt->bindValue(':unidade', $this->getUnidade(), PDO::PARAM_STR);
            $stmt->bindValue(':prefixo_doc', $this->getprefixo_doc(), PDO::PARAM_STR);



            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  alterarSenha()
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  UPDATE  pessoas SET pwd =  :senha  WHERE id_pessoa = :idPessoa   ");

            $stmt->bindValue(':senha',  $this->getSenha(), PDO::PARAM_STR);

            $stmt->bindValue(':idPessoa', $this->getid_pessoa(), PDO::PARAM_STR);

            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  alterarDados()
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  UPDATE  pessoas SET nome_pessoa= :nome,    email_usuario = :email  WHERE id_pessoa = :idPessoa   ");

            $stmt->bindValue(':email',  $this->getemail_usuario(), PDO::PARAM_STR);

            $stmt->bindValue(':nome',  $this->getnome_pessoa(), PDO::PARAM_STR);

            $stmt->bindValue(':idPessoa', $this->getid_pessoa(), PDO::PARAM_STR);

            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }





    public function  logarPessoa()
    {




        try {

            $pdo = $this->getPdoConn();



            $stmt = $pdo->prepare("select  ps.nome_pessoa as nome, un.nome_unidade, st.descricao_status ,
            tp.descricao_tipo_pessoa as tipo_pessoa, ps.pwd, ps.documento_pessoa  as documento_pessoa,  
            ps.*, st.*, tp.*, un.*, ptc.categoria_pessoas from pessoa ps 
            inner join unidade un on ps.unidade = un.id_unidade 
            inner join status st on st.id_status = ps.status_pessoa  
            inner join tipo_pessoa tp on tp.id_tipo_pessoa = ps.tipo_pessoa 
            inner join pessoa_tem_categoria ptc on ptc.pessoas_categoria = ps.id_pessoa
            where email_usuario = '" . $this->getemail_usuario() . "'");

            $stmt->execute();



            $retorno = array();

            $dados = array();



            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
            }

            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
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
     * Get the value of dns
     */
    public function getDns()
    {
        return $this->dns;
    }

    /**
     * Set the value of dns
     *
     * @return  self
     */
    public function setDns($dns)
    {
        $this->dns = $dns;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

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

    /**
     * Get the value of id_unidade
     */

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
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of PdoConn
     */
    public function getPdoConn()
    {
        return $this->PdoConn;
    }

    /**
     * Set the value of PdoConn
     *
     * @return  self
     */
    public function setPdoConn($PdoConn)
    {
        $this->PdoConn = $PdoConn;

        return $this;
    }

    /**
     * Get the value of email_usuario
     */
    public function getemail_usuario()
    {
        return $this->email_usuario;
    }

    /**
     * Set the value of email_usuario
     *
     * @return  self
     */
    public function setemail_usuario($email_usuario)
    {
        $this->email_usuario = $email_usuario;

        return $this;
    }

    /**
     * Get the value of unidade
     */
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * Set the value of unidade
     *
     * @return  self
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get the value of prefixo_doc
     */
    public function getprefixo_doc()
    {
        return $this->prefixo_doc;
    }

    /**
     * Set the value of prefixo_doc
     *
     * @return  self
     */
    public function setprefixo_doc($prefixo_doc)
    {
        $this->prefixo_doc = $prefixo_doc;

        return $this;
    }

    /**
     * Get the value of valida_tipo_cadastro
     */
    public function getvalida_tipo_cadastro()
    {
        return $this->valida_tipo_cadastro;
    }

    /**
     * Set the value of valida_tipo_cadastro
     *
     * @return  self
     */
    public function setvalida_tipo_cadastro($valida_tipo_cadastro)
    {
        $this->valida_tipo_cadastro = $valida_tipo_cadastro;

        return $this;
    }

    /**
     * Get the value of confirmaTermo
     */
    public function getConfirmaTermo()
    {
        return $this->confirmaTermo;
    }

    /**
     * Set the value of confirmaTermo
     *
     * @return  self
     */
    public function setConfirmaTermo($confirmaTermo)
    {
        $this->confirmaTermo = $confirmaTermo;

        return $this;
    }

    /**
     * Get the value of confirme
     */
    public function getConfirme()
    {
        return $this->confirme;
    }

    /**
     * Set the value of confirme
     *
     * @return  self
     */
    public function setConfirme($confirme)
    {
        $this->confirme = $confirme;

        return $this;
    }
}
