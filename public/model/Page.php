<?php

class Page extends Entity {
    
    public function __construct($dbc) {
        $this->dbc = $dbc;
         
        $this->tableName = 'pages';
        
        $this->fields = [
            'id',
            'title',
            'content'
        ];
    }
    
}