<?php
session_start();
if(!defined('ROOT_DIR')){
define('ROOT_DIR', '');
};
$dbname = "sospartner";
$user   = "joris";
$pass   = "jorisprod";

try {
    $BDD = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
} catch(PDOException $e) {
    die($e->getMessage());
}

$BDD->exec("SET CHARACTER SET utf8");
?>