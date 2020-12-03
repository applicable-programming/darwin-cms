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
            
            $validation = new Validation();
            if(!$validation
                    ->addRule(new ValidateMinimum(3))
                    ->addRule(new ValidateMaximum(20))
                    ->addRule(new ValidateSpecialCharacter())
                    ->validate($password)
                    ) {
                
                $_SESSION['validationRules']['error'] = "Password must be between 3 and 20 characters"
                        . " and must contain one special character";
            }
            
            if(!$validation
                    ->addRule(new ValidateMinimum(3))
                    ->addRule(new ValidateEmail())
                    ->validate($username)
                    ) {
                $_SESSION['validationRules']['error'] = "Username is not valid email";
            }
            
            if(($_SESSION['validationRules']['error'] ?? '') == ''){
                $auth = new Auth();
                if($auth->checkLogin($username, $password)){
                   // all is good
                    $_SESSION['is_admin'] = 1;
                    header('Location: /admin/');
                    exit();
                }

                $_SESSION['validationRules']['error'] = "Username or password is incorect";
            }

        }
        
        
        
        include VIEW_PATH . 'admin/login.html';
        unset($_SESSION['validationRules']['error']);
    }

}
