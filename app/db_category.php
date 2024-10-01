<?php

function getConnection() {
   return new PDO('mysql:host=localhost;dbname=almacen;charset=utf8', 'root', '');
}

function getCategorys() {
   // 1. Abro la conexión
   $db = getConnection();

   // 2. Ejecuto la consulta
   $query = $db->prepare('SELECT * FROM categoria');
   $query->execute();

   // 3. Obtengo los datos en un arreglo de objetos
   $category = $query->fetchAll(PDO::FETCH_OBJ);

   return $category;
}//Esta función obtiene todas las tareas de la tabla tareas.
//Primero establece una conexión a la base de datos, luego prepara y ejecuta una consulta SQL para seleccionar todas las filas. 
//Finalmente, retorna un arreglo de objetos que representan las tareas.

function getCategory($ID_Categoria) {
   $db = getConnection();

   $query = $db->prepare('SELECT * FROM categoria WHERE ID_Categoria = ?');
   $query->execute([ID_Categoria]);

   $category = $query->fetch(PDO::FETCH_OBJ);

   return $category;
}//Esta función recibe un ID y obtiene la tarea correspondiente de la tabla tareas.
//Similar a la función anterior, pero utiliza un parámetro para buscar una tarea específica y devuelve un solo objeto que representa esa tarea.

function insertCategory($name, $description= false) {
   $db = getConnection();

   $query = $db->prepare('INSERT INTO categoria(Nombre, Descripcion) VALUES (?, ?)');
   $query->execute([$name, $description]);

   $ID_Categoria = $db->lastInsertId();

   return ID_Categoria;
}//Esta función inserta una nueva tarea en la base de datos. Toma el título, la descripción,
//la prioridad y un estado de finalización (que por defecto es false).
//Después de ejecutar la consulta de inserción, retorna el ID de la tarea recién creada.

function eraseCategory($ID_Categoria) {
   $db = getConnection();

   $query = $db->prepare('DELETE FROM categoria WHERE ID_Categoria = ?');
   $query->execute([ID_Categoria]);
}
//Esta función elimina una tarea de la base de datos utilizando su ID.
//Se prepara y ejecuta una consulta DELETE para eliminar la fila correspondiente en la tabla tareas.


function updateCategory($ID_Categoria) {
   $db = getConnection();
   
   $query = $db->prepare('UPDATE tareas SET finalizada = 1 WHERE ID_Categoria = ?');
   $query->execute([ID_Categoria]);
}
