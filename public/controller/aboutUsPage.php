<?php

class AboutUsController extends Controller{
    function defaultAction() {
        
        $variables['title'] = 'About us page';
        $variables['content'] = 'About us content of the page';
        
        $template = new Template('default');
        $template->view('static-page', $variables);
        
    }
    
}
