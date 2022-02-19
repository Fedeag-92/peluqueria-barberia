<?php

namespace Controllers;

use MVC\Router;
use Models\Servicio;

class CitaController{
    public static function index(Router $router){

        if(!isset($_SESSION)) {
            session_start();
        };

        isAuth();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombreCompleto'],
            'direccion' => $_SESSION['direccion'],
            'id' => $_SESSION['id']
        ]);
    }

    public static function servicio(Router $router){

        if(!isset($_SESSION)) {
            session_start();
        };

        isAuth();

        $servicio = Servicio::find($_GET['id']);

        $router->render('servicios/servicio', [
            'nombre' => $_SESSION['nombreCompleto'],
            'id' => $_SESSION['id']
        ]);
    }
}