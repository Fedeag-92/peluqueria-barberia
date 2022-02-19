<?php

namespace Models;

class Sucursal extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'sucursal';
    protected static $columnasDB = ['id', 'nombre', 'ciudad', 'direccion', 'diaInicio', 'diaFin', 'horaInicio', 'horaCierre', 'cerrado'];

    public $id;
    public $nombre;
    public $ciudad;
    public $direccion;
    public $diaInicio;
    public $diaFin;
    public $horaInicio;
    public $horaCierre;
    public $cerrado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->diaInicio = $args['diaInicio'] ?? '';
        $this->diaFin = $args['diaFin'] ?? '';
        $this->horaInicio = $args['horaInicio'] ?? '';
        $this->horaCierre = $args['horaCierre'] ?? '';
    }
}