<?php

/*
* Idk what is this :P
*/
ob_start();
session_start();

/*
* Show Errors
*/
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(~0);

/*
* Helper
*/
require_once __DIR__ . '/classes/Helper.php';

$helper = new Helper(__DIR__ . '/classes/Class-Collection');

/*
* Database
*/

require_once __DIR__ . '/classes/PdoDb.php';

$db = new PdoDb('localhost', 'root', '', 'liman');

/*
* Caching
*/

require_once __DIR__ . '/classes/CatcHe.php';

$cache = new CatcHe(getcwd() . '/tmp');

/*
* Url
*/
require_once __DIR__ . '/classes/url.php';

$url = new url();

$address = $url->getSegments();

/**
* Configuration
*/
$config = array();

$config['url'] = 'http://localhost/';
$config['api'] = $config['url'] . 'api/';
$config['assets'] = $config['url'] . 'assets/';

/* For Template Partial */
$config['partial'] = '';
$config['partialHeader'] = '';
$config['partialNavbar'] = '';
$config['partialSidebar'] = '';
$config['partialBody'] = '';
$config['partialScriptDefault'] = '';
$config['partialScript'] = '';

/*
* Language
*/
$langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$userLang = strtolower($langs[0]);
$userLangFile = getcwd() . '/locales/'. $userLang . '.php';
if(!file_exists($userLangFile)){
    include getcwd() . '/locales/en.php';
}else{ include $userLangFile; }

/*
* User
*/
$member = array();
if(isset($_SESSION['session']) && isset($_SESSION['mid'])){

    $db->where("id", $_SESSION['mid']);
    $member = $db->getOne("members");

    $db->disconnect();

}

?>