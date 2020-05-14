<?php
if (!isset($_SESSION)) {
    session_start();
}
include dirname(__DIR__)."/View/header.php";

?>

<!DOCTYPE html>

<html>
    <body>
        <div>
            <a href="/SYST10199/FurnitureStore/Controller/showProducts.php" style="font-size: 2em;">Toronto Furniture Online</a><br>
            <a href="/SYST10199/FurnitureStore/Controller/showProducts.php">
                <img src="/SYST10199/FurnitureStore/Model/img/used_furniture.jpg" alt="furniture" id="furniture" style="width:800px; height:500px;">
            </a>
        </div>
    </body>
</html>
