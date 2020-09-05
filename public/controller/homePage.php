<?php

class HomePageController extends Controller{
    function defaultAction() {
        
        // fetch the SEO
        // get the page data
        // $tiltle
        // $content
        // $variable1
        $variables = [];
        //$variables['title'] = 'Home page Title';
        //$variables['content'] = 'Welcome to our homepage';
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();
        $pageObj = new Page($dbc);
        $pageObj->find(1);
        $variables['pageObj'] = $pageObj;
        
        
        $template = new Template('default');
        $template->view('static-page', $variables);
    }
    
}
