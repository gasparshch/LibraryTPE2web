<?php
require_once 'libs/Router.php';
require_once 'Controller/ApiBooksController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('books', 'GET', 'ApiBooksController', 'obtenerLibros');
$router->addRoute('books/:ID', 'GET', 'ApiBooksController', 'obtenerTarea');
$router->addRoute('books/:ID', 'DELETE', 'ApiBooksController', 'eliminarTarea');
$router->addRoute('books', 'POST', 'ApiBooksController', 'insertarTarea');
$router->addRoute('books/:ID', 'PUT', 'ApiBooksController', 'actualizarTarea');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
