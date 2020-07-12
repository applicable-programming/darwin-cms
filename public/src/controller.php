<?php

class Controller {
    //put your code here
    
    function runAction($actionName) {
        
        if(method_exists($this, 'runBeforeAction')){
            $result = $this->runBeforeAction();
            if($result == false) {
                return;
            }
        }
        
        $actionName .= 'Action';
        if (method_exists($this, $actionName)){
            $this->$actionName();
        } else {
            include 'view/status-pages/404.html';
        }
        
    }
}
