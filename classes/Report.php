<?php



class Report
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $id_pessoa;
    private $idStatus;
    private $idAgendamento;
    private $id_unidade;
    private $idTipoAgendamento;
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
 
/* select date_format(dia,'%Y-%m-%d' ) as 'dataformatada' ,date_format(dia, '%d/%m/%Y'), count(idAgendamento), st.descricaoStatus, un.nomeUnidade  from agendamento ag
                                        inner join status st on ag.idStatus = st.idStatus  inner join unidade un on ag.id_unidade = un.id_unidade
                                          where dia between  :dataInicial  and  :dataFinal  
                                        group by  date_format(dia, '%d/%m/%Y'),  st.descricaoStatus, un.nomeUnidade   order by dia
                                        */
 


    //metodo que retorna o agendamento da pessoa a partir do clique dela no agendamento clicado
    public function  agendasEmGeral($dataInicial, $dataFinal)
    {
        try {
            


            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("select nome_unidade, descricao_status,  count(ag.id_agendamento)  as 'qtde'  
             from agendamento ag inner join status st on ag.id_status = st.id_status 
             inner join unidade un on ag.id_unidade = un.id_unidade  where dia between :dataInicial  and  :dataFinal   
               group by   nome_unidade , descricao_status  order by   nome_unidade ");
                                        

            $stmt->execute(array(':dataInicial' => $dataInicial,  ':dataFinal' => $dataFinal,   ));



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
             
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  consultaDia($dataInicial)
    {
        try {
            


            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select date_format(dia, '%d/%m/%Y') as datas , count(ag.id_agendamento)  as 'qtde',  st.descricao_status  as descricao
                  from agendamento ag inner join status st on ag.id_status = st.id_status  inner join unidade un on ag.id_unidade = un.id_unidade
                                          	  where date_format(dia,'%Y-%m-%d' )=   :dataInicial   
                                          group by date_format(dia, '%d/%m/%Y') , descricao, nome_unidade order by descricao,  dia asc ");
                                        

            $stmt->execute(array(':dataInicial' => $dataInicial  ));



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

            $sql = "UPDATE agendamento SET id_pessoa = :idPessoa , id_status = :idStatus ,  id_unidade= :id_unidade, id_tipo_agendamento= :idTipoAgendamento    where id_agendamento= :idAgendamento  ";


            $data = [
                ':idPessoa' =>      $this->getid_pessoa(),
                ':idStatus' =>       $this->getIdStatus(),
                ':idAgendamento' =>  $this->getIdAgendamento(),
                ':id_unidade' => $this->getid_unidade(),
                ':idTipoAgendamento' => $this->getIdTipoAgendamento()

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
     * Get the value of idStatus
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    /**
     * Set the value of idStatus
     *
     * @return  self
     */
    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    /**
     * Get the value of idAgendamento
     */
    public function getIdAgendamento()
    {
        return $this->idAgendamento;
    }

    /**
     * Set the value of idAgendamento
     *
     * @return  self
     */
    public function setIdAgendamento($idAgendamento)
    {
        $this->idAgendamento = $idAgendamento;

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
     * Get the value of idTipoAgendamento
     */
    public function getIdTipoAgendamento()
    {
        return $this->idTipoAgendamento;
    }

    /**
     * Set the value of idTipoAgendamento
     *
     * @return  self
     */
    public function setIdTipoAgendamento($idTipoAgendamento)
    {
        $this->idTipoAgendamento = $idTipoAgendamento;

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
