<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';
/*importamos archivos necesarios */

/*encapsulamos la lógica de autenticación. */
class AuthController {
    /*Instanciamos la vista de autenticación y el model*/
    private $view;
    private $model;

    /*Inicializamos las instancias de UserModel y AuthView. */
    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    /*Mostramos el formulario de inicio de sesión llamando a la vista correspondiente. */

    public function showLogin() {
        $this->view->showLogin();
    }
/*Recibimos los datos del formulario:
Toma el nombre de usuario y la contraseña del formulario POST.
Validación: Comprobamos si los campos están vacíos. Si es así, mostramos un mensaje de error.
Verificación de usuario: Llama a getByUser en el modelo para obtener el usuario.
Verificación de contraseña: Usa password_verify para comprobar si la contraseña proporcionada coincide con la almacenada.
Inicio de sesión: Si es correcto, llama a AuthHelper::login y redirige a la página principal.
Error: Si la autenticación falla, muestra un mensaje de error. */
    public function auth() {
        $user = $_POST['user'];
        $password = $_POST['password'];
        
        if (empty($user) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        
        $user = $this->model->getByUser($user);

        if ($user && password_verify($password, $user->password)) {
            AuthHelper::login($user);
            
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('El Usuario o la clave son inválidos');
        }
        
    }

    /*Cerramos la sesión del usuario llamando a AuthHelper::logout y redirige a la página principal. */
    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }

}
