<?php
class Page {
    private $id;
    public $title;
    public $content;
    private $dbh;
    
    public function __construct($dbh) {
        $this->dbh = $dbh;
    }
    
    public function find($id) {
        

        $stmt = $this->dbh->prepare("SELECT * FROM pages WHERE id=:id");
        $stmt->execute(['id' => $id]); 
        $pageData = $stmt->fetch();
        
        $this->id = $pageData['id'];
        $this->title = $pageData['title'];
        $this->content = $pageData['content'];
        
    }
}
