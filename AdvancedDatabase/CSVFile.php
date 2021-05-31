<?php

require_once("AdvancedDatabase/FileInterface.php");

class CSVFile implements FileInterface
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function import( $filepath, $type = null, $value = null )
    {
        if($type == 'table') {
            if($value != null) {
                $handle = fopen($filepath, "r");
                if ($handle) {
                    while (($line = fgetcsv($handle)) !== false) {
                        try {
                            $stmt = $this->pdo->prepare("INSERT INTO `$value` (`name`, `email`) VALUES (?,?)");
                            $stmt->execute([$line[0], $line[1]]);
                        } catch (Exception $ex) {
                            echo $ex->getmessage();
                        }
                    }
                    fclose($handle);
                } else {
                    echo "ERROR OPENING $filepath";
                }
            }
        }
        elseif($type == 'query')
        {
            echo 'import query pdf'.'in folder'.' '.$filepath;
        }
        else
        {
            echo 'import database pdf'.'in folder'.' '.$filepath;
        }

    }

    public function export( $type = null , $value = null )
    {

        if($value == null) {
           throw new \http\Exception\InvalidArgumentException('dfsf');
        }

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
            $stmt->execute();

            $fp = fopen('php://output', 'w');

            while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
                fputcsv($fp,$row);
            }
            fclose($fp);
        }
        else {
            throw new \http\Exception\InvalidArgumentException('dfdfsf');
        }
//        else
//        {
//            $query = $this->pdo->prepare('show tables');
//            $query->execute();
//
//            while($rows = $query->fetch(PDO::FETCH_ASSOC)){
//                header('Content-Type: application/octet-stream');
//                header("Content-Transfer-Encoding: Binary");
//                header("Content-disposition: attachment; filename=\"export.csv\"");
//
//                $table = $rows['Tables_in_buisness'];
//
//                $fp = fopen('php://output', 'w');
//
//                $stmt = $this->pdo->prepare("SELECT * FROM $table");
//                $stmt->execute();
//                while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
//                    fputcsv($fp,$row);
//                }
//
//                fclose($fp);
//            }
//        }

    }
}
