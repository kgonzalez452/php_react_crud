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
$results = $category->readAll();

//output in json format
echo $results;