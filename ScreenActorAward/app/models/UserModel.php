<?php
require_once 'C:\xampp\htdocs\ScreenActorAward\public\Database\config.php';

class UserModel {
    private $conn;
    private $table_name = "users";

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $username;
    public $password;

    
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }

    public function register() {
        if ($this->isUsernameExist()) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " SET firstname=:firstname, lastname=:lastname, email=:email, username=:username, password=:password";
        $stmt = $this->conn->prepare($query);

        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login() {
        $query = "SELECT id, password FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $row['password'])) {
                $this->id = $row['id'];
                return true;
            }
        }

        return false;
    }

    private function isUsernameExist() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function insertOrUpdate($data) {

        $sql = "DELETE FROM screen_actor_guild_awards";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $sql = "INSERT INTO screen_actor_guild_awards (year, category, full_name, `show`, won) 
                VALUES (:year, :category, :full_name, :showw, :won)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':year', $data['year']);
        $stmt->bindValue(':category', $data['category']);
        $stmt->bindValue(':full_name', $data['full_name']);
        $stmt->bindValue(':showw', $data['show']);
        $stmt->bindValue(':won', $data['won']);

        $stmt->execute();
    }

    public function getUsersPaginated($page, $pageSize) {
    $offset = ($page - 1) * $pageSize;
    $query = "SELECT * FROM users LIMIT :offset, :pageSize";
    $statement = $this->conn->prepare($query);
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    $statement->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function getScreenActorGuildAwardsPaginated($page, $pageSize) {
    $offset = ($page - 1) * $pageSize;
    $query = "SELECT * FROM screen_actor_guild_awards LIMIT :offset, :pageSize";
    $statement = $this->conn->prepare($query);
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    $statement->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function getScreenActorGuildAwardsPaginatedByYear($year, $page, $pageSize) {
    $offset = ($page - 1) * $pageSize;
    $query = "SELECT * FROM screen_actor_guild_awards WHERE year LIKE :year LIMIT :offset, :pageSize";
    $statement = $this->conn->prepare($query);
    $statement->bindValue(':year', $year . '%');
    $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    $statement->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function getTotalUsers() {
    $query = "SELECT COUNT(*) as total FROM users";
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC)['total'];
}

public function getTotalAwards() {
    $query = "SELECT COUNT(*) as total FROM screen_actor_guild_awards";
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC)['total'];
}
public function getTotalAwardsByYear($year) {
    $query = "SELECT COUNT(*) as total FROM screen_actor_guild_awards WHERE year = :year";
    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':year', $year);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}



    public function addIdColumnToScreenActorGuildAwards() {
        $sql = "ALTER TABLE screen_actor_guild_awards ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY";
        try {
            $this->conn->exec($sql);
        } catch (PDOException $e) {
        }
    }

    public function addUser($firstname, $lastname, $username, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        
            $sql = "INSERT INTO users (id, firstname, lastname, username, email, password) VALUES (:id, :firstname, :lastname, :username, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $this->getTotalUsers() + 1);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
        
            if ($stmt->execute()) {
                return true;
            } else {
                // Log or display the error if execute fails
                error_log("Error executing addUser SQL: " . implode(" | ", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            // Log or display the exception message
            error_log("PDOException in addUser: " . $e->getMessage());
            return false;
        }
    }
    

    public function addAward($year, $category, $full_name, $won) {
        try {
            $sql = "INSERT INTO `screen_actors_guild_awards` ( `year`, `category`, `full_name`, `won`) VALUES ( :year, :category, :full_name, :won)";
            $stmt = $this->conn->prepare($sql);
           // $stmt->bindValue(':id', $this->getTotalAwards() + 1);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':won', $won);
    
            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Error executing addAward SQL: " . implode(" | ", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            error_log("PDOException in addAward: " . $e->getMessage());
            return false;
        }
    }
    


    public function deleteUserById($id) {
        try {
            // Begin transaction
            $this->conn->beginTransaction();
            
            // Step 1: Delete the user by id
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            // Step 2: Reorder the id column values
            $this->reorderUserIds();
            
            // Commit transaction
            $this->conn->commit();
        } catch (Exception $e) {
            // Rollback transaction in case of error
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function deleteAwardById($id) {
        try {
            // Begin transaction
            $this->conn->beginTransaction();
            
            // Step 1: Delete the user by id
            $sql = "DELETE FROM screen_actor_guild_awards WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            // Step 2: Reorder the id column values
            $this->reorderAwardIds();
            
            // Commit transaction
            $this->conn->commit();
        } catch (Exception $e) {
            // Rollback transaction in case of error
            $this->conn->rollBack();
            throw $e;
        }
    }

    private function reorderUserIds() {
        // Fetch all remaining users
        $sql = "SELECT id FROM users ORDER BY id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Reset the ids
        $newId = 1;
        foreach ($users as $user) {
            $sql = "UPDATE users SET id = :newId WHERE id = :oldId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':newId', $newId);
            $stmt->bindValue(':oldId', $user['id']);
            $stmt->execute();
            $newId++;
        }
    }

    private function reorderAwardIds() {
        // Fetch all remaining users
        $sql = "SELECT id FROM screen_actor_guild_awards ORDER BY id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Reset the ids
        $newId = 1;
        foreach ($users as $user) {
            $sql = "UPDATE screen_actor_guild_awards SET id = :newId WHERE id = :oldId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':newId', $newId);
            $stmt->bindValue(':oldId', $user['id']);
            $stmt->execute();
            $newId++;
        }
    }

    public function updateUserById($id, $data) {
        $sql = "UPDATE users SET name = :name, email = :email, age = :age WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':age', $data['age']);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
?>
