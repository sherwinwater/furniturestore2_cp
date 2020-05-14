<?php
include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Model/BaseDAO.php';

class Customer extends BaseDAO{

    //database connection and table name
    public $table_name = "customer";
    // object properties
    public $userid = "userid";
    public $firstname = "firstname";
    public $lastname = "lastname";
    public $password = "password";
    public $email = "email";

    function checkExistingCustomer($userid, $password) {
        $query = "SELECT 
                $this->userid, $this->password
            FROM
                $this->table_name ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
echo "checke";
        // execute query
        $stmt->execute();
        $customerList = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($customerList, $row);
        }
        $isExistingCustomer = false;
        foreach ($customerList as $key => $value) {
            if ($userid == $value['userid'] && $password == $value['password']) {
                $isExistingCustomer = true;
            }
        }
        return $isExistingCustomer;
    }

    function checkDuplicateCustomer($userid, $email) {
        $query = "SELECT 
                $this->userid, $this->email
            FROM
                $this->table_name ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $customerList = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($customerList, $row);
        }
        $isDuplicateCustomer = false;
        $wrongmsg = "";
        foreach ($customerList as $key => $value) {
            if ($userid == $value['userid'] && $email == $value['email']) {
                $isDuplicateCustomer = true;
                $wrongmsg = "userid and email have been taken.";
            } elseif ($userid == $value['userid']) {
                $isDuplicateCustomer = true;
                $wrongmsg = "userid has been taken.";
            } elseif ($email == $value['email']) {
                $isDuplicateCustomer = true;
                $wrongmsg = "email has been taken.";
            }
        }
        return array($isDuplicateCustomer,$wrongmsg);
    }

}
