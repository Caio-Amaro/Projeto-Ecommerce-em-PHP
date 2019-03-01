
<?php

use \Hcode\Page;

use \Hcode\PageAdmin;

use \Hcode\Model\User;

use \Hcode\Model\Category;

// Rotas para administrar as categorias do site

$app->get("/admin/categories", function(){

	User::VerifyLogin();

	$categories = Category::listAll();

	$page = new PageAdmin();

	$page->setTpl("categories", array(

		"categories"=>$categories
	));

});

$app->get("/admin/categories/create", function(){

	User::VerifyLogin();

	$page = new PageAdmin();

	$page->setTpl("categories-create");

});

$app->post("/admin/categories/create", function(){

	User::VerifyLogin();

	$category = new Category();

	$category->setData($_POST);

	$category->save();

	header("location: /admin/categories");

	exit;
	

});

$app->get("/admin/categories/:idcategory/delete", function($idcategory){

	User::VerifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->delete();

	header("location: /admin/categories");

	exit;

});

$app->get("/admin/categories/:idcategory", function($idcategory)
{
	User::VerifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update", [

		"category"=>$category->getvalues()
	]);


});

$app->post("/admin/categories/:idcategory", function($idcategory)
{
	User::VerifyLogin();
	
	$category = new Category();

	$category->get((int)$idcategory);

	$category->setdata($_POST);

	$category->save();

	header("location: /admin/categories");

	exit;

	

});

$app->get("/categories/:idcategory", function($idcategory){

	$category = new Category();

	$category->get((int) $idcategory);

	$page = new Page();

	$page->setTpl("category", [
		"category" => $category->getValues(),
		"products"=>[]
	]);

});

?>
