<?php

if($_POST) {
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

//set category property value
$category->name = $_POST['name'];
$category->description = $_POST['description'];
$category->id = $_POST['id'];


//read all the categorys
$category->id = $_POST['prod_id'];
$results = $category->readOne();

//output in json format
echo $category->update() ? "true" : "false";

}
