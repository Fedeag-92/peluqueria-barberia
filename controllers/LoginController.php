<?php
namespace Controllers;

use MVC\Router;
use Clases\Email;
use Models\Usuario;
use Models\Sucursal;

class LoginController{
    public static function login(Router $router){
        $alertas = [];
        if(isset($_GET['mensaje'])){
            if($_GET['mensaje'] == 1){
                Usuario::setAlerta('exito', 'Revisa tu email');
            }
            else if ($_GET['mensaje'] == 2){
                Usuario::setAlerta('exito', 'Password reestablecido');
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                if(!$usuario){
                    Usuario::setAlerta('error', 'El usuario no existe');
                }else{
                    //Verificar el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar usuario
                        session_start();

                        $direccion = Sucursal::find(1)->direccion;

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombreCompleto'] = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['direccion'] = $direccion;
                        $_SESSION['login'] = true;

                        //Redireccionamiento
                        if($usuario->admin == '1'){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /cita');
                        }
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        if(!isset($_SESSION)) {
            session_start();
        };

        isAuth();

        $_SESSION = [];

        header('Location: /');
    }

    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                //Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                //Comprobar tambien que este confirmado
                if(!$usuario || $usuario->confirmado != '1'){
                    Usuario::setAlerta('error', 'El usuario no existe o cuenta no confirmada');
                }else{
                    //Usuario existente, ahora generar token nuevo
                    $usuario->generarToken();
                    $usuario->guardar();
                    
                    //Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    
                    $email->enviarInstrucciones();

                    header('Location: /?mensaje=1');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);

    }

    public static function recuperar(Router $router){
        $alertas = [];
        $correcto = false;
        $error = false;

        $token = s($_GET['token']) ?? '';

        //Buscar usuario por su token

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }else{
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //leer el nuevo password y guardarlo
                $password = new Usuario($_POST);
                $alertas = $password->validarPassword();

                if(empty($alertas)){
                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = '';
                    $correcto = true;

                    if($usuario->guardar()){
                        Usuario::setAlerta('exito', 'Password reestablecido con exito');
                        Usuario::setAlerta('exito', 'Espere. Redireccionando...');

                        
                        
                        header('refresh:5; url=/?mensaje=2');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'correcto' => $correcto,
            'error' => $error,
        ]);
    }

    public static function crear(Router $router){
        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $usuario->sincronizar($_POST);
            //Verificar si el usuario esta registrado
            if($usuario->email != '' && $usuario->existeUsuario()->num_rows){
                $alertas = Usuario::getAlertas();
            }else{
                $alertas = $usuario->validarNuevaCuenta();
                //Verificar si lleno todos los campos obligatorios
                if(empty($alertas)){
                    //Hashear el password
                    $usuario->hashPassword();

                    //generar un token unico
                    $usuario->generarToken();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    //Crear el usuario
                    if($usuario->guardar()){
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){

        $router->render('auth/mensaje');
    }
 
    public static function confirmar(Router $router){
        $alertas = [];
        $token = $_GET['token'];

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no Válido. No se pudo confirmar la cuenta');
        }else{
            Usuario::setAlerta('exito', 'Cuenta Confirmada correctamente');

            //Modificar al usuario confirmado
            $usuario->confirmado = 1;
            $usuario->token = '';
            $usuario->guardar();
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}