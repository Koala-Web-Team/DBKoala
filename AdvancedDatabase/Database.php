<?php

require_once("Connection/ConnectionFactory.php");

class Database extends ConnectionFactory
{
    private $table;
    private $dbms;
    private $connection;
    private $query;
    private $queryValues = [];
    private static $state;
    private static $select;
    private static $orderBy;

    //TODO
//    exist
//    doesnt exist
//    absy tasks
//    updates



    public function __construct(){
        parent::__construct();
        $this->dbms = $this->setConnection();
        $this->connection = $this->dbms->createConnection();
    }

    public function backup( $type = 'database' )
    {

        if(is_array($type)) {
            $output = '';
            foreach ($type as $table) {
                $show_table_query = "SHOW CREATE TABLE " . $table . "";
                $statement = $this->connection->prepare($show_table_query);
                $statement->execute();
                $show_table_result = $statement->fetchAll();

                foreach ($show_table_result as $show_table_row) {
                    $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                }
                $select_query = "SELECT * FROM " . $table . "";
                $statement = $this->connection->prepare($select_query);
                $statement->execute();
                $total_row = $statement->rowCount();

                for ($count = 0; $count < $total_row; $count++) {
                    $single_result = $statement->fetch(PDO::FETCH_ASSOC);
                    $table_column_array = array_keys($single_result);
                    $table_value_array = array_values($single_result);
                    $output .= "\nINSERT INTO $table (";
                    $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                    $output .= "'" . implode("','", $table_value_array) . "');\n";
                }
            }
        }
        else{
            $get_all_table_query = "SHOW TABLES";
            $statement = $this->connection->prepare($get_all_table_query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output = '';
            foreach ($result as $table) {
                $show_table_query = "SHOW CREATE TABLE " . $table["Tables_in_buisness"] . "";
                $statement = $this->connection->prepare($show_table_query);
                $statement->execute();
                $show_table_result = $statement->fetchAll();

                foreach ($show_table_result as $show_table_row) {
                    $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                }
                $select_query = "SELECT * FROM " . $table["Tables_in_buisness"] . "";
                $statement = $this->connection->prepare($select_query);
                $statement->execute();
                $total_row = $statement->rowCount();

                for ($count = 0; $count < $total_row; $count++) {
                    $single_result = $statement->fetch(PDO::FETCH_ASSOC);
                    $table_column_array = array_keys($single_result);
                    $table_value_array = array_values($single_result);
                    $table_get = $table["Tables_in_buisness"];
                    $output .= "\nINSERT INTO $table_get (";
                    $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                    $output .= "'" . implode("','", $table_value_array) . "');\n";
                }
            }
        }

        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        return readfile($file_name);
    }
}
