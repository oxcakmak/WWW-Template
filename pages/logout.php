<?php

require_once getcwd() . '/core/loader.php';

if(isset($_SESSION['session'])){
    unset($_SESSION['session']);
    unset($_SESSION['mid']);
}

header("location: " . $config['url']);

?>