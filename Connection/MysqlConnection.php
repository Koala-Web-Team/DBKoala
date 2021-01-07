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
    public function createConnection(array $attributes = []){

        $this->setConnectionAttributes($attributes);

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
    private function setConnectionAttributes( array $attributes = [] )
    {
        foreach ( $attributes as $key => $value ) {
            if ( property_exists( $this, mb_strtolower( $key ) ) ) {
                $key = mb_strtolower( $key );
                $this->$key = $value;
            }
        }
    }


    /**
     * @return null
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return null
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param null $charset
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * @param null $dsn
     */
    public function setDsn($dsn)
    {
        $this->dsn = $dsn;
    }

    /**
     * @return null
     */
    public function getDsn()
    {
        return $this->dsn;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }


    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * @param string $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return string
     */
    public function getDb()
    {
        return $this->db;
    }


}
