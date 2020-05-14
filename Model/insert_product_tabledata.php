<?php
include dirname(__DIR__) . '/config/connect.php';
include dirname(__DIR__) . '/Model/BaseDAO.php';

//load products
$params = Array();
$params[0] = Array(2389, "Borquez_Barrel_Chair", "Borquez_Barrel_Chair", 4.00, "/SYST10199/FurnitureStore/Model/img/Borquez_Barrel_Chair.jpg");
$params[1] = Array(4379, "Chicopee_6_Drawer_Double_Dresser", "Chicopee_6_Drawer_Double_Dresser", 10.4, "/SYST10199/FurnitureStore/Model/img/Chicopee_6_Drawer_Double_Dresser.jpg");
$params[2] = Array(2469, "Halstead_Hall_Tree_with_Bench_and_Shoe_Storage", "Halstead_Hall_Tree_with_Bench_and_Shoe_Storage", 20.4, "/SYST10199/FurnitureStore/Model/img/Halstead_Hall_Tree_with_Bench_and_Shoe_Storage.jpg");
$params[3] = Array(2459, "Jolie_Chaise_Lounge", "Jolie_Chaise_Lounge", 20.4, "/SYST10199/FurnitureStore/Model/img/Jolie_Chaise_Lounge.jpg");

$product = new BaseDAO($conn);
$product->table_name = "products";
$product->field_array = Array("productid", "name", "description", "price", "imgpath");

foreach ($params as $value) {
    $product->params_array = $value;
    $product->insertData();
}
