<?php

namespace Controllers;

use MVC\Router;
use Models\Cita;
use Models\Usuario;
use Models\Servicio;
use Models\Sucursal;
use Models\AdminCita;

class AdminController{
    public static function index(Router $router){

        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechaDividida = explode('-', $fecha);

        if(!checkdate($fechaDividida[1], $fechaDividida[2], $fechaDividida[0])){
            header('Location: /404');
        }

        //Consultar la BD
        
        $consulta = "SELECT citas.id, DATE_FORMAT(citas.hora, '%k:%i') as hora, DATE_FORMAT(ADDTIME(citas.hora, citas.demoraTotal), '%k:%i') as finaliza, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio, servicios.oferta, citas.total FROM citas INNER JOIN usuarios ON citas.usuarioId=usuarios.id INNER JOIN citasservicios ON citasservicios.citaId=citas.id INNER JOIN servicios ON servicios.id=citasservicios.servicioId WHERE fecha = '${fecha}';";

        $citas = AdminCita::SQL($consulta);

        $alertas = [];

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombreCompleto'],
            'alertas' => $alertas,
            'citas' => $citas,
            'fecha' => $fecha,
            'tabCitas' => true
        ]);
    }

    public static function usuarios(Router $router){

        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $usuarios = Usuario::all();

        //Consultar la BD

        $alertas = [];

        $router->render('admin/usuarios', [
            'nombre' => $_SESSION['nombreCompleto'],
            'usuarios' => $usuarios,
            'alertas' => $alertas,
            'tabUsuarios' => true
        ]);
    }

    public static function actualizar_usuario(Router $router){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $id = $_GET['id'];
        if(!is_numeric($id)) return;

        $usuario = Usuario::find($id);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarModificacionAdmin();


            if(empty($alertas)){
                $usuario->guardar();
                $_SESSION['operacion'] = 'actualizar';
                header('Location: /usuarios');
            }
        }

        $router->render('admin/usuario_actualizar', [
            'nombre' => $_SESSION['nombreCompleto'],
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    
    public static function eliminar_usuario(){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $usuario = Usuario::find($_POST['id']);
            $usuario->eliminar();
            $_SESSION['operacion'] = 'eliminar';
            header('Location: /usuarios');
        }
    }

    public static function sucursal(Router $router){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $sucursal = Sucursal::find(1);

        $router->render('admin/sucursal', [
            'nombre' => $_SESSION['nombreCompleto'],
            'sucursal' => $sucursal,
            'tabSucursal' => true
        ]);
    }

    public static function sucursal_actualizar(Router $router){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $sucursal = Sucursal::find(1);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $sucursal->sincronizar($_POST);
            $alertas = $sucursal->validar();

            if(empty($alertas)){
                $sucursal->guardar();
                header('Location: /sucursal');
            }
        }

        $router->render('admin/sucursal_actualizar', [
            'nombre' => $_SESSION['nombreCompleto'],
            'sucursal' => $sucursal,
            'alertas' => $alertas
        ]);
    }

    public static function editar_cita(Router $router){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $id = $_GET['id'];
        if(!is_numeric($id)) return;

        $cita = Cita::find($id);

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $cita->sincronizar($_POST);
            $alertas = $cita->validar();

            if(empty($alertas)){
                $cita->guardar();
                $_SESSION['operacion'] = 'actualizar';
                header('Location: /admin?fecha=' . $_POST['fecha'] .'#citas-admin');
            }
        }

        $router->render('admin/editar_cita', [
            'nombre' => $_SESSION['nombreCompleto'],
            'cita' => $cita,
            'cliente' => $_GET['cliente'],
            'alertas' => $alertas
        ]);
    }
}