<?php
define('DS', DIRECTORY_SEPARATOR);
define('SITE', 'site');
define('WEB_DIR', 'web');
defined('UPLOAD_DIR') or define('UPLOAD_DIR', 'upload');
define('WWW_DIR', 'www');
defined('FRONTEND') or define('FRONTEND', 'frontend');
defined('BACKEND') or define('BACKEND', 'backend');
defined('COMMON') or define('COMMON', 'common');

define('THEME_DIR', 'themes');

/* Define default theme folder */
define('DEFAULT_FRONTEND_THEME', 'aha');
define('DEFAULT_BACKEND_THEME', 'metronic');
define('ENABLE_CUSTOM_GENERATOR', true);

if (!isset($root_dir)) $root_dir = dirname(dirname(dirname(__FILE__)));
if (!isset($root_dir_name)) $root_dir_name = basename($root_dir);
define('ROOT_FOLDER_NAME', $root_dir_name);

Yii::setAlias('@' . UPLOAD_DIR, $root_dir . DS . BACKEND . DS . WEB_DIR . DS . UPLOAD_DIR);
Yii::setAlias('@' . SITE, $root_dir);
