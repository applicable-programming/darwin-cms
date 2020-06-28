<?php

class ContactController extends Controller {
    
    function defaultAction(){
        include 'view/contact-us.html';
    }
    function submitContactFormAction() {
        // validate
        // store data
        // send email

        include 'view/contact-us-thank-you.html';
    }
    
}
