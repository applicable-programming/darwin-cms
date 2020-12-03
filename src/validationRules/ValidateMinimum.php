<?php

class ValidateMinimum {
    private $minimum;
    
    public function __construct($minimum) {
        $this->minimum = $minimum;
    }


    function validateRule($value) {
         if(strlen($value) < $this->minimum){
            return false;
        }
        return true;
        
    }
    
}
