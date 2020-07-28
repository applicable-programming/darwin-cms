<?php

class HomePageController extends Controller{
    function defaultAction() {
        
        // fetch the SEO
        // get the page data
        // $tiltle
        // $content
        // $variable1
        
        $variables['title'] = 'Home page Title';
        $variables['content'] = 'Welcome to our homepage';
        
        $template = new Template('default');
        $template->view('static-page', $variables);
    }
    
}
