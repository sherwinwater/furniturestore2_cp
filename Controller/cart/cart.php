<?php
if (!isset($_SESSION)) {
    session_start();
}
include $_SERVER['DOCUMENT_ROOT'].'/SYST10199/FurnitureStore/View/header.php';
include $_SERVER['DOCUMENT_ROOT'].'/SYST10199/FurnitureStore/Controller/cart/showCart.php';
showCart("", "hidden");
?>

<!DOCTYPE html>

<html>

    <body>
        <?php
        if ($totalprice > 0 && !isset($_SESSION['orderID'])) {
            ?>
        <h3>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"Guest" ?>, Your shopping cart</h3>
            <form method='get' action='/SYST10199/FurnitureStore/Controller/cart/cart_update.php'>
                <?= $cart_table ?>
                <input type="submit" value="Proceed to Checkout" > 
            </form>
        <?php } else {
            ?>
            <p>Hi <?= isset($_SESSION["user"])?$_SESSION["user"]:"Guest" ?>,You haven't chosen any product</p>
        <?php }
        ?>
        <script>
            var quantity = document.getElementsByClassName('quantity');
            var totalprice = document.getElementById('totalprice');
            var deleteBtn = document.getElementsByClassName('deleteBtn');

            Object.entries(quantity).forEach(([key, val]) => {
                val.addEventListener('change', function () {
                    changePrice(key, val);
                });
            });

            Object.entries(deleteBtn).forEach(([key, val]) => {
                val.addEventListener('click', function () {
                    removeItem(key, val);
                });
            });

            function changePrice(key, val) {
                var price = document.getElementById('price' + key);
                var unitprice = document.getElementById('unitprice' + key);
                totalprice.innerHTML = (Number(totalprice.innerHTML) - Number(price.innerHTML)).toFixed(2);
                price.innerHTML = Number(val.value * unitprice.innerHTML).toFixed(2);
                totalprice.innerHTML = (Number(totalprice.innerHTML) + Number(price.innerHTML)).toFixed(2);
            }

            function removeItem(key, val) {
                var rowElement = document.getElementById('row' + key);
                var price = document.getElementById('price' + key);
                console.log(key);
                console.log("delete");
                console.log(rowElement);
                rowElement.remove();
                totalprice.innerHTML = (Number(totalprice.innerHTML) - Number(price.innerHTML)).toFixed(2);
            }
        </script>
    </body>

</html>