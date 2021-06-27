<?php

require_once("koala/AdvancedDatabase/FileInterface.php");

class CSVFile implements FileInterface
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function import( $filepath, $table , $columns = [] )
    {
        $handle = fopen($filepath, "r");
        if ($handle) {
            while (($line = fgetcsv($handle)) !== false) {
                try {
                    if(!empty($columns)){
                        $bind_params = "";
                        $lines = [];
                        for ( $i = 0; $i < count($columns); $i++ ) {
                            $bind_params .= "?";
                            array_push($lines,"$line[$i]");
                            if ( count($columns) - $i > 1 ) {
                                $bind_params .= ", ";
                            }
                        }
                        $columns_implode = implode(',', $columns);
                        $stmt = $this->pdo->prepare("INSERT INTO `$table` ($columns_implode) VALUES ($bind_params)");
                        $stmt->execute($lines);
                    }
                    else{
                        $columns = $this->getTableColumns($table);
                        $columns_implode = implode(',', $columns);
                        $bind_params = "";
                        $lines = [];
                        for ( $i = 0; $i < count($columns); $i++ ) {
                            $bind_params .= "?";
                            array_push($lines,"$line[$i]");
                            if ( count($columns) - $i > 1 ) {
                                $bind_params .= ", ";
                            }
                        }
                        $stmt = $this->pdo->prepare("INSERT INTO `$table` ($columns_implode) VALUES ($bind_params)");
                        $stmt->execute($lines);
                    }
                } catch (Exception $ex) {
                    echo $ex->getmessage();
                }
            }
            fclose($handle);
        } else {
            echo "ERROR OPENING $filepath";
        }
    }

    public function export( $type , $value , $queryvalues = null)
    {
        if( $type == 'table' ) {
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"export.csv\"");

            $stmt = $this->pdo->prepare("SELECT * FROM $value");
            $stmt->execute();
            $fp = fopen('php://output', 'w');
            while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
                fputcsv($fp,$row);
            }
            fclose($fp);
        }
        elseif( $type == 'query' ) {
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"export.csv\"");

            $stmt = $this->pdo->prepare($value);
            $stmt->execute($queryvalues);

            $fp = fopen('php://output', 'w');

            while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
                fputcsv($fp,$row);
            }
            fclose($fp);
        }
    }

    private function getTableColumns($table) {
        $sql = 'SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="' . $_ENV['DB_DATABASE'] . '" AND `TABLE_NAME`="' . $table . '"';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $table_columns = [];

        foreach ( $result as $res ) {
            $table_columns[] = $res['COLUMN_NAME'];
        }

        return $table_columns;
    }
}
