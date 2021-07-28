<?php
/**
 * A singleton class is another type of utility class which is similar to a static class in that you do not need to create a new instance of the class every time you use it. However, a singleton class does require an instance of the class. What makes a singleton class different is that a new instance of the class is defined with a private constructor method and is only defined once, inside of the class. This instance is then stored in a static property and static getter methods are used to access it.
 * 
 * The advantage of using singletons is that an object which needs to be referenced many times only needs to be instantiated once, which improves performance. Singletons are frequently used to connect to databases to avoid creating multiple database connections unnecessarily. We will create a singleton class to connect to our database using PDO.
 * 
 * Our application will use a database with two columns, one for the ID and one for serialized, encoded PHP objects which are stored as a BLOB type.
 */
class Connector {
    private static $instance = null;
    private $pdo;
    private $host;
    private $name;
    private $user;
    private $password;

    private function __construct() {
        $this->host = "localhost";
        $this->name = "Villains";
        $this->user = "root";
        // In XAMPP and MAMP the default user is "root"
        $this->password = "";
        // In XAMPP the password is blank
        // In MAMP you must set a password
        // The default password in MAMP is root

        $this->pdo = new PDO(
            'mysql:host=' . $this->host .
            ';dbname=' . $this->name,
            $this->user,
            $this->password
        );
    }

    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new Connector();
        }
        return self::$instance;
    }

    public function get_pdo() {
        return $this->pdo;
    }
}