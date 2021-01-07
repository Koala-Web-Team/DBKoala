<?php

require_once ("Connection/MysqlConnection.php");

class ConnectionFactory
{

    public function setConnection($dbms)
    {
        switch ($dbms) {
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

        throw new InvalidArgumentException("Unsupported database management system [{$dbms}].");
    }

}
