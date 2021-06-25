<?php

require_once("koala/Connection/MysqlConnection.php");
require __DIR__ . '//..//' . "../vendor/autoload.php";
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '//../..//');
$dotenv->load();

class ConnectionFactory
{

    private $dbms;
    private $database;
    private $pdo;

    public function __construct(){
        $this->dbms = $_ENV['DB_CONNECTION'];
        $this->database = $_ENV['DB_DATABASE'];
        $this->setConnection();
    }

    private function setConnection(){
        switch ( $this->dbms ) {
            case 'mysql':
                $db = MysqlConnection::getInstance();
                $this->pdo = $db->createConnection();
                break;
            case 'pgsql':
                return 'pgsql';
            case 'sqlite':
                return 'sqlite';
            case 'sqlsrv':
                return 'sqlsrv';
            default:
                throw new InvalidArgumentException("Unsupported database management system [{$this->dbms}].");
        }
    }

    public function getDbms(){
        return $this->dbms;
    }

    public function setDbms( $dbms ){
        $this->dbms = $dbms;
    }

    public function getPdo(){
        return $this->pdo;
    }

    public function setPdo($pdo){
        $this->pdo = $pdo;
    }

    public function getDatabase(){
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

}
