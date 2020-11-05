<?php

class Router extends Entity {
    
    public function __construct($dbc) {
        parent::__construct($dbc, 'routes');
        
    }
    protected function initFields() {
        
        $this->fields = [
            'id',
            'module',
            'action',
            'entity_id',
            'pretty_url'
            
        ];
    }
    
}