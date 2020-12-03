<?php

class ValidateEmail{
    function validateRule($value) {
        
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        return true;
        
    }
    
}
