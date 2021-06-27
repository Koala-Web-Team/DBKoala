<?php

trait SqlCommands
{
    public function create( $columns = [] ) {
        $keys = implode(', ', array_keys($columns));
        $values = array_values($columns);

        $bind_params = "";
        for ( $i = 0; $i < count($columns); $i++ ) {
            $bind_params .= "?";
            if ( count($columns) - $i > 1 ) {
                $bind_params .= ", ";
            }
        }

        $sql = "INSERT INTO $this->table ($keys) VALUES ($bind_params)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
    }

    public function update( $columns = [], $id = null ) {
        $keys = implode(', ', $this->arrayMap(function ( $key, $value ) {
            return "$key = ?";
        }, $columns));

        $values = array_values($columns);

        array_unshift($this->queryValues, ...$values);

        if ( $id != null ) {
            $this->queryValues[] = $id;
            $this->query = "UPDATE $this->table SET $keys WHERE id = ?";
        }else{
            $this->update = "UPDATE $this->table SET $keys";
            $this->buildQuery();
        }
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);
    }

    public function delete( $id = null ) {
//		if ( $this->whereIsCalled ) {
//			$this->query = 'DELETE FROM' . $this->table . " " . $this->query;
//		} else {
//			$this->query = 'DELETE FROM ' . $this->table;
//			if ( $id ) {
//				$this->whereIsCalled = true;
//				$this->queryValues[] = $id;
//				$this->query .= " WHERE id = ?";
//			}
//		}
//		return $this;

        if ( $id != null ) {
            $this->queryValues[] = $id;
            $this->query = "DELETE FROM $this->table WHERE id = ?";
        }else{
            $this->delete = "DELETE FROM $this->table";
            $this->buildQuery();
        }
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);
    }

    public function truncate() {
        $this->query = "TRUNCATE TABLE $this->table";
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute();
    }

    public function select( $columns = ['*'] ) {
        $columns_implode = implode(',', $columns);
        $this->selectIsCalled = true;
        $this->select = 'SELECT ' . $columns_implode;
        return $this;
    }

    public function selectlang( $language, array $columns = [] ) {
        $columnsToFetch = [];

        if ( is_array($language) ) {
            foreach ( $language as $lang ) {
                $columnsToFetch = array_merge($columnsToFetch, $this->selectOneLang($lang, $columns));
            }
        } else {
            $columnsToFetch = $this->selectOneLang($language, $columns);
        }

        $columnsToFetch = implode(', ', $columnsToFetch);

        $this->selectIsCalled = true;
        $this->select = 'SELECT ' . $columnsToFetch;
        return $this;
    }

    private function selectOneLang( string $language, $columns ) {
        $tableColumns = $this->getTableColumns();
        $columnsToFetch = [];

        if ( count($columns) > 0 ) {
            foreach ( $columns as $column ) {
                if ( (array_search($column . '_' . $language, $tableColumns)) ) {
                    $columnsToFetch[] = $column . '_' . $language;
                } else {
                    $columnsToFetch[] = $column;
                }
            }
        } else {
            $columnsWithLang = [];
            foreach ( $tableColumns as $column ) {
                $columnsToFetch[] = $column;
                if ( strpos($column, '_' . $language) ) {
                    $columnsWithLang[] = str_replace("_" . $language, "", $column);
                }
            }
            foreach ( $columnsToFetch as $column ) {
                foreach ( $columnsWithLang as $columnWithLang ) {
                    if ( strpos($column, $columnWithLang . "_") && !strpos($column, $columnWithLang . "_" . $language) ) {
                        $key = array_search($column, $columnsToFetch);
                        unset($columnsToFetch[$key]);
                        break;
                    }
                }
            }
        }
        return $columnsToFetch;
    }

    public function selectExcept( array $columns ) {
        $tableColumns = $this->getTableColumns();

        /**
         * TODO: TBD
         */
        foreach ( $columns as $column ) {
            if ( ($key = array_search($column, $tableColumns)) != null ) {
                unset($tableColumns[$key]);
            }
        }

        $columns_implode = implode(', ', $tableColumns);
        $this->selectIsCalled = true;
        $this->select = 'SELECT ' . $columns_implode . $this->from;
        return $this;
    }

    private function getTableColumns() {
        $sql = 'SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="' . $_ENV['DB_DATABASE'] . '" AND `TABLE_NAME`="' . $this->table . '"';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $table_columns = [];

        foreach ( $result as $res ) {
            $table_columns[] = $res['COLUMN_NAME'];
        }

        return $table_columns;
    }

    public function distinct( $columns = ['*'] ) {
        $columns_implode = implode(',', $columns);
        $this->selectIsCalled = true;
        $this->select = 'SELECT DISTINCT ' . $columns_implode;
        return $this;
    }
}
