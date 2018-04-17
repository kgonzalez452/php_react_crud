<?php
//include core configuration
include_once('../config/core.php');

//include database connection
include_once('../config/database.php');

//product object
include_once('../object/product.php');

//class instance
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

//set product property values
$product->name = $_POST['name'];
$product->price = $_POST['price'];
$product->description = $_POST['description'];
$product->category_id = $_POST['category_id'];



//create table

echo $product->create() ? 'true' : 'false';