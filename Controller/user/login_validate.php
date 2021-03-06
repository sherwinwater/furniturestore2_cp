<?php

if (!isset($_SESSION)) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/config/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Model/customer.php';

$userid = filter_input(INPUT_POST, "userid", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

$userid_guest = filter_input(INPUT_POST, "userid_guest", FILTER_SANITIZE_SPECIAL_CHARS);

$userid_new = filter_input(INPUT_POST, "userid_new", FILTER_SANITIZE_SPECIAL_CHARS);
$password_new = filter_input(INPUT_POST, "password_new", FILTER_SANITIZE_SPECIAL_CHARS);
$password_con_new = filter_input(INPUT_POST, "password_con_new", FILTER_SANITIZE_SPECIAL_CHARS);
$firstname_new = filter_input(INPUT_POST, "firstname_new", FILTER_SANITIZE_SPECIAL_CHARS);
$lastname_new = filter_input(INPUT_POST, "lastname_new", FILTER_SANITIZE_SPECIAL_CHARS);
$email_new = filter_input(INPUT_POST, "email_new", FILTER_SANITIZE_SPECIAL_CHARS);

//guest
if (isset($userid_guest)) {
    $_SESSION["user"] = $userid_guest;
    include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Controller/showProducts.php';
}

//existing customer
$wrongmsg = "";
if (isset($userid) && isset($password)) {
    // validate user
    $customer = new Customer($conn);
    if ($customer->checkExistingCustomer($userid, $password)) {
        $_SESSION['user'] = $userid;
        include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Controller/showProducts.php';
    } else {
        $wrongmsg = "wrong user with password";
        include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Controller/user/login.php';
    }
}

//new customer
$outmsg = array("", "");
if (isset($userid_new) && isset($password_new) && isset($password_con_new) && isset($firstname_new) && isset($lastname_new) && isset($email_new)) {
    $params = array($userid_new, $password_new, $firstname_new, $lastname_new, $email_new);
    $customer = new Customer($conn);
    $outmsg = $customer->checkDuplicateCustomer($userid_new, $email_new);

    if ($outmsg[0] == false) {
        $customer->insertCustomer($params);
        $_SESSION["user"] = $userid_new;
        include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Controller/showProducts.php';
    } else {
        include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Controller/user/login.php';
    }
}
?>