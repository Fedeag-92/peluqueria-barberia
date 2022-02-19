<?php

namespace Models;

class Cita extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'total', 'demoraTotal', 'usuarioId', 'direccion'];

    public $id;
    public $fecha;
    public $hora;
    public $total;
    public $demoraTotal;
    public $usuarioId;
    public $direccion;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->demoraTotal = $args['demoraTotal'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
    }
    
}