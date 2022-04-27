<?php

require 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'RecipeController');
Router::get('landing_page', 'RecipeController');
Router::get('login_page', 'DefaultController');
Router::get('register_page', 'DefaultController');
Router::get('search_page', 'RecipeController');
Router::get('recipe', 'RecipeController');
Router::get('upload_page', 'RecipeController');

Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::post('addRecipe', 'RecipeController');
Router::post('register', 'SecurityController');
Router::post('search', 'RecipeController');
Router::post('searchOutsideOfSearchPage', 'RecipeController');

Router::run($path);