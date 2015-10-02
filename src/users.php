<?php
/*

CREATE TABLE Users(
    user_id INT AUTO_INCREMENT,
    email VARCHAR(60) UNIQUE,
    password CHAR(60),
    description VARCHAR(60),
    PRIMARY KEY (user_id))

 */

class User{
    static private $conn;

    private $id;
    private $userName;
    private $email;
    private $description;

    public static function setConnection(mysqli $newConn){
        self:: $conn = $newConn;
    }

    static public function logIn($email, $password){
        $sql = "SELECT * FROM Users WHERE email = '$email'";
        $result = self::$conn->query($sql);

        if($result == true){
            if($result->num_rows ==1){
                $row = $result->fetch_assoc();
                //var_dump($row);
                //echo self::$conn->error;
                if(password_verify($password, $row["password"])){
                    //var_dump($row);
                    $loggedUser = new User($row['user_id'], $row['email'], $row['description']);
                    return $loggedUser;
                }

            }
        }
        return false;
    }

    static public function register($newEmail, $password, $password2, $description){
        if($password != $password2){
            return false;
        }
        $hasshedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO Users(email, password, description)
                VALUES ('$newEmail', '$hasshedPassword','$description')";

        $result = self::$conn->query($sql);
        if($result == true){
            $newUser = new User(self::$conn->insert_id, $newEmail, $description);
            return $newUser;
        }

    }

    static public function getUserById($id){
        $sql = "SELECT * FROM Users WHERE user_id = $id";
        $result = self::$conn->query($sql);
        if($result == true){
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $loggedUser = new User($row['user_id'], $row['email'], $row['description']);
                return $loggedUser;
            }//to samo co przy logowaniu tylko nie sprawdzamy hasla
        }
    }

    static public function getAllUsers(){
        $ret=[];
        $sql = "SELECT * FROM Users";
        $result = self::$conn->query($slq);
        if($result == true){
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc());{
                    $loadedUser = new User($row['user_id'], $row['email'], $row['description']);
                    $ret[] = $loadedUser;
                }
            }
        }
    }

    public function __construct($newId, $newEmail, $newDescription){
        $this->id = $newId;
        $this->email = $newEmail;
        $this->setDescription($newDescription);
    }

    public function addToDB(){
        $sql = "UPDATE Users SET description='{$this->description}' WHERE user_id='{$this->id}'";
        $result = self::$conn->query($sql);
        return $result;
    }

    //stubs start here
    public function createTweet($tweetText){
        //todo: after implementing tweet add functionaly to add tweet by user
    }
    public function getAllTweet(){
        $ret = [];
        //todo: load all twweets by user to table
        return $ret;
    }
    public function createComment($commentText){
        //todo: after implementing tweet add functionaly t create a comment by user
    }
    public function getAllComments(){
    $ret = [];
    //todo: load all coments by user to table
    return $ret;
    }
    //stubs end here

    public function getId(){
        return $this->id;
    }
    public function setUserName($newUserName){
        if (is_string($newUserName) && strlen($newUserName)<60){
            $this->userName = $newUserName;
        }
    }
    public function getUserName(){
        return $this->userName;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($newDescription){
        if (is_string($newDescription) && strlen($newDescription) <255){
            $this->description = $newDescription;
        }
    }



}
