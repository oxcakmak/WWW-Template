<?php

require_once getcwd() . '/core/loader.php';

if($address){
    
    if($address && $address[0] === "api"){
        include __DIR__ . '/api/'.$address[1].'.php';
    }else{
		$page = __DIR__ . '/pages/'.$address[0].'.php';
		if(file_exists($page)){
			include $page;
		}else{
			include __DIR__ . '/pages/error.php';
		}
    }
    
}else{ include __DIR__ . '/pages/index.php'; }

?>