<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {
        AuthHelper::init();
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_USER'] = $user->user;
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }

    public static function verify() {
        AuthHelper::init();
        if (!isset($_SESSION['USER_ID'])) {
            return false;
        }else{
            return true;
        }
    }
    public static function verifyStrict() {
        AuthHelper::init();
        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL . '/login');
            die();
        }
    }

}

/*se encarga de manejar la autenticación de usuarios mediante sesiones en PHP,
facilita la gestión de la autenticación de usuarios en una aplicación web.
Permite iniciar sesión, cerrar sesión y verificar si un usuario está autenticado,
además de redirigir a los usuarios no autenticados a la página de inicio de sesión.*/