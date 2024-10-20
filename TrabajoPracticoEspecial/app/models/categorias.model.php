<?php
require_once './app/models/model.php';
class CategoriasModel extends Model{
    
    /*Recupera todas las categorías de la base de datos y devuelve un array de objetos que representa cada categoría. */
    public function getAllCategorias() {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();
        $categorias=$query->fetchAll(PDO::FETCH_OBJ);;
        
        return $categorias;
    }
/*Busca una categoría específica por su ID y devuelve un objeto que representa la categoría encontrada o false si no hay coincidencias. */
    public function getCategoriaById($categoriaID) {
        $query = $this->db->prepare("SELECT * FROM categorias WHERE categoriaID = ?");
        $query->execute([$categoriaID]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
/*Elimina una categoría y todos los productos asociados a ella, primero elimina los productos que tienen la categoría especificada. Luego, elimina la categoría en sí. */
    public function deleteCategoria($categoriaID) {
        
        $query = $this->db->prepare('DELETE FROM productos WHERE categoriaID = :categoriaID');
        $query->bindParam(':categoriaID', $categoriaID, PDO::PARAM_INT);
        $query->execute();
        $query = $this->db->prepare('DELETE FROM categorias WHERE categoriaID = :categoriaID');
        $query->bindParam(':categoriaID', $categoriaID, PDO::PARAM_INT);
        $query->execute();
    }
    /*Inserta una nueva categoría en la base de datos y devuelve el ID de la categoría recién insertada. */
    public function insertCategoria($nombre) {
        
        $query = $this->db->prepare('INSERT INTO categorias (nombre) VALUES(?)');
        $query->execute([$nombre]);
        
        return $this->db->lastInsertId();
        
    }
    /*Actualiza el nombre de una categoría existente y ejecuta una consulta de actualización basada en el ID de la categoría.*/
    function editCategoria($nombre, $categoriaID){
        $query = $this->db->prepare('UPDATE categorias SET nombre=? WHERE categoriaID=?');
        $query->execute([$nombre, $categoriaID]);
    }
}