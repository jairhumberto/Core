<?php
/**
 * Squille PHP Framework
 * @version: 1.0.0
*/

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_DIR', substr(__DIR__, 0, strrpos(__DIR__, 'vendor')));

define('CONFIG_DIR', ROOT_DIR . 'config' . DS);
define('PUBLIC_DIR', ROOT_DIR . 'public' . DS);
define('SOURCE_DIR', ROOT_DIR . 'source' . DS);
define('VENDOR_DIR', ROOT_DIR . 'vendor' . DS);

define('SQUILLE_DIR', VENDOR_DIR . 'Squille' . DS);
define('CORE_DIR', SQUILLE_DIR . 'Core' . DS);
