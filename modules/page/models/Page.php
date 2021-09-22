<?php
namespace modules\page\models;
class Page extends \src\Entity {
    
    public function __construct($dbc) {
        parent::__construct($dbc, 'pages');
    }
    
    protected function initFields() {
       $this->fields = [
            'title',
            'content'
        ];
    }
    
}