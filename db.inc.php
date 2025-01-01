<?php
define('DBHOST', 'localhost');
define('DBNAME', 'stickyrentals');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBCONNSTRING',"mysql:host=". DBHOST. ";dbname=". DBNAME);
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
?>