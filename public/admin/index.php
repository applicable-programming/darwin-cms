<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'jh3245hgdfv8934hu3nvr4h5i');

// TODO: move to autoInclude

require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once ROOT_PATH . 'src/Validation.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMinimum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMaximum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateEmail.php';
require_once ROOT_PATH . 'src/validationRules/ValidateSpecialCharacter.php';
require_once MODULE_PATH . 'page/models/Page.php';
require_once MODULE_PATH . 'user/models/User.php';



// Bootstrap
/* Connect to a MySQL database using driver invocation */
DatabaseConnection::connect('localhost', 'darwin_cms', 'root', '');



// if / else logic 

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';



if ($module=='dashboard') {
    
    include MODULE_PATH . 'dashboard/admin/controllers/DashboardController.php';
    
    $dashboardController = new DashboardController();
    $dashboardController->runAction($action);
    
}