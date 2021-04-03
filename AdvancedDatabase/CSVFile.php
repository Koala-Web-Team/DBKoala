<?php

require_once("AdvancedDatabase/FileInterface.php");

class CSVFile implements FileInterface
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function import($filepath,$type = null)
    {
        if($type == 'table') {
            $handle = fopen($filepath, "r");
            if ($handle) {
                while (($line = fgetcsv($handle)) !== false) {
                    try {
                        $stmt = $this->pdo->prepare("INSERT INTO `users` (`name`, `email`) VALUES (?,?)");
                        $stmt->execute([$line[0], $line[1]]);
                    } catch (Exception $ex) {
                        echo $ex->getmessage();
                    }
                }
                fclose($handle);
            } else { echo "ERROR OPENING $filepath"; }
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

    public function export($type = null)
    {

        if($type == 'table') {
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary");
            header("Content-disposition: attachment; filename=\"export.csv\"");

            $stmt = $this->pdo->prepare("SELECT * FROM `users`");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_NAMED)) {
                echo implode(",", [$row['name'], $row['email'], $row['phone']]);
                echo "\r\n";
            }
        }
        elseif($type == 'query')
        {
            echo 'export query pdf';
        }
        else
        {
            echo 'export database pdf';
        }

    }
}
