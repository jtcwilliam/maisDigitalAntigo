<?php



class Agendamento
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $id_pessoa;
    private $id_status;
    private $id_agendamento;
    private $id_unidade;
    private $id_tipo_agendamento;
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
 


    /*

    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');


        //  $dsn = 'mysql:dbname=dbagenddev;host=dbagenddev.mysql.dbaas.com.br';



        //chamar o metdo conectar
        $banco = $objConectar->Conectar();

        $dns = 'mysql:dbname=' . $objConectar->getDb() . ';host=' . $objConectar->getHost();

        //criar uma instancia dessa nova conexao
        $this->setConexao($banco);

        $this->setDns($dns);

        $this->setUser($objConectar->getUser());

        $this->setPwd($objConectar->getPwd());
    }

    */






    //metodo que retorna o agendamento da pessoa a partir do clique dela no agendamento clicado
    public function  verificarAgendamentoParaBaixaADM_pesquisa($docPessoa, $id_agendamento)
    {
        try {
            

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" SELECT  *, date_format(dia, '%H:00') as hora ,date_format(dia, '%d/%m/%Y') as dia from agendamento ag 
            left join pessoa ps on ps.id_pessoa = ag.idPessoa left join unidade un on ag.id_unidade = un.id_unidade
                                    inner join tipo_agendamento ta on ag.id_tipo_agendamento = ta.id_tipo_agendamento
                                     where   ps.documento_pessoa = :docPessoa  and ag.id_agendamento=:id_agendamento          and id_status in(3,8)  order by  date_format(dia, '%d/%m/%Y') asc ");

            $stmt->execute(array(':docPessoa' => $docPessoa, ':id_agendamento' => $id_agendamento ));



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    public function  retornarPessoaParaCheckIn($dado)
    {
        try {
            
            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" SELECT  *,  date_format(dia, '%H:00') as hora  ,date_format(dia, '%d/%m/%Y') as dia from agendamento ag left join pessoa ps on ps.id_pessoa = ag.id_pessoa 
            left join unidade un on ag.id_unidade = un.id_unidade
                                        where  ( ps.documento_pessoa = :docPessoa )  and id_status in(3,8)  order by  date_format(dia, '%d/%m/%Y') asc ");

            $stmt->execute(array(':docPessoa' => md5($dado)));



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    //metodo que retorna os agendamentos de cada dia em 1 unidade (visivel para responsavel da unidade e o gestor da rede (super usuaario))
    public function  verificarAgendamentoParaBaixaADM($dado)
    {
        try {
            
            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" SELECT  *,  date_format(dia, '%H:00') as hora  ,date_format(dia, '%d/%m/%Y') as dia from agendamento ag left join pessoa ps on ps.id_pessoa = ag.idPessoa left join unidade un on ag.id_unidade = un.id_unidade
                                        where  ( ps.documento_pessoa = :docPessoa || id_agendamento = :docPessoa )   and id_status in(3,8)  order by  date_format(dia, '%d/%m/%Y') asc ");

            $stmt->execute(array(':docPessoa' => md5($dado)));



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //metodo que retorna os agendamentos de cada dia em 1 unidade (visivel para responsavel da unidade e o gestor da rede (super usuaario))
    public function  verificarTodosAgendamentosUnidadeAdmDeUnidade($id_unidade, $datas)
    {
        try {
          
          
            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" SELECT  *,  date_format(dia, '%H:%i') as 'horas' from agendamento ag left join pessoa ps on ps.id_pessoa = ag.idPessoa left join unidade un on ag.id_unidade = un.id_unidade 
            inner join tipo_agendamento ta on ta.id_tipo_agendamento = ag.id_tipo_agendamento inner join status st on st.id_status = ag.id_status 
                                    where date_format(dia, '%d/%m/%Y') =  :diaAgendamento  and ag.id_unidade = :id_unidade  and ag.id_status in(3,6,7, 8) order  by  ag.id_status asc,  date_format(dia, '%H:%i  %d/%m/%Y')  asc  ");

            $stmt->execute(array('id_unidade' => $id_unidade, ':diaAgendamento' => $datas));


            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


 




    public function  verificarAgendamentosUnidadeData($id_unidade, $datas)
    {
        try {
            
            $pdo = $this->getPdoConn();

            

            $stmt = $pdo->prepare(" SELECT  count(ag.id_status) as qtde, ag.id_status, st.descricaoStatus from agendamento  ag inner join status st on ag.id_status = st.id_status  
            where   date_format(dia, '%d/%m/%Y')  = :diaAgendamento  and  id_unidade = :id_unidade  and ag.id_status in(7,3)  group by id_status order by ag.id_status asc  ");

            $stmt->execute(array('id_unidade' => $id_unidade, ':diaAgendamento' => $datas));


            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }







    public function  verificarAgendamentosAtivos($idPessoa, $id_status)
    {
        try {

            $pdo = $this->getPdoConn();

            //2025-04-23

            $stmt = $pdo->prepare(" SELECT *,  date_format(dia, '%Y-%m-%d') as diaComparar ,  date_format(dia, '%H:%i do dia  %d/%m/%Y')   as dia from agendamento ag 
            inner join pessoa ps on ps.id_pessoa = ag.idpessoa inner join
             unidade un on un.id_unidade = ag.id_unidade  where id_pessoa = :id_pessoa and ag.id_status = :id_status order by ag.dia asc  ");
            $stmt->execute(array('id_pessoa' => $idPessoa, 'id_status' => $id_status));
            $datasDisponiveis = $stmt->fetchAll();
            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  registrarAgendamentoUsuario()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE agendamento SET id_pessoa = :idPessoa , id_status = :id_status ,  id_unidade= :id_unidade, id_tipo_agendamento= :id_tipo_agendamento  
              where id_agendamento= :id_agendamento  ";


            $data = [
                ':idPessoa' =>      $this->getid_pessoa(),
                ':id_status' =>       $this->getIdStatus(),
                ':id_agendamento' =>  $this->getIdAgendamento(),
                ':id_unidade' => $this->getid_unidade(),
                ':id_tipo_agendamento' => $this->getIdTipoAgendamento()

            ];

            $stmt = $pdo->prepare($sql);



            if ($stmt->execute($data)) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  mudarStatusoAgendamentoPeloAdm()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE agendamento SET  id_status = :id_status     where id_agendamento= :id_agendamento  ";


            $data = [

                ':id_status' =>       $this->getIdStatus(),
                ':id_agendamento' =>  $this->getIdAgendamento(),


            ];

            $stmt = $pdo->prepare($sql);



            if ($stmt->execute($data)) {
                return true;
            }
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
     * Get the value of id_status
     */
    public function getIdStatus()
    {
        return $this->id_status;
    }

    /**
     * Set the value of id_status
     *
     * @return  self
     */
    public function setIdStatus($id_status)
    {
        $this->id_status = $id_status;

        return $this;
    }

    /**
     * Get the value of id_agendamento
     */
    public function getIdAgendamento()
    {
        return $this->id_agendamento;
    }

    /**
     * Set the value of id_agendamento
     *
     * @return  self
     */
    public function setIdAgendamento($id_agendamento)
    {
        $this->id_agendamento = $id_agendamento;

        return $this;
    }

    /**
     * Get the value of unidade
     */


    /**
     * Get the value of id_unidade
     */
    public function getid_unidade()
    {
        return $this->id_unidade;
    }

    /**
     * Set the value of id_unidade
     *
     * @return  self
     */
    public function setid_unidade($id_unidade)
    {
        $this->id_unidade = $id_unidade;

        return $this;
    }

    /**
     * Get the value of id_tipo_agendamento
     */
    public function getIdTipoAgendamento()
    {
        return $this->id_tipo_agendamento;
    }

    /**
     * Set the value of id_tipo_agendamento
     *
     * @return  self
     */
    public function setIdTipoAgendamento($id_tipo_agendamento)
    {
        $this->id_tipo_agendamento = $id_tipo_agendamento;

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
}
