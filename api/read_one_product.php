<?php
//include core configuration
include_once('../config/core.php');

//include database connection
include_once('../config/database.php');

//product object
include_once('../object/products.php');

//class instance
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

//read all the products
$product->id = $_POST['prod_id'];
$results = $product->readOne();

//output in json format
echo $results;


// if you have binary data and if its large its best to use form data as a content type
// if youre working with mongodb or something, use raw