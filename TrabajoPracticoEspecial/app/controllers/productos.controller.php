<?php
require_once './app/models/productos.model.php';
require_once './app/views/productos.view.php';
require_once './app/helpers/auth.helper.php';
require_once './app/models/categorias.model.php';
/*Se incluyen archivos que manejan modelos, vistas y helpers necesarios para la funcionalidad del controlador. */

class ProductosController {
    /*Esta clase encapsula la lógica para manejar productos y categorías. */
    private $view;
    private $modelProductos;
    private $categoriasModel;

/*view: Instancia de la vista para productos.
modelProductos: Instancia del modelo para manejar productos.
categoriasModel: Instancia del modelo para manejar categorías.*/
    
    public function __construct() {
        
        AuthHelper::verify();
        
        $this->modelProductos = new ProductosModel();
        $this->categoriasModel = new CategoriasModel();
        $this->view = new ProductosView();
        /*Verifica la autenticación del usuario.
        Inicializa las instancias de los modelos y la vista. */
    }

    public function showProductos() {
        
        
        // obtengo tareas del controlador
        $productos = $this->modelProductos->getProductos();
        
        // muestro las tareas desde la vista
        $this->view->showProductos($productos);
        
        
    }
    public function deleteProducto($id){
        $this->modelProductos->deleteProducto($id);
        header('Location: ' . BASE_URL . '/productos');
    }

    function mostrarProductosXCategoria($categoriaID){
        $categoria = $this->categoriasModel->getCategoriaById($categoriaID);
        
        if ($categoria) {
        
            $productos = $this->modelProductos->getProductosByCategoria($categoriaID);

            
            $this->view->mostrarProductosXCategoria($categoria, $productos);
            
        } else {
            
            $this->view->showError("error");
    
        }
    }
    
    public function showHome(){
        $this->view->showHome();
    }

    public function showError(){
        $this->view->showError("404 Page Not Found");
    }
    
    function showProductoEspecifico($id){
        
        $producto = $this->modelProductos->getProductoEspecifico($id);
        

        // muestro las tareas desde la vista
        $this->view->mostrarProductoEspecifico($producto);
    }


    function showEditar($id){
        $categorias = $this->categoriasModel->getAllCategorias(); // Obtener las categorías desde la base de datos
        $this->view->showEditar($id, $categorias);
        
    }

    function showEditarCategoria($categoriaID){
        $this->view->showEditarCategoria($categoriaID);
        
    }

    function editProducto($id){

        $producto=$_POST['producto'];
        $precio=$_POST['precio'];
        $categoria=$_POST['categoria'];
        
        if (empty($producto) || empty($precio)|| empty($categoria)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
    
        $this->modelProductos->editProducto($producto, $precio, $categoria, $id);

        header('Location: ' . BASE_URL . 'productos');
    }
    function editCategoria($categoriaID){

        $nombre=$_POST['nombre'];
        
        if (empty($nombre)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
    
        $this->categoriasModel->editCategoria($nombre, $categoriaID);

        header('Location: ' . BASE_URL . 'categorias');
    }




    function mostrarCategorias() {
        // obtengo tareas del controlador
        $categorias = $this->categoriasModel->getAllCategorias();
        // muestro las tareas desde la vista
        $this->view->mostrarCategorias($categorias);
    }

    public function deleteCategoria($categoriaID){
        $this->categoriasModel->deleteCategoria($categoriaID);
        header('Location: ' . BASE_URL . '/categorias');
    }

    function showAgregarProductos(){
        $categorias = $this->categoriasModel->getAllCategorias();
        $this->view->showAgregarProductos($id=null,$categorias);
    }

    function addProducto(){
        $categorias = $this->categoriasModel->getAllCategorias();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $producto = filter_input(INPUT_POST, 'producto', FILTER_SANITIZE_STRING);
                $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
                $categoria = filter_input(INPUT_POST, 'categoria', FILTER_VALIDATE_INT);
        
                if (empty($producto) || $precio === false || $categoria === false) {
                    $this->view->showError("Se deben completar todos los campos");
                    return;
                }

            $id = $this->modelProductos->insertProducto($producto, $precio, $categoria);

            if ($id) {
                $this->view->showAgregarProductos($id,$categorias);
            } else {
                $this->view->showError("Hubo un error al insertar el producto");
            }
        }else {
            
            $this->view->showAgregarProductos($id=null,$categorias);
        }
    }

    public function showAgregarCategoria() {
        $this->view->showAgregarCategoria();
    }

    public function addCategoria() {
        
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);

        if (empty($nombre)) {
            $this->view->showError("Debe completar el campo 'Nombre'");
            return;
        }


        $categoriasModel = new CategoriasModel();
        $categoriaID = $categoriasModel->insertCategoria($nombre);

        if ($categoriaID) {
            header('Location: ' . BASE_URL . 'categorias');;
            exit;
        } else {
            echo "Hubo un error al insertar la categoría";
        }
    } else {
        $this->view->showAgregarCategoria();
    }
    }
    
}