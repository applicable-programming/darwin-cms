<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use \modules\page\models\Page;


require_once 'full_path/sources/darwin-cms/source/src/Entity.php';
require_once 'full_path/sources/darwin-cms/source/modules/page/models/Page.php';

class FakeStmt{
    function execute() {}
    function fetchAll() {
        return [
            ['id'=> 12, 'title' => 'fake title', 'content'=>' fake content'],
            ['id'=> 2, 'title' => 'fake title2', 'content'=>' fake content2'],
            
        ];
    }
}

class FakeDatabaseConnection {
    function prepare(){
        return new FakeStmt();
    }
}


final class ActiveRecordTest extends TestCase
{
    public function testFindAll(): void
    {
        $dbc = new FakeDatabaseConnection();
        $page = new Page($dbc);
        $results = $page->findAll();
        
        $this->assertEquals(2, count($results));
        $this->assertEquals(12, $results[0]->id);
        
    }
    public function testFindBy(): void
    {
        $dbc = new FakeDatabaseConnection();
        $page = new Page($dbc);
        $page->findBy('id', 12);
        
        $this->assertEquals(12, $page->id);
        
    }
    
    public function testSave(): void 
    {
        $mockDatabase = $this->getMockBuilder(FakeDatabaseConnection::class)
                ->enableProxyingToOriginalMethods()
                 ->getMock();
        $mockDatabase->expects($this->exactly(2))
                 ->method('prepare')
                 ->with(
                        $this->logicalOr(
                            $this->equalTo('SELECT * FROM pages WHERE id = :value'),
                            $this->equalTo('UPDATE pages SET title = :title, content = :content WHERE id = :id')
                        )

                    );

        
        $page = new Page($mockDatabase);
        $page->findBy('id', 12);
        
        $page->title = "new title";
        $page->save();
        
        $this->assertEquals("new title", $page->title);
    }

}


