<?php
$dbopts = parse_url(getenv('DATABASE_URL'));
$dbparams = array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
              );
ini_set("display_errors", true);
date_default_timezone_set("America/Phoenix");
define("DB_DSN", $dbparams['driver'] . ":host=" . $dbparams['host'] . ";" . $dbparams['dbname']);
define("DB_USERNAME", $dbparams['user']);
define("DB_PASSWORD", $dbparams['password']);
define("CLASS_PATH", "../objects");
define("TEMPLATE_PATH", "../templates");
define("HOMEPAGE_NUM_ARTICLES", 5);
require(CLASS_PATH . "/article.php");

function handleException($exception) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log($exception->getMessage());
}
set_exception_handler('handleException');
?>
