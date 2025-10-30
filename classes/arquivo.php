<?php



class Arquivo
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $arquivo;

    private $pdoConn;
    private $idArquivo;
    private $nomeArquivo;
    private $tipoArquivo;
    private $idSolicitacao;
    private $statusArquivo;
    private $estiloArquivo;
    private $idTipoDocumento;
    private $codigoTrocaArquivo;
    private $assinadoDigital;

    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }


    public function  consultarListaAquivosNecessarios($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select * from servicoDocumento sd inner join documentos dc on dc.idDoc = sd.idDocumento
                                where idServico in(
                                select 
                                assuntoSolicitacao from solicitacao sl inner join linkCartaServico lcs on sl.assuntoSolicitacao = lcs.idlinkCartaServico
                                where idsolicitacao =  " . $idSolicitacao . ")");

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  consultarDadosArquivosParaInfo($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select  idArquivo ,nomeArquivo, tipoArquivo, idTipoDocumento, statusArquivo  from arquivos where idsolicitacao =" . $idSolicitacao);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  consultaArquivosParaComuniquese($idSolicitacao, $idTipoDocumento)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select  idArquivo ,nomeArquivo, tipoArquivo, idTipoDocumento, statusArquivo, st.descricaoStatus, assinadoDigital 
             from arquivos ar inner join status st on ar.statusArquivo = st.idStatus  where idsolicitacao =" . $idSolicitacao . " 
               and  idTipoDocumento=" . $idTipoDocumento);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  dadosArquivoSolicitante($idArquivo)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select  ar.idArquivo ,sl.solicitante, ps.nomePessoa ,  nomeArquivo from solicitacao sl inner join pessoas ps on ps.idPessoas = sl.solicitante 
 INNER join arquivos ar on ar.idSolicitacao  = sl.idsolicitacao where ar.idArquivo =" . $idArquivo);


            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    public function  gerarArquivo($idArquivo)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select arquivo, nomeArquivo, tipoArquivo  from arquivos where idarquivo =" . $idArquivo);


            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  solicitarArquivoRelatorio($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select lc.descricaoCarta,  sl.descricaoSolicitacao  ,lc.nomeSecretaria, sl.solicitante,
             sl.tipoDocumento, sl.documentoPublico,  nomeArquivo, tipoArquivo, ar.arquivo, 
 dc.descricaoDoc, ps.nomePessoa, ps.emailUsuario, sl.docSolicitacaoPessoal, sl.assuntoSolicitacao,  sl.cepSolicitacao   ,  sl.logradouroSol    ,  sl.numeroSol,
  sl.complemento, sl.bairro , sl.representaTerceiro    ,    sl.nomeTerceiro,  sl.documentoTerceiro , sl.emailTerceiro, sl.telefoneTerceiro , 
  date_format(dataSolicitacao, '%d ' ) as 'dias', 

  date_format(dataSolicitacao, '%M' ) as 'mes', 

  date_format(dataSolicitacao, ' de %Y ' ) as 'ano', sl.assinaturaSolicitacao, sl.assinaturaTerceiro, sl.nomeTerceiro  
 
 
  from solicitacao sl inner join  linkCartaServico lc on lc.idlinkCartaServico = sl.assuntoSolicitacao 
 inner join documentos dc on dc.idDoc = sl.tipoDocumento inner join pessoas ps on ps.idPessoas = sl.solicitante 
 INNER join arquivos ar on ar.idSolicitacao  = sl.idsolicitacao where sl.idsolicitacao =" . $idSolicitacao);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  consultarArquivoParaSolicitacao($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select   nomeArquivo, tipoArquivo, arquivo from arquivos where idsolicitacao =" . $idSolicitacao);

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  consultarArquivoParaSolicitacaoRelatorio($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select   nomeArquivo, tipoArquivo, arquivo from arquivos where  assinadoDigital !=1 and  idsolicitacao =" . $idSolicitacao);

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  consultarArquivoParaSolicitacaoTeste($idArquivo)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select   nomeArquivo, tipoArquivo, arquivo from arquivos where idArquivo =" . $idArquivo);

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  consultarQuantidadeArquivo($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select arquivo from arquivos where idSolicitacao =" . $idSolicitacao);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  inserirArquivos()
    {
        try {


            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $arquivo =   $this->getArquivo();
            $arquivoTipo = $this->getTipoArquivo();
            $nomeArquivo = $this->getNomeArquivo();
            $idSolicitacao = $this->getIdSolicitacao();
            $statusArquivo = $this->getStatusArquivo();
            $idTipoDocumento = $this->getIdTipoDocumento();
            $assinadoDigital = $this->getAssinadoDigital();



            $stmt = $pdo->prepare("  INSERT INTO  arquivos ( arquivo, tipoArquivo, nomeArquivo, idSolicitacao, statusArquivo, idTipoDocumento,assinadoDigital    )   values (?,?,?,?,?, ?,?) ");


            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $arquivoTipo, PDO::PARAM_LOB);
            $stmt->bindParam(3,  $nomeArquivo, PDO::PARAM_LOB);
            $stmt->bindParam(4,  $idSolicitacao, PDO::PARAM_LOB);
            $stmt->bindParam(5,  $statusArquivo, PDO::PARAM_LOB);
            $stmt->bindParam(6,  $idTipoDocumento, PDO::PARAM_LOB);
            $stmt->bindParam(7,  $assinadoDigital, PDO::PARAM_LOB);






            if ($stmt->execute()) {

                $last = $pdo->prepare(" SELECT LAST_INSERT_ID()");

                $last->execute();

                $ultimoId = $last->fetchAll();


                return json_encode(array('ultimoID' => $ultimoId, 'retorno' => true));


                //return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  apagarArquivo()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $idArquivo =   $this->getIdArquivo();





            $stmt = $pdo->prepare("  UPDATE arquivos set   statusArquivo=13  where idArquivo = ? ");


            //corrigir isto aqui
            $stmt->bindParam(1,  $idArquivo, PDO::PARAM_LOB);



            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  informarAssinatura()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $idArquivo =   $this->getIdArquivo();
            $assinadoDigital = $this->getAssinadoDigital();






            $stmt = $pdo->prepare("  UPDATE arquivos set assinadoDigital = ?   where idArquivo = ? ");

            //corrigir isto aqui

            $stmt->bindParam(1,  $assinadoDigital, PDO::PARAM_INT);
            $stmt->bindParam(2,  $idArquivo, PDO::PARAM_INT);



            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  atualizarAquivoSolicitacao()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $idArquivo =   $this->getIdArquivo();
            $arquivo = $this->getArquivo();
            $tipoArquivo = $this->getTipoArquivo();

            $stmt = $pdo->prepare("  UPDATE arquivos set arquivo = ?, tipoArquivo=?,  statusArquivo='1' where idArquivo = ?;
             Update log set statusLog=1 where idArquivo =?  ");



            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $tipoArquivo, PDO::PARAM_STR);
            $stmt->bindParam(3,  $idArquivo, PDO::PARAM_INT);
            $stmt->bindParam(4,  $idArquivo, PDO::PARAM_INT);

            if ($stmt->execute()) {


                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  atualizarAquivoSolicitacaoSolicitadoComuniqueSe()
    {
        try {



            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $arquivo = $this->getArquivo();
            $tipoArquivo = $this->getTipoArquivo();
            $idtipoDocumento = $this->getIdTipoDocumento();
            $idTrocaArquivo = $this->getCodigoTrocaArquivo();

            $stmt = $pdo->prepare("  UPDATE arquivos set arquivo = ?, tipoArquivo=?, idTipoDocumento=?, statusArquivo='1'  where tipoArquivo = ?");





            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $tipoArquivo, PDO::PARAM_STR);
            $stmt->bindParam(3,  $idtipoDocumento, PDO::PARAM_INT);
            $stmt->bindParam(4,  $idTrocaArquivo, PDO::PARAM_STR);

            if ($stmt->execute()) {
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
     * Get the value of pdoConn
     */
    public function getPdoConn()
    {
        return $this->pdoConn;
    }

    /**
     * Set the value of pdoConn
     *
     * @return  self
     */
    public function setPdoConn($pdoConn)
    {
        $this->pdoConn = $pdoConn;

        return $this;
    }

    /**
     * Get the value of arquivo
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set the value of arquivo
     *
     * @return  self
     */
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get the value of nomeArquivo
     */
    public function getNomeArquivo()
    {
        return $this->nomeArquivo;
    }

    /**
     * Set the value of nomeArquivo
     *
     * @return  self
     */
    public function setNomeArquivo($nomeArquivo)
    {
        $this->nomeArquivo = $nomeArquivo;

        return $this;
    }

    /**
     * Get the value of tipoArquivo
     */
    public function getTipoArquivo()
    {
        return $this->tipoArquivo;
    }

    /**
     * Set the value of tipoArquivo
     *
     * @return  self
     */
    public function setTipoArquivo($tipoArquivo)
    {
        $this->tipoArquivo = $tipoArquivo;

        return $this;
    }

    /**
     * Get the value of idSolicitacao
     */
    public function getIdSolicitacao()
    {
        return $this->idSolicitacao;
    }

    /**
     * Set the value of idSolicitacao
     *
     * @return  self
     */
    public function setIdSolicitacao($idSolicitacao)
    {
        $this->idSolicitacao = $idSolicitacao;

        return $this;
    }

    /**
     * Get the value of statusArquivo
     */
    public function getStatusArquivo()
    {
        return $this->statusArquivo;
    }

    /**
     * Set the value of statusArquivo
     *
     * @return  self
     */
    public function setStatusArquivo($statusArquivo)
    {
        $this->statusArquivo = $statusArquivo;

        return $this;
    }

    /**
     * Get the value of idArquivo
     */
    public function getIdArquivo()
    {
        return $this->idArquivo;
    }

    /**
     * Set the value of idArquivo
     *
     * @return  self
     */
    public function setIdArquivo($idArquivo)
    {
        $this->idArquivo = $idArquivo;

        return $this;
    }

    /**
     * Get the value of estiloArquivo
     */
    public function getEstiloArquivo()
    {
        return $this->estiloArquivo;
    }

    /**
     * Set the value of estiloArquivo
     *
     * @return  self
     */
    public function setEstiloArquivo($estiloArquivo)
    {
        $this->estiloArquivo = $estiloArquivo;

        return $this;
    }

    /**
     * Get the value of idTipoDocumento
     */
    public function getIdTipoDocumento()
    {
        return $this->idTipoDocumento;
    }

    /**
     * Set the value of idTipoDocumento
     *
     * @return  self
     */
    public function setIdTipoDocumento($idTipoDocumento)
    {
        $this->idTipoDocumento = $idTipoDocumento;

        return $this;
    }

    /**
     * Get the value of codigoTrocaArquivo
     */
    public function getCodigoTrocaArquivo()
    {
        return $this->codigoTrocaArquivo;
    }

    /**
     * Set the value of codigoTrocaArquivo
     *
     * @return  self
     */
    public function setCodigoTrocaArquivo($codigoTrocaArquivo)
    {
        $this->codigoTrocaArquivo = $codigoTrocaArquivo;

        return $this;
    }

    /**
     * Get the value of assinadoDigital
     */
    public function getAssinadoDigital()
    {
        return $this->assinadoDigital;
    }

    /**
     * Set the value of assinadoDigital
     *
     * @return  self
     */
    public function setAssinadoDigital($assinadoDigital)
    {
        $this->assinadoDigital = $assinadoDigital;

        return $this;
    }
}
