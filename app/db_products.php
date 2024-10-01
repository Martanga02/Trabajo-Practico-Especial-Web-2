<?php

function getConnection() {
   return new PDO('mysql:host=localhost;dbname=almacen;charset=utf8', 'root', '');
}

function getProducts() {
   // 1. Abro la conexión
   $db = getConnection();

   // 2. Ejecuto la consulta
   $query = $db->prepare('SELECT * FROM productos');
   $query->execute();

   // 3. Obtengo los datos en un arreglo de objetos
   $product = $query->fetchAll(PDO::FETCH_OBJ);

   return $product;
}//Esta función obtiene todas las tareas de la tabla tareas.
//Primero establece una conexión a la base de datos, luego prepara y ejecuta una consulta SQL para seleccionar todas las filas.
//Finalmente, retorna un arreglo de objetos que representan las tareas.

function getProduct($ID_Producto) {
   $db = getConnection();

   $query = $db->prepare('SELECT * FROM productos WHERE ID_Producto = ?');
   $query->execute([$ID_Producto]);

   $product = $query->fetch(PDO::FETCH_OBJ);

   return $product;
}//Esta función recibe un ID y obtiene la tarea correspondiente de la tabla tareas.
//Similar a la función anterior, pero utiliza un parámetro para buscar una tarea específica y devuelve un solo objeto que representa esa tarea.

function insertProducts($name, $description, $price, $quantity,$ID_Producto= false) {
   $db = getConnection();

   $query = $db->prepare('INSERT INTO productos(Nombre, Descripcion, Precio, Cantidad, ID_Categoria) VALUES (?, ?, ?, ?, ?)');
   $query->execute([$name, $description, $price, $quantity, $ID_Category]);

   $ID_Producto = $db->lastInsertId();

   return $ID_Producto;
}//Esta función inserta una nueva tarea en la base de datos. Toma el título, la descripción,
//la prioridad y un estado de finalización (que por defecto es false).
//Después de ejecutar la consulta de inserción, retorna el ID de la tarea recién creada.

function eraseProduct($ID_Producto) {
   $db = getConnection();

   $query = $db->prepare('DELETE FROM productos WHERE ID_Producto = ?');
   $query->execute([ID_Producto]);
}
//Esta función elimina una tarea de la base de datos utilizando su ID.
//Se prepara y ejecuta una consulta DELETE para eliminar la fila correspondiente en la tabla tareas.


function updateProduct($ID_Producto) {
   $db = getConnection();
   
   $query = $db->prepare('UPDATE productos SET finalizada = 1 WHERE ID_Producto = ?');
   $query->execute([ID_Producto]);
}
