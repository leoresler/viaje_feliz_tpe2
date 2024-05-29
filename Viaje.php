<?php

class Viaje {
    // recolecta y modifica los datos de un viaje

    private $codigoDeViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros; // coleccion de pasajeros del viaje que hace referencia a un objeto Pasajero
    private $objResponsable; // objeto que hace referencia a la clase responsableV
    private $costoViaje;
    private $costosAbonadosPasajeros;


    // metodo constructor de la clase viaje
    public function __construct($codigoDeViaje, $destino, $cantMaxPasajeros, $pasajeros, $objResponsable, $costoViaje, $costosAbonadosPasajeros){
        $this->codigoDeViaje = $codigoDeViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->pasajeros = $pasajeros;
        $this->objResponsable = $objResponsable;
        $this->costoViaje = $costoViaje;
        $this->costosAbonadosPasajeros = $costosAbonadosPasajeros;
    }

    // metodos get y set de la clase viaje
    public function getCodigoDeViaje(){
        return $this->codigoDeViaje;
    }
    public function setCodigoDeViaje($codigoDeViaje){
        $this->codigoDeViaje = $codigoDeViaje;
    }

    public function getDestino(){
        return $this->destino;
    }
    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    public function getPasajeros(){
        return $this->pasajeros;
    }
    public function setPasajeros($pasajeros){
        $this->pasajeros = $pasajeros;
    }

    public function getObjResponsable(){
        return $this->objResponsable;
    }
    public function setResponsable($objResponsable){
        $this->objResponsable = $objResponsable;
    }

    public function getCostoViaje(){
        return $this->costoViaje;
        }
    
    public function setCostoViaje($costoViaje){
        $this->costoViaje = $costoViaje;
    }
    
    public function getCostosAbonadosPasajeros(){
        return $this->costosAbonadosPasajeros;
    }
    
    public function setCostosAbonadosPasajeros($costosAbonadosPasajeros){
        $this->costosAbonadosPasajeros = $costosAbonadosPasajeros;
    }

    
    // metodos nuevos

    public function agregarPasajeroEstandar($nombre, $apellido, $telefono, $numDocumento, $nroAsiento, $nroTicket){
        $colPasajeros = $this->getPasajeros();
        $nuevoPasajero = new PasajeroEstandar($nombre, $apellido, $telefono, $numDocumento, $nroAsiento, $nroTicket);
        array_push($colPasajeros, $nuevoPasajero);
        $this->setPasajeros($colPasajeros);

        // cada vez que se agrega un pasajero se actualiza el costo final del viaje
        $costoViaje = $this->getCostoViaje();
        $costos = $this->getCostosAbonadosPasajeros();
        $porcentaje = $nuevoPasajero->darPorcentajeIncremento();
        $costoFinal = ($costoViaje * $porcentaje) / 100;
        $costoFinal = $costoFinal + $costoViaje;
        $costos = $costos + $costoFinal;
        $this->setCostosAbonadosPasajeros($costoFinal);
    }

    public function agregarPasajeroVip($nombre, $apellido, $telefono, $numDocumento, $nroViajeroFrecuente, $cantMillas){
        $colPasajeros = $this->getPasajeros();
        $nuevoPasajeroVip = new PasajeroVIP($nombre, $apellido, $telefono, $numDocumento, $nroViajeroFrecuente, $cantMillas);
        array_push($colPasajeros, $nuevoPasajeroVip);
        $this->setPasajeros($colPasajeros);

        $costoViaje = $this->getCostoViaje();
        $costos = $this->getCostosAbonadosPasajeros();
        $porcentaje = $nuevoPasajeroVip->darPorcentajeIncremento();
        $costoFinal = ($costoViaje * $porcentaje) / 100;
        $costoFinal = $costoFinal + $costoViaje;
        $costos = $costos + $costoFinal;
        $this->setCostosAbonadosPasajeros($costoFinal);
    }

    /**
     * La funcion del pasajero diferente solo acepta desde el test que se le ingrese un 0 o 1, para las variables espceciales 
     * de silla de ruedas, asistencia y comida especial, para determinar si las necesita o no.
     */
    public function agregarPasajeroDiferente($nombre, $apellido, $telefono, $numDocumento, $sillaRuedas, $asistenciaBarque, $comidaEspecial){
        $colPasajeros = $this->getPasajeros();
        $nuevoPasajeroDiferente = new PasajeroDiferente($nombre, $apellido, $telefono, $numDocumento, $sillaRuedas, $asistenciaBarque, $comidaEspecial);
        array_push($colPasajeros, $nuevoPasajeroDiferente);
        $this->setPasajeros($colPasajeros);

        $costoViaje = $this->getCostoViaje();
        $costos = $this->getCostosAbonadosPasajeros();
        $porcentaje = $nuevoPasajeroDiferente->darPorcentajeIncremento();
        $costoFinal = ($costoViaje * $porcentaje) / 100;
        $costoFinal = $costoFinal + $costoViaje;
        $costos = $costos + $costoFinal;
        $this->setCostosAbonadosPasajeros($costoFinal);
    }


    public function modificarPasajeroEstandar($indice, $nombre, $apellido, $telefono, $numDocumento){
        $indice = $indice - 1;
        $colPasajeros = $this->getPasajeros();
        $nroTicket = $colPasajeros[$indice]-> getNroTicket();
        $nroAsiento = $indice;
        $personaModificada = new PasajeroEstandar($nombre, $apellido, $telefono, $numDocumento, $nroAsiento, $nroTicket);
        $colPasajeros [$indice] = $personaModificada;
        $this->setPasajeros($colPasajeros);
    }

    public function modificarPasajeroVip($indice, $nombre, $apellido, $telefono, $numDocumento, $nroViajeroFrecuente, $cantMillas){
        $indice = $indice - 1;
        $colPasajeros = $this->getPasajeros();
        $pasajeroVip = new PasajeroVip($nombre, $apellido, $telefono, $numDocumento, $nroViajeroFrecuente, $cantMillas);
        $colPasajeros [$indice] = $pasajeroVip;
        $this->setPasajeros($colPasajeros);
    }

    public function modificarPasajeroDiferente ($indice, $nombre, $apellido, $telefono, $numDocumento, $sillaRuedas, $asistenciaBarque, $comidaEspecial) {
        $indice = $indice - 1;
        $colPasajeros = $this->getPasajeros();
        $pasajeroDif = new PasajeroDiferente($nombre, $apellido, $telefono, $numDocumento, $sillaRuedas, $asistenciaBarque, $comidaEspecial);
        $colPasajeros [$indice] = $pasajeroDif;
        $this->setPasajeros($colPasajeros);
    }

    // metodo para agregar un nuevo pasajero
    public function nuevoPasajeroEstandar($objPasajero) {
        $colPasajeros = $this->getPasajeros();
        $costosPasajero = $this->getCostosAbonadosPasajeros();
        $costoViaje = $this->getCostoViaje();
        $porcentaje = $objPasajero->darPorcentajeIncremento();
        $costoFinal = 0;

        if ($this->hayPasajesDisponible()) {
            array_push($colPasajeros, $objPasajero);
            $this->setPasajeros($colPasajeros);

            $costoFinal = ($costoViaje * $porcentaje) / 100; // se calcula el costo final del viaje con el incremento
            $costoFinal = $costoFinal + $costoViaje; // se le suma el costo del viaje al costo final
            $costosPasajero = $costosPasajero + $costoFinal; // se suma al costo total del pasajero el costo final del viaje
            $this->setCostosAbonadosPasajeros($costosPasajero);
        }
        return $costoFinal;
    }

    public function hayPasajesDisponible() {
        $colPasajeros = $this->getPasajeros();
        $pasajeDisponible = false;

        if (count($colPasajeros) < $this->getCantMaxPasajeros()) {
            $pasajeDisponible = true;
        }

        return $pasajeDisponible;
    }


    public function venderPasaje($objPasajero){
        $colPasajeros = $this->getPasajeros();
        $costoViaje = $this->getCostoViaje();
        $costos = $this->getCostosAbonadosPasajeros();
        $porcentaje = $objPasajero->darPorcentajeIncremento();
        
        if ($this->hayPasajesDisponible()){
            array_push($colPasajeros, $objPasajero);
            $this->setPasajeros($colPasajeros);
            $costoFinal = ($costoViaje * $porcentaje) / 100;
            $costoFinal = $costoFinal + $costoViaje;
            $costos = $costos + $costoFinal;
            $this->setCostosAbonadosPasajeros($costos);
        }else {
            $costoFinal = 0;
        }
        return $costoFinal;
    }

    // Metodo para modificar a la persona a cargo del viaje
    public function modificarResponsable($numEmpleado, $numLicencia, $nombre, $apellido) {
        if ($this->getObjResponsable() != null && $this->getObjResponsable()->getNumEmpleado() == $numEmpleado) {
            $this->getObjResponsable()->setNumLicencia($numLicencia);
            $this->getObjResponsable()->setNombre($nombre);
            $this->getObjResponsable()->setApellido($apellido);
        }
        $this->setResponsable($this->getObjResponsable());
    }


    // metodo para mostrar la coleccion de pasajero
    public function mostrarColPasajero() {
        $colPasajeros = $this->getPasajeros();
        $infoPasajero = "";

        foreach ($colPasajeros as $indice => $pasajero) { // en cada iteracion, se accede a la informacion de $pasajero ubicada en $indice
            $infoPasajero .= "\n\nPasajero: " . ($indice + 1) . " \n";
            foreach ($pasajero as $clave => $valor) { // se accede a la informacion de $valor a travez de la $clave de $pasajeros
                $infoPasajero .= $clave . ": " . $valor . " \n";
            }
        }
        return $infoPasajero;
    }

    public function __toString(){
        return "Codigo de viaje: " . $this->getCodigoDeViaje() . "\n El destino: " . $this->getDestino() . "\nCantidad Maxima de pasajeros: " . $this->getCantMaxPasajeros() . "\nCosto del viaje: " . $this->getCostoViaje() . "\nCostos abonados de los pasajeros: " . $this->getCostosAbonadosPasajeros() . "\n\nResponsable: " . $this->getObjResponsable() . "\n" . $this->mostrarColPasajero();
    }
}