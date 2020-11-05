<?php

class PageController extends Controller{

    function defaultAction() {
        
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();
        
        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);
        $variables['pageObj'] = $pageObj;
        
        $template = new Template('default');
        $template->view('page/views/static-page', $variables);
        
    }

}
