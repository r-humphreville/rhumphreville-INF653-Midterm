<?php
class Categories {
    private $conn;
    private $table = 'categories';
    public $id;
    public $categories;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT 
        id,
        categories
        From 
        ' . $this->table;


    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
    }

    public function read_single() {
        $query = 'SELECT
        id,
        categories
        
        FROM 
        ' . $this->table . '
        WHERE
        id = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    

        $this->id = $row['id'];
        $this->categories = $row['categories'];
        
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . '
        SET
        id = :id,
        categories = :categories';

        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->categories = htmlspecialchars(strip_tags($this->categories));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':categories', $this->categories);
      
        
       if($stmt->execute()) {
            return true;
        }
    
        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . '
        SET
        id = :id,
        categories = :categories
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->categories = htmlspecialchars(strip_tags($this->categories));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':categories', $this->categories);
    
        if($stmt->execute()) {
            return true;
        } 
    
        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        } 
        printf("Error: %s. \n", $stmt->error);
        return false;
    }
}
?>
