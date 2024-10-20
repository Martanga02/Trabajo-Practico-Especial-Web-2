<?php
require_once './app/models/model.php';
class ProductosModel extends Model{

    /*Realiza una consulta a la base de datos para obtener todos los productos, incluyendo su ID,
    nombre, precio, stock y el nombre de la categoría a la que pertenecen.
    Devuelve el resultado como un array de objetos. */
    function getProductos(){
        $query = $this->db->prepare('SELECT A.id,A.producto,A.precio,A.stock,B.Nombre FROM productos A INNER JOIN categorias B ON A.categoriaID=B.CategoriaID');
        $query-> execute();

        $productos =$query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

/*Permite obtener un producto específico basado en su ID. Realiza una consulta similar a
getProductos, pero filtra por el ID proporcionado. Devuelve el producto como un objeto. */
function getProductoEspecifico($id) {
    // Consulta el producto con el ID especificado
    $query = $this->db->prepare('SELECT A.id, A.producto, A.precio, A.stock, B.Nombre
                                FROM productos A
                                INNER JOIN categorias B ON A.categoriaID = B.CategoriaID
                                WHERE A.id = ?');
    $query->execute([$id]);

    $productos = $query->fetchAll(PDO::FETCH_OBJ);

    // Si no se encuentra el producto, busca el producto por defecto (id = 1 en este caso)
    if (empty($productos)) {
        $query = $this->db->prepare('SELECT A.id, A.producto, A.precio, A.stock, B.Nombre
                                    FROM productos A
                                    INNER JOIN categorias B ON A.categoriaID = B.CategoriaID
                                    WHERE A.id = 1');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
    }

    return $productos;
}


/*Inserta un nuevo producto en la tabla productos con el nombre,
precio y categoría proporcionados. Retorna el ID del producto recién insertado.*/
    function insertProducto($producto, $precio, $categoria) {
    
        $query = $this->db->prepare('INSERT INTO productos (producto, precio, categoriaID) VALUES(?,?,?)');
        $query->execute([$producto, $precio, $categoria]);
    
        return $this->db->lastInsertId();
    }

    function deleteProducto($id){
        
        $query = $this->db->prepare('DELETE FROM productos WHERE id=?');
        $query->execute([$id]);
    }
/*Elimina un producto de la tabla basado en su ID. No devuelve ningún valor. */
    function editProducto($producto, $precio, $categoria, $id){
        $query = $this->db->prepare('UPDATE productos SET producto=?, precio=?, categoriaID=? WHERE id=?');
        $query->execute([$producto, $precio, $categoria,$id]);

    }
/*Actualiza la información de un producto existente (nombre, precio, y categoría) basado en su ID. No devuelve ningún valor. */
    function getProductosByCategoria($categoriaID){
        $query = $this->db->prepare('SELECT A.id,A.producto,A.precio,A.stock,B.Nombre FROM productos A INNER JOIN categorias B ON A.categoriaID=B.CategoriaID WHERE A.categoriaID=?' );
        $query-> execute([$categoriaID]);

        $productos =$query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

}