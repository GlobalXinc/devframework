<?php
// nama server web
define('DBHOST', 'localhost');
// nama user konek ke database server
define('DBUSER', 'root');
// password konek ke server database, jika ada!
define('DBPASS', '');
// nama database di server phpmyadmin
define('DBNAME', 'ai');

// alamat web di install/dijalankan...
define('___URL', 'http://manager.test');
define('___ASSETS', ___URL . '/assets');
define('___MEDIA', ___ASSETS . '/files');

// error_reporting(0);

// atur jam Indonesia ke WIB
date_default_timezone_set("Asia/Jakarta");