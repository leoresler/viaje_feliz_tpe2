<?php

class PasajeroEstandar extends Persona {

    private $nroAsiento;
    private $nroTicket;

    public function __construct($nombre, $apellido, $telefono, $numDocumento, $nroAsiento, $nroTicket){
        
        parent :: __construct($nombre, $apellido, $telefono, $numDocumento);
        
        $this->nroAsiento = $nroAsiento;
        $this->nroTicket = $nroTicket;
    }

    // metodos de acceso GET y SET
    public function getNroAsiento(){
        return $this->nroAsiento;
    }
    public function setNroAsiento($nroAsiento){
        $this->nroAsiento = $nroAsiento;
    }

    public function getNroTicket(){
        return $this->nroTicket;
    }
    public function setNroTicket($nroTicket){
        $this->nroTicket = $nroTicket;
    }


    public function __toString(){
        $cadena = parent :: __toString();
        $cadena = $cadena . "\nNumero de asiento: " . $this->getNroAsiento() . "\nNumero de ticket: " . $this->getNroTicket();
        
        return $cadena;
    }

    public function darPorcentajeIncremento(){
        return 10;
    }


}