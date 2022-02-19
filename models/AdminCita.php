<?php

namespace Models;

class AdminCita extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'hora', 'finaliza', 'cliente', 'email', 'telefono', 'servicio', 'precio', 'oferta', 'total'];

    public $id;
    public $hora;
    public $finaliza;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;
    public $oferta;
    public $total;


    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->finaliza = $args['finaliza'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->oferta = $args['oferta'] ?? '';
        $this->total = $args['total'] ?? '';

    }
}