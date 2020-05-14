<?php

class BaseDAO {
    private $conn;
    public $table_name;
    public $field_array = array();
    public $data_array = array();
    public $params_array = array();
    public $columns_name = array();
    public $count_rows;
    
     public function __construct($db) {
        $this->conn = $db;
    }
    
    // insert data
    function insertData() {
        $fields ="";
        $paras ="";
        foreach($this->field_array as $key=>$value){
            $fields .= $value.",";
            $paras .= "?,";
        } 
        $fields = rtrim($fields,',');
        $paras = rtrim($paras,',');
        
        $command = "INSERT INTO $this->table_name($fields)"
                . "VALUES($paras)";
        $stmt = $this->conn->prepare($command);
        $stmt->execute($this->params_array);
//        echo "successfully";
    }

    // read all orders
    function getData() {

        // select all orders query
        $query = "SELECT *
            FROM
                $this->table_name
                ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // return values

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($this->data_array, $row);
        }

        return $this->data_array;
    }

// used for paging orders
    public function count() {

        // query to count all product records
        $query = "SELECT count(*) FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        // get row value
        $rows = $stmt->fetch(PDO::FETCH_NUM);

        // return count
        $this->count_rows =$rows[0];
        return $this->count_rows;
    }

    public function getColumnNames() {

        $query = "DESCRIBE $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        while ($row = $stmt->fetch()) {
            $this->columns_name[] = $row[0];
        }
        return $this->columns_name;
    }
    
}
