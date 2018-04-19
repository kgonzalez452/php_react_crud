<?php 

class Category{

    //database connection and table name
    private $connect;
    private $table_name = 'categories';

    // public

    public function __construct($db) {
        $this->connect = $db;
    }

     //object properties
     public $id;
     public $name;
     public $description;
    //  public $created;
     public $timestamp;

    
     public function create() {
        try {
            //insert query
            $query = "INSERT INTO products SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created";

            //prepare statement
            $stmt = $this->connect->prepare($query);

            // sanitize
            $name = htmlspecialchars(strip_tags($this->name));
            $description = htmlspecialchars(strip_tags($this->description));
            $price = htmlspecialchars(strip_tags($this->price));
            $category_id = htmlspecialchars(strip_tags($this->category_id));

            //bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':category_id', $category_id);

            //we need the created variable to know when the record was created
            //also, to comply with strict standards: only  variable should be passed
            //by reference
            
            $created = date('Y-m-d H:i:s');
            $stmt->bindParam(':created', $created);

            //Execute
            if($stmt->$execute()) {
                return true;
            } else {
                return false;
            }


        } //show error if any
        catch(PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }
}