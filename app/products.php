<?php
require_once 'db_products.php';
//Se incluye el archivo db_task.php, que probablemente contiene funciones para interactuar con la base de datos,
//como getProduct, insertProduct, eraseProduct, y updateProduct.

function showProducts() {
    require './templates/header.php';
    require './templates/form_alta.php';

    // obtengo las tareas de la DB
    $products = getProducts();
    ?>

    <ul class="list-group">
    <?php foreach($products as $product) { ?>
        <li class="list-group-item item-task">
            <div class="label">
                <b><?= $product->Nombre ?></b>
            </div>
            <div class="actions">
                <?php if(!$product->Descripción) { ?> <a href="agregar/<?= $category->ID_Categoria ?>" class='btn btn-sm btn-success ml-auto'>AGREGAR</a> <?php } ?>
                <a class="btn btn-sm btn-danger" href="eliminar/<?= $product->ID_Producto ?>">ELIMINAR</a>
            </div>
        </li>
    <?php }

    require './templates/footer.php';
}
//Esta función showProducts se encargue de COMPLETAR.
//Primero, incluye el encabezado y un formulario (probablemente para agregar nuevas tareas).
//Luego, llama a getCategory() para obtener las tareas de la base de datos.
//Muestra cada tarea en una lista desordenada (<ul>), generando un elemento de lista (<li>) por cada tarea.
//Incluye botones para finalizar o eliminar cada tarea, dependiendo de su estado (finalizada).

function addProduct() {
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
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $ID_Producto = insertProduct($title, $description, $price, $quantity);

    // redirijo al home
    header('Location: ' . BASE_URL);
}
//La función addTask maneja la creación de nuevas tareas.
//Verifica si el título y la prioridad están presentes en la solicitud POST; si no, muestra un mensaje de error.
//Si ambos están presentes, obtiene estos datos y llama a insertCategory para agregar la tarea a la base de datos.
//Finalmente, redirige al usuario a la página principal (BASE_URL).

function deleteProduct($ID_Producto) {
    // obtengo la tarea por id
    $product = getProduct($ID_Producto);

    if (!$product) {
        echo "<h1>No existe el producto con el id=$ID_Producto</h1>";
        return;
    }

    // borro el producto y redirijo
    eraseProduct($ID_Producto);
    header('Location: ' . BASE_URL);
}
//La función deleteTask elimina una tarea específica.
//Toma el ID de la tarea a eliminar y llama a getTask para verificar si la tarea existe.
//Si no existe, muestra un mensaje de error.
//Si existe, llama a eraseCategory para eliminar la tarea de la base de datos y redirige al usuario a la página principal.


function finishProduct($ID_Producto) {
    $product = getProduct($ID_Producto);

    if (!$product) {
        echo "<h1>No existe el producto con el id=$ID_Categoria</h1>";
        return;
    }

    updateProduct($ID_Producto);
    header('Location: ' . BASE_URL);
}
//La función finishCategory marca una tarea como finalizada.
//Similar a la función de eliminar, primero verifica si la tarea existe.
//Si existe, llama a updateCategory para cambiar el estado de la tarea y redirige al usuario a la página principal.


