<?php 

session_start();

require_once("vendor/autoload.php");




use \Slim\Slim;

use \Hcode\Page;

use \Hcode\PageAdmin;

use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Page();
	$page->setTpl("index");

	
});

$app->get('/admin', function() {

	User::VerifyLogin();
    
	$page = new PageAdmin();
	$page->setTpl("index");

	
});

$app->get('/admin/login', function(){

		$page = new PageAdmin([

			"header" => false,
			"footer" => false
		]);
	
		$page->setTpl("login");

});

$app->post("/admin/login", function(){

	User::login($_POST['login'], $_POST['password']);

	header("Location: /admin");

	exit;
});

$app->get("/admin/logout", function(){

	User::logout();
	
	header("location: /admin/login");
});

$app->get("/admin/users", function(){

	User::VerifyLogin();

	$users = User::listAll();

	$page = new PageAdmin();
	
	$page->setTpl("users", array (
		"users"=>$users
	));

});

$app->get("/admin/users/create", function(){

	User::VerifyLogin();

	$page = new PageAdmin();
	
	$page->setTpl("users-create");

});

$app->get("/admin/users/:iduser/delete", function($iduser){

	User::VerifyLogin();

});

$app->get("/admin/users/:iduser", function($iduser){

	User::VerifyLogin();

	$page = new PageAdmin();
	
	$page->setTpl("users-update");

});

$app->post("/admin/users/create", function(){

	User::VerifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$user->setData($_POST);

	$user->save();

	header("location: /admin/users");

	exit;
});

$app->post("/admin/users/:iduser", function($iduser){

	User::VerifyLogin();

	

});





$app->run();

 ?>