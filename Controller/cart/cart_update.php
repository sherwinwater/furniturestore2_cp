<?php
if (!isset($_SESSION)) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/View/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/config/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Model/BaseDAO.php';
include $_SERVER['DOCUMENT_ROOT'] . '/SYST10199/FurnitureStore/Controller/cart/showCart.php';

$product = new BaseDAO($conn);
$product->table_name = "products";
$columnNames = $product->getColumnNames();

$i = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {

        if (isset($_GET['id' . $i]) && $_GET['quantity' . $i] != 0) {
            $value['quantity'] = $_GET['quantity' . $i];
            $_SESSION['cart_update'][$key] = $value;
        }
        $i++;
    }
    $_SESSION['cart'] = $_SESSION['cart_update'];
}
showCart("hidden", "");
?>
<!DOCTYPE html>

<html>

    <body>
        <?php
        if ($_SESSION['totalprice'] > 0) {
            ?>
            <h2>Hi <?= isset($_SESSION["user"]) ? $_SESSION["user"] : "guest" ?>, Your shopping cart</h2>
            <?= $cart_table ?>
            <a href="/SYST10199/FurnitureStore/Controller/payment.php" class="buy" id="checkout">Proceed to Checkout </a>
        <?php } else {
            ?>
            <p>Hi <?= isset($_SESSION["user"]) ? $_SESSION["user"] : "guest" ?>,You haven't chosen any product</p>
        <?php }
        ?>