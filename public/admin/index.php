<?php
session_start();

use src\DatabaseConnection;
use src\Template;
use modules\page\admin\controllers\PageController;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'jh3245hgdfv8934hu3nvr4h5i');

// TODO: move to autoInclude

spl_autoload_register(function ($class_name) {
    
     $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

require '../../vendor/autoload.php';


// Bootstrap
/* Connect to a MySQL database using driver invocation */
DatabaseConnection::connect('localhost', 'darwin_cms', 'root', '');



// if / else logic 

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();
        
        

if ($module=='dashboard') {
    
    include MODULE_PATH . 'dashboard/admin/controllers/DashboardController.php';
    
    $dashboardController = new DashboardController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    
} elseif($module = 'page') {
    
    include MODULE_PATH . 'page/admin/controllers/PageController.php';
    
    // create a log channel
    $log = new Logger('name');
    $log->pushHandler(new StreamHandler('pages.log', Logger::WARNING));
            
    $pageController = new PageController();
    $pageController->log = $log;
    $pageController->dbc = $dbc;
    $pageController->template = new Template('admin/layout/default');
    $pageController->runAction($action);
    
}
