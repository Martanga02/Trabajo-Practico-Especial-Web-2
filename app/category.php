<?php
require_once 'db_category.php';
//Se incluye el archivo db_task.php, que probablemente contiene funciones para interactuar con la base de datos,
//como getCategory, insertCategory, eraseCategory, y updateCategory.

function showCategory() {
    require './templates/header.php';
    require './templates/form_alta.php';

    // obtengo las tareas de la DB
    $categorys = getCategorys();
    ?>

    <ul class="list-group">
    <?php foreach($categorys as $category) { ?>
        <li class="list-group-item item-task">
            <div class="label">
                <b><?= $category->Nombre ?></b>
            </div>
            <div class="actions">
                <?php if(!$category->Descripción) { ?> <a href="agregar/<?= $category->ID_Categoria ?>" class='btn btn-sm btn-success ml-auto'>AGREGAR</a> <?php } ?>
                <a class="btn btn-sm btn-danger" href="eliminar/<?= $category->ID_Categoria ?>">ELIMINAR</a>
            </div>
        </li>
    <?php }

    require './templates/footer.php';
}
//Esta función showTasks se encarga de mostrar todas las tareas.
//Primero, incluye el encabezado y un formulario (probablemente para agregar nuevas tareas).
//Luego, llama a getCategory() para obtener las tareas de la base de datos.
//Muestra cada tarea en una lista desordenada (<ul>), generando un elemento de lista (<li>) por cada tarea.
//Incluye botones para finalizar o eliminar cada tarea, dependiendo de su estado (finalizada).

function addCategory() {
    if (!isset($_POST['title']) || empty($_POST['title'])) {
        echo "<h1>Error: falta completar el titulo</h1>";
        return;
    }

    if (!isset($_POST['priority']) || empty($_POST['priority'])) {
        echo "<h1>Error: falta completar la prioridad</h1>";
        return;
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];

    $ID_Categoria = insertCategory($title, $description, $priority);

    // redirijo al home
    header('Location: ' . BASE_URL);
}
//La función addTask maneja la creación de nuevas tareas.
//Verifica si el título y la prioridad están presentes en la solicitud POST; si no, muestra un mensaje de error.
//Si ambos están presentes, obtiene estos datos y llama a insertCategory para agregar la tarea a la base de datos.
//Finalmente, redirige al usuario a la página principal (BASE_URL).

function deleteCategory($ID_Categoria) {
    // obtengo la tarea por id
    $category = getTask($ID_Categoria);

    if (!$category) {
        echo "<h1>No existe la categoria con el id=$ID_Categoria</h1>";
        return;
    }

    // borro la tarea y redirijo
    eraseCategory($ID_Categoria);
    header('Location: ' . BASE_URL);
}
//La función deleteTask elimina una tarea específica.
//Toma el ID de la tarea a eliminar y llama a getTask para verificar si la tarea existe.
//Si no existe, muestra un mensaje de error.
//Si existe, llama a eraseCategory para eliminar la tarea de la base de datos y redirige al usuario a la página principal.


function finishCategory($ID_Categoria) {
    $category = getTask($ID_Categoria);

    if (!$category) {
        echo "<h1>No existe la categoria con el id=$ID_Categoria</h1>";
        return;
    }

    updateCategory($ID_Categoria);
    header('Location: ' . BASE_URL);
}
//La función finishCategory marca una tarea como finalizada.
//Similar a la función de eliminar, primero verifica si la tarea existe.
//Si existe, llama a updateCategory para cambiar el estado de la tarea y redirige al usuario a la página principal.


