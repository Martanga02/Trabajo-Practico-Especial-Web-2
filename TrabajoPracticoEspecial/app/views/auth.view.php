<?php

class AuthView {
    public function showLogin($error = null) {
        require './templates/login.phtml';
    }
}
/*La clase AuthView es responsable de la
presentación de la vista de inicio de sesión,
cargando la plantilla correspondiente cuando se llama al método showLogin.
Si hay un mensaje de error, se puede pasar para que se muestre en la interfaz. */