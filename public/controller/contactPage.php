<?php

class ContactController extends Controller {
    
    function runBeforeAction(){
        
        if($_SESSION['has_submitted_the_form'] ?? 0 == 1){   
            
            include 'view/contact/contact-us-already-contacted.html';
            return false;
        }
        return true;
    }
    
    function defaultAction(){
        include 'view/contact/contact-us.html';
    }
    function submitContactFormAction() {
       
        
        
        // validate
        // store data
        // send email
        
        $_SESSION['has_submitted_the_form'] = 1;

        include 'view/contact/contact-us-thank-you.html';
    }
    
}
