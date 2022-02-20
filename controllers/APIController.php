<?php

namespace Controllers;

use Models\Cita;
use Clases\Email;
use Models\Usuario;
use Models\Servicio;
use Models\Sucursal;
use Models\CitaServicio;

//Simula nuestro servidor
class APIController{
    public static function index(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function sucursal(){
        $sucursal = Sucursal::find(1);
        echo json_encode($sucursal);
    }

    public static function obtenerCitasFecha(){
        $servicios = Cita::belongsTo('fecha', $_GET['fecha']);
        echo json_encode($servicios);
    }

    public static function guardar(){

        $cita = new Cita($_POST);

        //Almacena la cita y devuelve el id
        $resultado = $cita->guardar();
        $id = $resultado['id'];

        //Almacenea los servicios con el id de la cita
        $idServicios = explode(',',$_POST['serviciosId']);

        foreach($idServicios as $idServicio){
            $args = ['citaId' => $id, 'servicioId' => $idServicio];
            (new CitaServicio($args))->guardar();
        }

        $usuario = Usuario::find($_POST['usuarioId']);

        //Enviar el email
        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
        $email->confirmacionCita($cita, json_decode($_POST['servicios']));

        //Retornar una respuesta

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            $_SESSION['operacion'] = 'eliminar';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public static function obtenerCantImagenes(){
        $i = 1;
        $cantServicios = 0;
        $nombreServicio = $_POST['nombreServicio'];
        while(file_exists("build/img/" . $nombreServicio . $i . ".jpg")) {
            $cantServicios++;
            $i++;
        }
        echo json_encode($cantServicios);
    }

    public static function obtenerUsuario() {
        $usuario = Usuario::find($_GET['id']);
        echo json_encode($usuario);
    }

    public static function obtenerCitas() {
        $citas = Cita::belongsTo('usuarioId', $_GET['id']);
        echo json_encode($citas);
        
    }

    public static function obtenerServiciosCita() {
       
            $cita = Cita::find($_GET['id']);

            $consulta = "SELECT s.* FROM citas c INNER JOIN citasservicios cs ON c.id = cs.citaId INNER JOIN servicios s ON s.id = cs.servicioId WHERE c.id = " . $cita->id . ";";

            $servicios = Servicio::SQL($consulta);
            echo json_encode($servicios);
        
    }

    public static function actualizar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar que el proyecto exista
            $tipoModificacion = $_POST['modificacion'];
            array_pop($_POST);
            $usuario = Usuario::find($_POST['id']);

            if(!$usuario) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un Error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            $usuario->sincronizar($_POST);

            if($tipoModificacion == 'nombre' ){
                $_SESSION['nombreCompleto'] = $usuario->nombre . " " . $usuario->apellido;
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $usuario->id,
                    'mensaje' => 'Nombre actualizado correctamente'
                ];
            }else if ($tipoModificacion == 'password' ){
                $validacion = $usuario->comprobar_password();
                if($validacion) {
                    $usuario->password = $usuario->passwordN;

                    // Eliminar propiedades No necesarias
                    unset($usuario->passwordN);
                    unset($usuario->passwordAct);

                    // Hashear el nuevo password
                    $usuario->hashPassword();

                    $respuesta = [
                        'tipo' => 'exito',
                        'id' => $usuario->id,
                        'mensaje' => 'Password actualizado correctamente'
                    ];
                }
                else{
                    $respuesta = [
                        'tipo' => 'error',
                        'mensaje' => 'El password actual no es correcto'
                    ];
                    echo json_encode($respuesta);
                    return;
                }
            }else{
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $usuario->id,
                    'mensaje' => 'Telefono actualizado correctamente'
                ];
            }
            $resultado = $usuario->guardar();
            if($resultado) {
                echo json_encode($respuesta);
            }
        }
    }
}