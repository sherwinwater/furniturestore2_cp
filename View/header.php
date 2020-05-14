<?php
if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Furniture Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/SYST10199/FurnitureStore/View/main.css" >
    </head>
    <body>
        <h1>Welcome to Furniture Store</h1>

        <ul>
            <li><a href="/SYST10199/FurnitureStore/View/index.php">Home</a></li>

<?php
if (isset($_SESSION["user"])) {
    ?>
                <li><a style="color: gold"><? echo "Hi ".$_SESSION["user"] ?></a></li>
                <li><a href="/SYST10199/FurnitureStore/Controller/user/logout.php">Logout</a></li>
    <?php
} else {
    ?>
                <li><a href="/SYST10199/FurnitureStore/Controller/user/login.php">Login</a></li>
                <?php
            }
            ?>
            <li><a href="/SYST10199/FurnitureStore/Controller/showProducts.php">Shopping </a></li>
            <li><a href="/SYST10199/FurnitureStore/Controller/cart/cart.php">Cart</a></li>
            <li><a href="/SYST10199/FurnitureStore/Controller/showOrder.php">Order</a></li>
        </ul>
    </body>
</html>
