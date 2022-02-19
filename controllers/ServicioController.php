<?php

namespace Controllers;

use MVC\Router;
use Models\Servicio;
use Intervention\Image\ImageManagerStatic as Image;

class ServicioController{
    public static function index(Router $router){
        
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $servicios = Servicio::all();

        $alertas = [];

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombreCompleto'],
            'servicios' => $servicios,
            'alertas' => $alertas,
            'tabServicios' => true
        ]);
    }

    public static function fotos(Router $router){
        
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $id = $_GET['id'];
        if(!is_numeric($id)) return;

        $servicio = Servicio::find($id);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $nombreProyecto = strtolower(str_replace(' ', '', $servicio->nombre));

            $nombreImagen = $nombreProyecto . $_POST['numeroImagen'] . ".jpg";

            if($_FILES['imagen']['tmp_name']){
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(740, 920);
				
            }

            //Guardar la imagen en el servidor
            $image->save("build/img/" . $nombreImagen);

            $_SESSION['operacion'] = 'crear';

        }

        $alertas = [];

        $router->render('servicios/fotos', [
            'nombre' => $_SESSION['nombreCompleto'],
            'servicioNombre' => $servicio->nombre,
            'alertas' => $alertas,
            'id' => $id
        ]);
    }

    public static function eliminar_foto(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!isset($_SESSION)) {
                session_start();
            };
    
            isAdmin();

            $id = $_POST['id'];
            
            if(!is_numeric($id)) return;

            $i = $_POST['i'];
            $nombre = $_POST['nombre'];

            if(file_exists("build/img/" . $nombre . $i . ".jpg")) {
                unlink("build/img/" . $nombre . $i . ".jpg");
            }

            $i++;
            if(file_exists("build/img/" . $nombre . $i . ".jpg")) {
                while(file_exists("build/img/" . $nombre . $i . ".jpg")){
                    rename("build/img/" . $nombre . $i . ".jpg", "build/img/" . $nombre . --$i . ".jpg");
                    $i += 2;
                }
            }

            $_SESSION['operacion'] = 'eliminar';

            header('Location: /servicios/fotos?id=' . $id);
        }

        
    }

    public static function crear(Router $router){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $servicio = new Servicio;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                $_SESSION['operacion'] = 'crear';
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombreCompleto'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }
    public static function actualizar(Router $router){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();

        $id = $_GET['id'];
        if(!is_numeric($id)) return;

        $servicio = Servicio::find($id);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();


            if(empty($alertas)){
                $servicio->guardar();
                $_SESSION['operacion'] = 'actualizar';
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombreCompleto'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }
    
    public static function eliminar(){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAdmin();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $servicio = Servicio::find($_POST['id']);
            $servicio->eliminar();
            $_SESSION['operacion'] = 'eliminar';
            header('Location: /servicios');
        }
    }
}