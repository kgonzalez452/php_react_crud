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
            $query = "INSERT INTO categories SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created";

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

     //joining product and category tables
    public function readAll() {
        //select all data
        $query = "SELECT p.id, p.name, p.description, p.price, c.name as name FROM " . $this->table_name . "
        p LEFT JOIN categories c
        ON p.id= c.id
        ORDER BY id DESC";

    $stmt = $this->connect->prepare($query);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($results);
    }

    public function readOne() {

        //select the data
        $query = "SELECT p.id, p.name, p.description, p.price, c.name as name FROM " . $this->table_name . "
        p LEFT JOIN categories c
        ON p.id= c.id
        WHERE p.id = :id";

        //prepare the query for execution
        $stmt = $this->connect->prepare($query);

        $id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($results);
    }

    public function update($id) {

        //update product based on id. 
        $query = "UPDATE categories
                    SET name=:name, description=:description, id=:id, WHERE id=:id";
    
        //prepare statement
        $stmt = $this->connect->prepare($query);

        // sanitize
        $name = htmlspecialchars(strip_tags($this->name));
        $description = htmlspecialchars(strip_tags($this->description));
        $id = htmlspecialchars(strip_tags($this->id));

        //bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);

        //Execute the query
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM categories
                    WHERE id=:id";

        $stmt = $this->connect->prepare($query);

        // sanitize
        $id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':id', $id);
        
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

}