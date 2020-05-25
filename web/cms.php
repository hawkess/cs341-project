<?php
ini_set("log_errors", true);
error_reporting(E_ALL);
ini_set("display_errors", true);

$dbopts = parse_url(getenv('DATABASE_URL'));
$dbparams = array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
              );
date_default_timezone_set("America/Phoenix");
define("DB_DSN", $dbparams['driver'] . ":host=" . $dbparams['host'] . ";dbname=". $dbparams['dbname']);
define("DB_USERNAME", $dbparams['user']);
define("DB_PASSWORD", $dbparams['password']);
define("HOMEPAGE_NUM_ARTICLES", 5);
require("../objects/article.php");

function handleException($exception) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log($exception->getMessage());
}
set_exception_handler('handleException');
?>
