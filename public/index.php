<?php
session_start();






// Bootstrapping
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);


require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'model/Page.php';

DatabaseConnection::connect('localhost', 'darwin_cms', 'root', '');


/*
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=darwin_cms', 'root', '');
        } catch (PDOException $e) {
            print "Error!: Database connection error";
            die();
        }
        
*/
// if / else logic 

$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';



if ($section=='about-us') {
    
    include ROOT_PATH . 'controller/aboutUsPage.php';
    
    $aboutController = new AboutUsController();
    $aboutController->runAction($action);
    
} else if ($section == 'contact'){
    
    include ROOT_PATH . 'controller/contactPage.php';
    $contactController = new ContactController();
    $contactController->runAction($action);
    
} else {
    include ROOT_PATH . 'controller/homePage.php';
    $homePageController = new HomePageController();
    $homePageController->runAction($action);
    
}





