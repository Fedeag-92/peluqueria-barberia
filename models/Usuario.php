<?php

namespace Models;

class Usuario extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $passwordAct;
    public $passwordN;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->passwordAct = $args['passwordAct'] ?? '';
        $this->passwordN = $args['passwordN'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    //Mensajes de validacion para crear una cuenta
    public function validarModificacionAdmin() {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }else if(strlen($this->nombre) > 60){
            self::$alertas['error'][] = 'El nombre debe contener menos de 60 caracteres';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }else if(strlen($this->apellido) > 60){
            self::$alertas['error'][] = 'El apellido debe contener menos de 60 caracteres';
        }
        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }else if(strlen($this->telefono) > 10){
            self::$alertas['error'][] = 'El numero debe contener menos de 11 digitos';
        }
        return self::$alertas;
    }

    //Mensajes de validacion para crear una cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El e-mail es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }else if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }
        return self::$alertas;
    }

    //Mensajes de validacion para loguear una cuenta
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = 'El e-mail es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'Debes escribir un mail';
        }
        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }else if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    //Revisa si el usuario ya existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email='" . $this->email . "' LIMIT 1;";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$alertas['error'][] = 'El usuario ya está registrado';
        }
        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generarToken(){
        $this->token = uniqid();
    }

    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->passwordAct, $this->password );
    }

    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password, $this->password);
        
        if(!$resultado || !$this->confirmado){
            self::$alertas['error'][] = 'Password incorrecto o la cuenta no ha sido confirmada';
        }else{
            return true;
        }
    }
}