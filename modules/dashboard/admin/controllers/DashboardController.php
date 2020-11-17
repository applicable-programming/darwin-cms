<?php

class DashboardController extends Controller {
    
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
        
        echo "Welcome to the administration";
        
    }
    
    function loginAction() {
        
        if($_POST['postAction'] ?? 0 == 1){
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $auth = new Auth();
            if($auth->checkLogin($username, $password)){
               // all is good
                $_SESSION['is_admin'] = 1;
                header('Location: /admin/');
                exit();
            }
            
            var_dump('bad login');
        }
        
        
        
        include VIEW_PATH . 'admin/login.html';
    }

}
