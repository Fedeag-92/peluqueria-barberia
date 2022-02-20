<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\ServicioController;

$router = new Router();

//AREA PUBLICA

//Iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

//Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//AREA PRIVADA
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

//API de citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->get('/api/usuario', [APIController::class, 'obtenerUsuario']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->get('/api/citas-usuario', [APIController::class, 'obtenerCitas']);
$router->get('/api/citas-fecha', [APIController::class, 'obtenerCitasFecha']);
$router->post('/api/actualizar-usuario', [APIController::class, 'actualizar']);
$router->get('/api/servicios-cita', [APIController::class, 'obtenerServiciosCita']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);
$router->get('/api/sucursal', [APIController::class, 'sucursal']);
$router->post('/api/cantImagenes', [APIController::class, 'obtenerCantImagenes']);

//CRUD de Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/fotos', [ServicioController::class, 'fotos']);
$router->post('/servicios/fotos', [ServicioController::class, 'fotos']);
$router->post('/servicios/fotos-eliminar', [ServicioController::class, 'eliminar_foto']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

//CRUD de Usuarios
$router->get('/usuarios', [AdminController::class, 'usuarios']);
$router->get('/usuarios/actualizar', [AdminController::class, 'actualizar_usuario']);
$router->post('/usuarios/actualizar', [AdminController::class, 'actualizar_usuario']);
$router->post('/usuarios/eliminar', [AdminController::class, 'eliminar_usuario']);

//Sucursal
$router->get('/sucursal', [AdminController::class, 'sucursal']);
$router->get('/sucursal/actualizar', [AdminController::class, 'sucursal_actualizar']);
$router->post('/sucursal/actualizar', [AdminController::class, 'sucursal_actualizar']);

//Cita
$router->get('/cita/actualizar', [AdminController::class, 'editar_cita']);
$router->post('/cita/actualizar', [AdminController::class, 'editar_cita']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();