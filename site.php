<?php

use \Hcode\Page;

//Rota para página principal do site

$app->get('/', function() {
    
	$page = new Page();
	$page->setTpl("index");

	
});



?>