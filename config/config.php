<?php

// Definējam projeta direktorijas šeit.
// Config failu ielādējam katrā failā lai izmantotu šīs konstantes "require_once '../vendor/autoload.php';"
// Uzstādot projektu jāizpilda "composer install" iekš projekta direktorijas lai sagatavotu autoloader.

define('PROJECT_DIR', dirname(__FILE__, 2));
define('CONFIG_DIR', dirname(__FILE__));
define('INCLUDE_DIR', PROJECT_DIR . '/includes');
define('FUNCTIONS_DIR', PROJECT_DIR . '/functions');
define('PUBLIC_DIR', PROJECT_DIR . '/public');
//-----------------------------------------------------------



