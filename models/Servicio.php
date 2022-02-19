<?php

namespace Models;

class Servicio extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio', 'demora', 'oferta'];

    public $id;
    public $nombre;
    public $precio;
    public $demora;
    public $oferta;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->demora = $args['demora'] ?? '';
        $this->oferta = $args['oferta'] ?? 0;
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'Debes escribir un nombre';
        }
        if(!$this->precio){
            self::$alertas['error'][] = 'Debes escribir un precio';
        }else if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El precio debe ser un numero';
        }else if($this->precio < 0){
            self::$alertas['error'][] = 'El precio debe ser positivo';
        }
        if($this->oferta < 0 || $this->oferta > 100){
            self::$alertas['error'][] = 'La oferta es un porcentaje entre 0(sin) y 100';
        }
        if($this->demora == '0:00'){
            self::$alertas['error'][] = 'La demora es como mínimo de 15 minutos';
        }

        return self::$alertas;
    }
}