# WWW Template
Simple template system

## Support Me

This software is developed during my free time and I will be glad if somebody will support me.

Everyone's time should be valuable, so please consider donating.

[https://buymeacoffee.com/oxcakmak](https://buymeacoffee.com/oxcakmak)

### Introduction

WWW Template is a non-framework structure that I use in my projects and that allows for easy integration.

### Usage
You can duplicate the api part as per your own.
```php
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
```

### Workflow

The working structure is actually very simple.
* First of all, database connection is provided.
* Classes or functions are included in the database file and the loader file.
* Loader is called in the partial section (Template management.
* Partial is also called in pagination.
* Loader is called in API sections.

In short, the loader file includes the most important files in the project and makes it easier to use everywhere, for example, when you want to check the IP when a user is going to register, you can handle it with the IP class or function library you have written, both in the registration (let's say register.php) where the template is used and in the post (or your API endpoint) section, without calling it over and over again, through a single file. 

---

![image](https://github.com/user-attachments/assets/ca374fbe-8c65-415c-b212-31a75d894a5d)



