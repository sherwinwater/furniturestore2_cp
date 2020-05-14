<?php
if (!isset($_SESSION)) {
    session_start();
}
$user = isset($_SESSION["user"])?$_SESSION["user"]:"Guest";
unset($_SESSION['user']);

include $_SERVER['DOCUMENT_ROOT'].'/SYST10199/FurnitureStore/View/header.php';
?>
<!DOCTYPE html>
<html>
    <body>
        <p>Hi <?= $user ?>, You have logged out. </p>
        <a  href="/SYST10199/FurnitureStore/Controller/user/login.php" class="add checkout"> Login</a><br>
        <?php 
        session_destroy();
        ?>

    </body>
</html>
