<?php
session_start();
require_once 'src/controller.php';


// if / else logic 

$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';



if ($section=='about-us') {
    
    include 'controller/aboutUsPage.php';
    
    $aboutController = new AboutUsController();
    $aboutController->runAction($action);
    
} else if ($section == 'contact'){
    
    include 'controller/contactPage.php';
    $contactController = new ContactController();
    $contactController->runAction($action);
    
} else {
    include 'controller/homePage.php';
}





