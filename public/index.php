<?php



// if / else logic 

$section = $_GET['section'] ?? 'home';


if ($section=='about-us') {
    
    include 'controller/aboutUsPage.php';
} else if ($section == 'contact'){
    include 'controller/contactPage.php';
} else {
    include 'controller/homePage.php';
}





