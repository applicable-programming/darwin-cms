<?php

class ValidateSpecialCharacter implements ValidationRuleInterface{
    private $rule;
    
    public function __construct($rule = "/[^a-zA-Z0-9]+/") {
        $this->rule = $rule;
    }


    function validateRule($value) {
        if(!preg_match($this->rule, $value)){
            return false;
        }
        return true;
    }

    public function getErrorMessage() {
        return "Special character is not found";
    }

}
