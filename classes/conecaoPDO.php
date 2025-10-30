<?php

class Conexao
{
    private $success;
    private $user;
    private $pwd;
    private $db;
    private $host;
    private $pdoConn;

    public function Conectar()
    {
        try {/*
            $this->setUser('dbagenddev');
            $this->setPwd('Sge@4@5');
            $this->setDb('dbagenddev');
            $this->setHost('dbagenddev.mysql.dbaas.com.br');

            */
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }


    public function ConectarPDO()
    {
        try {


        
   /*
            //  servidor desenvolvimento

            $user = 'dbagenddev';
            $pwd = 'Sge@4@5';
            $db = 'dbagenddev';
            $host = 'dbagenddev.mysql.dbaas.com.br';
 */



            //   servidor oficial
            $user = 'agendaf';
            $pwd = 'agendaf';
            $db = 'agendaf';
            $host = 'akuma.guarulhos.sp.gov.br';

 








            $dns = 'mysql:dbname=' . $db . ';host=' . $host;


            $pdo = new PDO($dns, $user, $pwd, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

            return $pdo;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
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
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    /**
     * Get the value of host
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @return  self
     */
    public function setHost($host)
    {
        $this->host = $host;

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
}
