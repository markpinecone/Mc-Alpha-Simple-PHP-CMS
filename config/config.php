<?php

define('PROJECT_DIR', dirname(__FILE__, 2));
define('CONFIG_DIR', dirname(__FILE__));
define('INCLUDE_DIR', PROJECT_DIR . '/includes');
define('FUNCTIONS_DIR', PROJECT_DIR . '/functions');
define('PUBLIC_DIR', PROJECT_DIR . '/public');
define('INSTALL_DIR', PROJECT_DIR . '/public/install');
define('FORMS_DIR', PROJECT_DIR . '/views/forms');
define('VIEWS_DIR', PROJECT_DIR . '/views');

//-----------------------------------------------------------

//INCLUDE Functions
require_once FUNCTIONS_DIR . '/Blog/blog.func.php';
require_once FUNCTIONS_DIR . '/DB/db.func.php';
require_once FUNCTIONS_DIR . '/Helper/helper.func.php';
require_once FUNCTIONS_DIR . '/Other/other.func.php';
require_once FUNCTIONS_DIR . '/Pages/pages.func.php';
require_once FUNCTIONS_DIR . '/Table/table.func.php';
require_once FUNCTIONS_DIR . '/User/user.func.php';
require_once FUNCTIONS_DIR . '/Validation/validation.func.php';
// require_once FUNCTIONS_DIR . '/';


//Include DB connector
require_once INCLUDE_DIR . '/dbh.inc.php';