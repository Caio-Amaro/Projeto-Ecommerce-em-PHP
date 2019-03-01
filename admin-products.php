<?php

use \Hcode\PageAdmin;

use \Hcode\Model\User;

use \Hcode\Model\Product;

// Rotas para administração dos produtos

$app->get("/admin/products", function(){

    User::verifyLogin();

    $products = Product::listAll();

    $page = new pageAdmin();

    $page->setTpl('products', [
        "products"=>$products
    ]);

});

$app->get("/admin/products/create", function(){

    User::verifyLogin();

    $page = new pageAdmin();

    $page->setTpl("products-create");

});

$app->post("/admin/products/create", function(){

    User::verifyLogin();

   $product = new Product();

   $product->setData($_POST);

   $product->save();

   header("Location: /admin/products");

   exit;

});

$app->get("/admin/products/:idproduct", function($idproduct){

    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idproduct);

    $page = new pageAdmin();

    $page->setTpl("products-update", [

        'product'=>$product->getValues()
    ]);

});

$app->post("/admin/products/:idproduct", function($idproduct){

    User::verifyLogin();

    $product = new Product();

    $product->get((int)$idproduct);

   $product->setData($_POST);

   $product->save();

   $product->setPhoto($_FILE["name"]);

   header ("Location: /admin/products");

   exit;


});





?>