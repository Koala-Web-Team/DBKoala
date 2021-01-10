<?php

require_once ("Connection/MysqlConnection.php");
require __DIR__. '//..//'."/vendor/autoload.php";
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'//..//'.'/');
$dotenv->load();

class ConnectionFactory
{

    private $dbms;

    public function __construct(){
        $this->dbms = $_ENV['DB_CONNECTION'];
    }

    public function setConnection(){
        switch ( $this->dbms ) {
            case 'mysql':
                $db = MysqlConnection::getInstance();
                return $db;
            case 'pgsql':
                return 'pgsql';
            case 'sqlite':
                return 'sqlite';
            case 'sqlsrv':
                return 'sqlsrv';
        }

        throw new InvalidArgumentException("Unsupported database management system [{$this->dbms}].");
    }

    public function getDbms(){
        return $this->dbms;
    }

    public function setDbms( $dbms ){
        $this->dbms = $dbms;
    }

}
