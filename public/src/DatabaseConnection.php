<?php
/**
 * Singleton
 * @Purpose: Restrict number of objects created from one class to only ONE object
 * @Usage: single database connection, log to a (single) file, lock one file in the system, external API
 * @Disadvantages: Difficult control, "magic" behavior, difficult to test programmatically.
 * Anti-pattern and basically a bad practice because it creates global variables,
 * consider using Dependency Injection instead
 * @Implementation: Set constructor, clone and wake up methods to private (forbid access from outside),
 * have a single static getInstance() method that will create OR retrieve object
 *
 * final keyword prevents this class from being extended
 */
final class DatabaseConnection
{
    private static $instance = null;
    private static $connection;

    /**
     * We return existing instance if it exists, if not we create one
     */
    public static function getInstance(): DatabaseConnection
    {
        if (is_null(self::$instance)) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }
    /**
     * Having constructor public will allow creating multiple instances of this class
     * Since this is a singleton type, we prevent creating more objects of this class by using private
     * Only way to get this object of this class is to use Singleton::getInstance()
     */
    private function __construct() {}

    /**
     * Cloning creates a new instance of this object https://www.php.net/manual/en/language.oop5.cloning.php
     * When an object is cloned, PHP will perform a shallow copy of all of the object's properties.
     * Any properties that are references to other variables will remain references.
     * We do not want another object for Singleton, so we prevent that by using private
     */
    private function __clone() {}

    /**
     * We want to prevent __wakeup() from making another instance of this object, by making the method private
     * When you serialize an object, __sleep() is used to cleanup and free the object from connections and tasks
     * When you un-serialize and object, __wakeup() is used to re-establish connections back, like connections to
     * the file or the database, as well as restoring some other resources.
     * https://www.php.net/manual/en/language.oop5.magic.php#object.wakeup
     */
    private function __wakeup() {}

    /**
     * This will be called once in our application, when we first time connect to the database
     * @param $host
     * @param $database
     * @param $user
     * @param $password
     */
    public static function connect($host, $database, $user, $password) {
        // we connect to the database, something like
        self::$connection = new PDO("mysql:host={$host};dbname={$database}", $user,$password);
    }

    public function getConnection()
    {
        return self::$connection;
    }


}
