<?php

class ProductosView {

    public function showProductos($productos) {
        $count = count($productos);
        
        require 'templates/productos.phtml';
    }
        
    public function mostrarProductoEspecifico($producto) {
        
        require './templates/productoEspecifico.phtml';
    }

    public function mostrarProductosXCategoria($categoria, $productos) {
        require './templates/productoXCategoria.phtml';
    }

    public function showHome(){
        require 'templates/home.phtml';
    }

    public function showEditar($id, $categorias) {
        require 'templates/editar.phtml';
    }
    
    public function showEditarCategoria($categoriaID) {
        require 'templates/editarCategorias.phtml';
    }


    public function mostrarCategorias($categorias) {
        require './templates/categorias.phtml';
    }

    public function mostrarProductoXCategortia($productos) {
        require './templates/productoXCategoria.phtml';
    }

    public function showAgregarProductos($id =  null,$categorias){
        require_once './templates/agregarProducto.phtml';
    }

    public function showAgregarCategoria($categoriaID =  null) {
        require 'templates/AgregarCategoria.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}

/*La clase ProductosView se encarga de renderizar diferentes vistas
relacionadas con productos y categorías en la aplicación.
Cada método incluye una plantilla específica que define cómo
se deben presentar los datos en la interfaz de usuario.
Esta separación de lógica de presentación permite que la aplicación sea más modular y fácil de mantener. */