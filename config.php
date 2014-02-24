<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('LIBS', 'libs/');
define('TEMPDIR', '/');
define('URL', 'http://' . $_SERVER['HTTP_HOST'] . TEMPDIR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . TEMPDIR);
define('CACHE', ROOT . 'cache/');
define('UPLOAD', URL . 'uploads/');

define('DB_TYPE', '');
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_PREFIX', 'vips_');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', '');

// This is for database passwords only
define('HASH_PASSWORD_KEY', '');
define('NUMPP', 35);

