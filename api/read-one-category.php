<?php
//include core configuration
include_once('../config/core.php');

//include database connection
include_once('../config/database.php');

//category object
include_once('../object/category.php');

//class instance
$database = new Database();
$db = $database->getConnection();
$category = new Category($db);

//read all the categorys
// $category->id = $_POST['cat_id'];
$results = $category->readOne();

//output in json format
echo $results;


// if you have binary data and if its large its best to use form data as a content type
// if youre working with mongodb or something, use raw