<?php


trait KoalaBuilder
{
    /**
     * TODO TBD
     */
    public function get( $format = 'assoc' ) {

        $this->buildQuery();

        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);

        if ( $format == "json" ) {
            $result = json_encode($stmt->fetchAll());
        } elseif ( $format == "object" ) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } elseif ( $format == "both" ) {
            $result = $stmt->fetchAll(PDO::FETCH_BOTH);
        } else {
            $result = $stmt->fetchAll();
        }

        return $result;
    }

    public function koalaSql( $format = 'assoc' ) {
        $this->buildQuery();
        return $this->query;
    }

    private function aggregate() {
        $this->buildQuery();
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);
        $result = $stmt->fetchColumn();
        return $result;
    }

    public function first() {

        $this->buildQuery();

        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->queryValues);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function all() {
        return $this->get();
    }

    public function arrayMap( $callback, $array ) {
        $r = array();
        foreach ( $array as $key => $value ) {
            $r[$key] = $callback($key, $value);
        }
        return $r;
    }

    public function getTable() {
        return $this->table;
    }

    public function setTable( $table ) {
        $this->table = $table;
    }

    public function getQueryValues(): array
    {
        return $this->queryValues;
    }

    private function buildQuery(){
        if($this->raw == null){
            $this->query = $this->where." ".$this->groupby." ".$this->having;

            if ( $this->selectIsCalled == false ) {
                $this->select = "SELECT *";
            }

            if( $this->from != null ){
                $this->select .= $this->from;
            }
            else {
                if($this->wheregroup == false) {
                    $this->select .= " FROM $this->table";
                }
            }

            if( $this->join != null ) {
                $this->query = " $this->select $this->join $this->query";
            }
            else{
                if( $this->update != null ){
                    $this->query = "$this->update $this->query";
                }
                elseif( $this->delete != null ){
                    $this->query = "$this->delete $this->query";
                }
                else{
                    $this->query = " $this->select $this->query";
                }
            }

            $this->query .= $this->orderBy." ".$this->take." ".$this->offset;

            if( $this->union != null ){
                $this->query = "(".$this->query.")".$this->union;
            }
        }
        else{
            $this->query = $this->raw;
        }

    }
}
