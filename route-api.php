<?php
require_once 'libs/Router.php';
require_once './app/Controller/ApiBooksController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('books', 'GET', 'ApiBooksController', 'obtenerLibros');
$router->addRoute('books/:ID', 'GET', 'ApiBooksController', 'obtenerLibro');
$router->addRoute('books/:ID', 'DELETE', 'ApiBooksController', 'eliminarLibro');
$router->addRoute('books', 'POST', 'ApiBooksController', 'insertarLibro');
$router->addRoute('books/:ID', 'PUT', 'ApiBooksController', 'actualizarLibro');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
