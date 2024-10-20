<?php

require_once './app/controllers/productos.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new ProductosController();
        $controller->showhome();
        break;

    case 'productos':
        $controller = new ProductosController();
        $controller->showProductos();
        break;

    case 'producto':
        $controller = new ProductosController();
        $controller->showProductoEspecifico($params[1]);
        break;

    case 'agregar':
        $controller = new ProductosController();
        $controller->showAgregarProductos();
        break;

    case 'agregado':
        $controller = new ProductosController();
        $controller->addProducto();
        break;

    case 'eliminar':
        $controller = new ProductosController();
        $controller->deleteProducto($params[1]);
        break;

    case 'editar':
        $controller = new ProductosController();
        $controller->showEditar($params[1]);
        break;

    case 'editado':
        $controller = new ProductosController();
        $controller->editProducto($params[1]);
        break;

    case 'categoria':
        $controller = new ProductosController();
        $controller->mostrarProductosXCategoria($params[1]);
        break;

    case 'categorias':
        $controller = new ProductosController();
        $controller->mostrarCategorias();
        break;

    case 'eliminarCategoria':
        $controller = new ProductosController();
        $controller->deleteCategoria($params[1]);
        break;

    case 'AgregarCategoria':
        $controller = new ProductosController();
        $controller->showAgregarCategoria();
        break;

    case 'CategoriaCreada':
        $controller = new ProductosController();
        $controller->addCategoria();
        break;

    case 'EditarCategoria':
        $controller = new ProductosController();
        $controller->showEditarCategoria($params[1]);
        break;

    case 'categoriaEditada':
        $controller = new ProductosController();
        $controller->editCategoria($params[1]);
        break;

    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
        
    default:
        $controller = new ProductosController();
        $controller->showError();
        break;
}

/*Este código actúa como el enrutador de la aplicación,
determinando qué controlador y método deben ser invocados en
función de la acción solicitada en la URL. Esto permite que
la aplicación maneje diferentes funcionalidades de manera estructurada y modular. */