<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);


require_once ROOT_PATH . 'src/controller.php';
require_once ROOT_PATH . 'src/template.php';


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





