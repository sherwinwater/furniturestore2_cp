<?php
if (!isset($_SESSION)) {
    session_start();
}

include dirname(__DIR__).'/View/header.php';
include dirname(__DIR__).'/config/connect.php';
include dirname(__DIR__).'/Model/BaseDAO.php';

$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())), 0, 4));
$unique = $today . $rand;
$_SESSION['orderid'] = $unique;

$order = new BaseDAO($conn);
$order->table_name = "orders";
$order->field_array = Array("productid", "productname", "price", "quantity", "totalprice","imgpath","orderid","userid","billing","delivery");

$billing = new BaseDAO($conn);
$billing->table_name = "billing";
$billing->field_array = Array();
$delivery = new BaseDAO($conn);
$delivery->table_name = "delivery";

$_SESSION['user']=isset($_SESSION["user"])?$_SESSION["user"]:"guest";
    
foreach ($_SESSION['cart'] as $key => $value) {
    $params_order = array();
    array_push($params_order, 
            $value['productid'],
            $value['name'],
            $value['price'],
            $value['quantity'],
            $value['totalprice'],
            $value['imgpath'],
            $_SESSION['orderid'],
            $_SESSION['user'],
            $_SESSION['billing']['address_payment'], 
            $_SESSION['delivery']['address_delivery']
            );
    $order->params_array = $params_order;
    $order->insertData();
}

$billing->field_array = array("firstname","lastname","account","expireddate","securitycode","address","city","country","postcode","userid");
$params_billing = array();
foreach ($_SESSION['billing'] as $key => $value) {
    array_push($params_billing, $value);
}
array_push($params_billing, $_SESSION['user']);
$billing->params_array =$params_billing;
$billing->insertData();

$delivery->field_array = array("firstname","lastname","phone","email","address","city","country","postcode","userid");
$params_delivery = array();
foreach ($_SESSION['delivery'] as $key => $value) {
    array_push($params_delivery, $value);
}
array_push($params_delivery, $_SESSION['user']);
$delivery->params_array =$params_delivery;
$delivery->insertData();

?>

<!DOCTYPE html>

<html>
    <body>
        <p>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"guest"?>, your order <?= $_SESSION['orderid'] ?> has been placed</p>

    </body>
</html>

