<?php

require_once ("Connection/IConnection.php");

class MysqlConnection implements IConnection
{

    private $host = "localhost";
    private $db;
    private $user = "root";
    private $pass = "";
    private $charset = null;
    private $opt = null;
    private $dsn = null;
    private $connection = null;
    private static $database = null;

    /* Private construct that can only be accessed from within this class */
    private function __construct(){
    }

    /* clone  method that throws exception when the object is cloned */
    public function __clone() {
        throw new Exception("Can't clone a singleton");
    }

    /* A method handling setting up params and creating a connection */
    public function createConnection(){

        $this->setConnectionAttributes();

        $this->charset = "utf8mb4";
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->connection = new PDO($this->dsn, $this->user, $this->pass, $this->opt);

        return $this->connection;
    }

    /* A static method that will create an instance once and after that it will reuse the same instance for all other objects */
    static function getInstance(){
        if (self::$database == null) {
            self::$database = new MysqlConnection();
        }
        return self::$database;
    }


    /* A method handling setting object attributes for connection */
    private function setConnectionAttributes()
    {
        $this->host=$_ENV['DB_HOST'];
        $this->db=$_ENV['DB_DATABASE'];
        $this->password=$_ENV['DB_PASSWORD'];
        $this->username=$_ENV['DB_USERNAME'];
    }


    public function getConnection()
    {
        return $this->connection;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    public function setDsn($dsn)
    {
        $this->dsn = $dsn;
    }

    public function getDsn()
    {
        return $this->dsn;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db;
    }


}
