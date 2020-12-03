<?php

class Validation {
    
    private $rules; 
    
    public function addRule($rule) {
        $this->rules[] = $rule;
        return $this;
    }
    
    public function validate($value) {
        foreach ($this->rules as $rule) {
            $ruleValidation = $rule->validateRule($value);
            if(!$ruleValidation){
                return false;
            }
        }
        
        return true;
    }
}