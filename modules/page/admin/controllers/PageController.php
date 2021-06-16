<?php

namespace modules\page\admin\controllers;

use modules\page\models\Page;
class PageController extends \src\Controller {
    
    function runBeforeAction() {
        if($_SESSION['is_admin'] ?? false == true){
            return true;
        }
        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if($action != 'login'){
            header('Location: /admin/index.php?module=dashboard&action=login');
        } else {
            return true;
        }
    }

    function defaultAction() {
        $variables = [];
        
        $pageHandler = new Page($this->dbc);
        $pages = $pageHandler->findAll();
        $variables['pages'] = $pages;
        $this->template->view('page/admin/views/page-list', $variables);
        
    }
    
    function editPageAction(){
        $pageId = $_GET['id'];
        $variables = [];
        
        if($_POST['action'] ?? false){
            var_dump($_POST);
        }
        
        $page = new Page($this->dbc);
        $page->findBy('id', $pageId);
        $variables['page'] = $page;
        $this->template->view('page/admin/views/page-edit', $variables);
    }
}






