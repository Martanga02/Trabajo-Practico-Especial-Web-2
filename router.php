<?php
require_once './app/category.php';
//Se incluye el archivo task.php, que probablemente contiene las funciones
//necesarias para manejar las tareas (como showTasks, addTask, deleteTask, y finishTask).

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
//Se define una constante BASE_URL que genera una URL base para la aplicación. Esto se utiliza para redirigir a diferentes partes de la aplicación.
//$_SERVER['SERVER_NAME'] obtiene el nombre del servidor.
//$_SERVER['SERVER_PORT'] obtiene el puerto del servidor.
//dirname($_SERVER['PHP_SELF']) obtiene el directorio actual del script que se está ejecutando.

$action = 'listar'; // accion por defecto si no se envia ninguna
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}
//Se establece una variable $action con el valor 'listar' como acción por defecto.
//Si hay un parámetro action en la URL ($_GET['action']), se asigna su valor a $action.

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);
//Se separa la cadena $action en partes usando '/' como delimitador, almacenando el resultado en el arreglo $params.
//Esto permite manejar acciones con parámetros. Por ejemplo, finalizar/1 separaría en ['finalizar', '1'].

switch ($params[0]) {
    case 'listar':
        showCategory();
        break;
    case 'nueva':
        addCategory();
        break;
    case 'eliminar':
        deleteCategory($params[1]);
        break;
    case 'finalizar':
        finishCategory($params[1]);
        break;
    default:
        echo "404 Page Not Found";
        break;
}
//Se utiliza un switch para determinar qué acción realizar basándose en el primer parámetro ($params[0]).
//case 'listar':: Llama a showTasks() para mostrar todas las tareas.
//case 'nueva':: Llama a addTask() para agregar una nueva tarea.
//case 'eliminar':: Llama a deleteTask() pasando el segundo parámetro como ID de la tarea a eliminar.