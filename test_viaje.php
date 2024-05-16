<?php

include_once "Persona.php";
include_once "Viaje.php";
include_once "PasajeroEstandar.php";
include_once "PasajeroVip.php";
include_once "PasajeroDiferente.php";
include_once "ResponsableV.php";

echo "\n\nBienvenido a viaje feliz!\n\n";

$coleccionDePasajeros = array();
$viaje = null;

$opcion = 0;


while ($opcion != 4) {
    echo "\nMENU\n";
    echo "1- Cargar informacion del viaje\n";
    echo "2- Ver informacion del viaje\n";
    echo "3- Modificar informacion del viaje\n";
    echo "4- Salir\n\n";

    echo "Seleccione una opcion: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion < 1 || $opcion > 4 || !is_numeric($opcion)) {
        echo "Opcion invalida, vuelva a intentarlo\n\n";
    }

    switch ($opcion) {
        case 1:
            echo "Ingrese codigo del viaje: \n";
            $codigo = trim(fgets(STDIN));
            echo "Ingrese destino del viaje: \n";
            $destino = trim(fgets(STDIN));
            echo "Ingrese la cantidad maxima de pasajeros del viaje: \n";
            $cantMaxPasajeros = trim(fgets(STDIN));
            while (!is_numeric($cantMaxPasajeros)){
                echo "\nIncorrecto, volver a ingresar la cantidad maxima de pasajeros: ";
                $cantMaxPasajeros = trim(fgets(STDIN));
            }
            echo "\nIngrese costo del viaje: ";
            $costoViaje = trim(fgets(STDIN));
            
            echo "\nAhora le vamos a pedir los datos de la persona a cargo del viaje. \n\n";
            echo "Ingrese numero de empleado: \n";
            $numEmpleado = trim(fgets(STDIN));
            echo "Ingrese numero de licencia: \n";
            $numLicencia = trim(fgets(STDIN));
            echo "Ingrese nombre del responsable: \n";
            $nombreResponsable = trim(fgets(STDIN));
            echo "Ingrese apellido del responsable: \n";
            $apellidoResponsable = trim(fgets(STDIN));
            
            $objResponsable = new ResponsableV($numEmpleado, $numLicencia, $nombreResponsable, $apellidoResponsable);

            echo "Ahora agregue pasajeros al viaje. \n";
            echo "Cuantos pasajeros quiere agregar: \n";
            $numP = trim(fgets(STDIN));
            while (!is_numeric($numP) || $numP > $cantMaxPasajeros){
                echo "\nIncorrecto, volver a ingresar el numero de pasajeros: ";
                $numP = trim(fgets(STDIN));
            }

            
            $viaje = new Viaje($codigo, $destino, $cantMaxPasajeros, $coleccionDePasajeros ,$objResponsable, $costoViaje, 0);


            for ($i=0; $i < $numP; $i++){
                echo "\n Pasajero numero: ". $i + 1;
                
                echo "
                \n 1-Pasajero Estandar.
                \n 2-Pasajero Vip.
                \n 3-Pasajero Diferente.";
                echo "\nIngrese el tipo de pasajero: ";
                $tipo = trim(fgets(STDIN));
                while (($tipo > 3 || $tipo < 1) || !(is_numeric($tipo))){
                    echo "\n Opcion invalida, porfavor volver a ingresar el tipo del pasajero: ";
                    $tipo = trim(fgets(STDIN));
                }

                if ($tipo == 1) {
                    echo "\n-Pasajero Estandar-\n";
                    echo "\nNombre:";
                    $nombeEstandar = trim(fgets(STDIN));
                    echo "\nApellido:";
                    $apellidoEstandar = trim(fgets(STDIN));
                    echo "\nNumero de telefono:";
                    $telefonoEstandar = trim(fgets(STDIN));
                    echo "\nDocumento:";
                    $numDocEstandar = trim(fgets(STDIN));
                    echo "\nTendra el numero de asiento: " . $i + 1;
                    $nroAsientoEstandar = $i + 1;
                    echo "\nEl numero de ticket es: " . $i + 100;
                    $nroTicketEstandar = $i + 100;

                    $viaje->agregarPasajeroEstandar($nombreEstandar, $apellidoEstandar, $telefonoEstandar, $numDocEstandar, $nroAsientoEstandar, $nroTicketEstandar);
                } elseif ($tipo == 2) {
                    echo "\n -Pasajero VIP-";
                    echo "\nNombre";
                    $nombreVip = trim(fgets(STDIN));
                    echo "\nApellido: ";
                    $apellidoVip = trim(fgets(STDIN));
                    echo "\nNumero de telefono: ";
                    $telefonoVip =trim(fgets(STDIN));
                    echo "\nNumero de documento: ";
                    $numDocVip = trim(fgets(STDIN));
                    echo "\nIngrese el numero de viajero frecuente: ";
                    $numFrecuente = trim(fgets(STDIN));
                    echo "\nIngrese la cantidad de millas acumuladas: ";
                    $millas = trim(fgets(STDIN));

                    $viaje->agregarPasajeroVip($nombreVip, $apellidoVip, $telefonoVip, $numDocVip, $numFrecuente, $millas);
                } elseif ($tipo == 3) {
                    echo "\n-Pasajero Diferente-";
                    echo "\nNombre: ";
                    $nombreDif = trim(fgets(STDIN));
                    echo "\nApellido: ";
                    $apellidoDif = trim(fgets(STDIN));
                    echo "\nNumero de telefono: ";
                    $telefonoDif = trim(fgets(STDIN));
                    echo "\nNumero de documento: ";
                    $numDocDif = trim(fgets(STDIN));
                    echo "\nAhora ingrese con 0 que refiere a NO, o 1 que refiere a SI,";
                    echo "\nSi el pasajero necesita las siguientes cosas: ";
                    echo "\n\nEl pasajero necesita silla de ruedas: ";
                    $sillaDeRuedas = trim(fgets(STDIN));
                    while (!(is_numeric($sillaDeRuedas)) || ($sillaDeRuedas > 1 || $sillaDeRuedas < 0)){
                        echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                        $sillaDeRuedas = trim(fgets(STDIN));
                    }
                    echo "\n  El pasajero necesita asistencia para el embarque o desembarque: ";
                    $asistenciaBarque = trim(fgets(STDIN));
                    while (!(is_numeric($asistenciaBarque)) || ($asistenciaBarque > 1 || $asistenciaBarque < 0)){
                        echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                        $asistenciaBarque = trim(fgets(STDIN));
                    }
                    echo "\n  El pasajero necesita comida especial: ";
                    $comidaEspecial = trim(fgets(STDIN));
                    while (!(is_numeric($comidaEspecial)) || ($comidaEspecial > 1 || $comidaEspecial < 0)){
                        echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                        $comidaEspecial = trim(fgets(STDIN));
                    }

                    $viaje->agregarPasajeroDiferente($nombreDif, $apellidoDif, $telefonoDif, $numDocDif, $sillaDeRuedas, $asistenciaBarque, $comidaEspecial);
                }
            }
        break;

        case 2:
            if ($viaje == null) {
                echo "No existe ningun viaje registrado.\n";
                echo "Primero debe cargar un viaje. \n";
            } else {
                $infoViaje = $viaje->__toString();
                echo $infoViaje;
            }
        break;

        case 3:
            $opcionDos = null;

            if ($viaje == null) {
                echo "No existe ningun viaje registrado.\n";
                echo "Primero debe cargar un viaje. \n";
            } else {
                while ($opcionDos != 8) {
                    echo "1- Modificar codigo del viaje. \n";
                    echo "2- Modificar destino del viaje. \n";
                    echo "3- Modificar la cantidad maxima de pasajeros. \n";
                    echo "4- Modificar el costo del viaje.\n";
                    echo "5- Modificar responsable. \n";
                    echo "6- Modificar algun pasajero. \n";
                    echo "7- Comprar un pasaje. \n";
                    echo "8- Salir. \n\n";

                    echo "Elija una opcion: \n\n";
                    $opcionDos = trim(fgets(STDIN));

                    if ($opcionDos > 8 || $opcionDos < 1 || !is_numeric($opcionDos)) {
                        echo "Opcion invalida, vuelva a intentarlo\n\n";
                        continue; // Se salta el resto de la iteración y vuelve a la condicion del bucle while
                    }

                    switch ($opcionDos) {
                        case 1:
                            echo "Ingrese nuevo codigo de viaje: \n";
                            $nuevoCodigoViaje = trim(fgets(STDIN));
                            $viaje->setCodigoDeViaje($nuevoCodigoViaje);
                        break;

                        case 2:
                            echo "Ingrese nuevo destino del viaje: \n";
                            $nuevoDestinoViaje = trim(fgets(STDIN));
                            $viaje->setDestino($nuevoDestinoViaje);
                        break;

                        case 3:
                            echo "Ingrese nueva cantidad maxima de pasajeros: \n";
                            $nuevaCantidadMax = trim(fgets(STDIN));
                            $viaje->setCantMaxPasajeros($nuevaCantidadMax);
                        break;

                        case 4;
                            echo "\n Ingrese el nuevo costo del viaje: ";
                            $costoViajeNew = trim(fgets(STDIN));
                            $viaje->setCostoViaje($costoViajeNew);
                        break;

                        case 5:
                            echo "Ingrese numero de empleado del responsable que quiere modificar: \n";
                            $numEmpleado = trim(fgets(STDIN));

                            if ($numEmpleado == $viaje->getObjResponsable()->getNumEmpleado()) {
                                echo "\nAhora ingrese los nuevos datos que quiere modificar: \n\n";
                                echo "Numero de licencia: \n";
                                $nuevoNumLicencia = trim(fgets(STDIN));
                                echo "Nombre del responsable: \n";
                                $nuevoNombreResponsable = trim(fgets(STDIN));
                                echo "Apellido del responsable: \n";
                                $nuevoApellidoResponsable = trim(fgets(STDIN));

                                $viaje->modificarResponsable($numEmpleado, $nuevoNumLicencia, $nuevoNombreResponsable, $nuevoApellidoResponsable);
                            } else {
                                echo "Ningun numero de empleado coincide con el del responsable.\n";
                            }
                        break;

                        case 6:
                            echo "\n Ingrese que numero de pasajero quiere modificar: ";
                            $n = trim(fgets(STDIN));
                            echo "\n Que tipo de pasajero va a ser su pasajero modificado: ";
                            echo "\n  1-Pasajero Estandar.";
                            echo "\n  2-Pasajero VIP.";
                            echo "\n  3-Pasajero Diferente.";
                            $tipoMod = fgets(trim(STDIN));
                            while ($tipoMod > 3 || $tipoMod < 1 || !is_numeric($tipoMod)){
                                echo "Opcion invalida, porfavor selecionar 1, 2 o 3, volver a intentarlo.";
                                $tipoMod = fgets(trim(STDIN));
                            }
                            if ($tipoMod == 1){
                                echo "\n Ingrese los datos modificados del pasajero: ";
                                echo "\n Ingrese el nuevo nombre: ";
                                $nombreNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo apellido: "; 
                                $apellidoNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo numero de telefono: ";
                                $telefonoNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo numero de documento: ";
                                $dniNew = trim(fgets(STDIN));
                                
                                $viaje->modificarPasajero($n, $nombreNew, $apellidoNew, $telefonoNew, $dniNew);
                            }elseif ($tipoMod == 2){
                                echo "\n Ingrese los datos modificados del pasajero: ";
                                echo "\n Ingrese el nuevo nombre: ";
                                $nombreNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo apellido: "; 
                                $apellidoNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo numero de telefono: ";
                                $telefonoNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo numero de documento: ";
                                $dniNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo numero de viajero frecuente: ";
                                $nroViajeroNew = trim(fgets(STDIN));
                                echo "\n Ingrese la nueva cantidad de millas: ";
                                $cantMillasNew = trim(fgets(STDIN));

                                $viaje->modificarPasajeroVIP($$n, $nombreNew, $apellidoNew, $telefonoNew, $dniNew, $nroViajeroNew, $cantMillasNew);
                            }elseif ($tipoMod == 3){
                                echo "\n Ingrese los datos modificados del pasajero: ";
                                echo "\n Ingrese el nuevo nombre: ";
                                $nombreNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo apellido: "; 
                                $apellidoNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo numero de telefono: ";
                                $telefonoNew = trim(fgets(STDIN));
                                echo "\n Ingrese el nuevo numero de documento: ";
                                $dniNew = trim(fgets(STDIN));

                                echo "\n Ahora ingrese con 0 que refiere a NO, o 1 que refiere a SI,";
                                echo "\n si el pasajero necesita las siguientes cosas: ";
                                echo "\n  El pasajero necesita silla de ruedas: ";
                                $sillaDeRuedas = trim(fgets(STDIN));
                                while (!(is_numeric($sillaDeRuedas)) || ($sillaDeRuedas > 1 || $sillaDeRuedas < 0)){
                                    echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                                    $sillaDeRuedas = trim(fgets(STDIN));
                                }
                                echo "\n  El pasajero necesita asistencia para el embarque o desembarque: ";
                                $asistenciaBarque = trim(fgets(STDIN));
                                while (!(is_numeric($asistenciaBarque)) || ($asistenciaBarque > 1 || $asistenciaBarque < 0)){
                                    echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                                    $asistenciaBarque = trim(fgets(STDIN));
                                }
                                echo "\n  El pasajero necesita comida especial: ";
                                $comidaEspecial = trim(fgets(STDIN));
                                while (!(is_numeric($comidaEspecial)) || ($comidaEspecial > 1 || $comidaEspecial < 0)){
                                    echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                                    $comidaEspecial = trim(fgets(STDIN));
                                }

                                $viaje->modificarPasajeroDiferente($n, $nombreNew, $apellidoNew, $telefonoNew, $dniNew, $sillaDeRuedas, $asistenciaBarque, $comidaEspecial);
                            }
                        break;

                        $arregloPasajeros = $viaje->getPasajeros();

                            
                            if (!$viaje->hayPasajesDisponible()){
                                echo "\n No se puede agregar pasajeros, porque esta lleno.\n";
                                echo "\n Modificar la cantidad maxima de pasajeros para poder agregar más.\n";
                            }else {
                                echo "\nBienvenido a la compra de un nuevo pasaje.\n";
                                echo "\n1-Pasajero Estandar.";
                                echo "\n2-Pasajero VIP.";
                                echo "\n3-Pasajero Diferente.";
                                echo "\nIngrese que tipo de ticket quiere: ";
                                $tipo = trim(fgets(STDIN));
                                while (($tipo > 3 || $tipo < 1) || !(is_numeric($tipo))){
                                    echo "\n Porfavor volver a ingresar el tipo de ticket, esa opcion no es valida: ";
                                    $tipo = trim(fgets(STDIN));
                                }

                                if ($tipo == 1){
                                    echo "\n -Pasajero Estandar-";
                                    echo "\n Ingrese el nombre del pasajero: ";
                                    $nombre = trim(fgets(STDIN));
                                    echo "\n Ingrese el apellido del pasajero: ";
                                    $apellido = trim(fgets(STDIN));
                                    echo "\n Ingrese el numero de telefono: ";
                                    $telefono = trim(fgets(STDIN));
                                    echo "\n Ingrese el numero de documento del pasajero: ";
                                    $documento = trim(fgets(STDIN));
                                    echo "\n Tendra el numero de asiento: " . $i + 1;
                                    $numeroAsiento = $i + 1;
                                    echo "\n El numero de ticket es: " . $i + 1435679271231;
                                    $numeroTicket = $i + 1435679271231;

                                    $objPasajero = new PasajeroEstandar($nombre, $apellido, $telefono, $documento, $numeroAsiento, $numeroTicket);
                                    $precio = $viaje->venderPasaje($objPasajero);
                                    echo "\n\nEl precio final es de: $" . $precio . "\nMuchas gracias por comprar un pasaje!";
                                } elseif ($tipo == 2){
                                    echo "\n -Pasajero VIP-";
                                    echo "\n Ingrese el nombre del pasajero: ";
                                    $nombre = trim(fgets(STDIN));
                                    echo "\n Ingrese el apellido del pasajero: ";
                                    $apellido = trim(fgets(STDIN));
                                    echo "\n Ingrese el numero de telefono: ";
                                    $telefono = trim(fgets(STDIN));
                                    echo "\n Ingrese el numero de documento del pasajero: ";
                                    $documento = trim(fgets(STDIN));
                                    echo "\n Ingrese el numero de viajero frecuente: ";
                                    $numFrecuente = trim(fgets(STDIN));
                                    echo "\n Ingrese la cantidad de millas acumuladas: ";
                                    $millas = trim(fgets(STDIN));

                                    $objPasajero = new PasajeroVip($nombre, $apellido, $telefono, $documento, $numFrecuente, $millas);
                                    $precio = $viaje->venderPasaje($objPasajero);
                                    echo "\n\nEl precio final es de: $" . $precio . "\nMuchas gracias por comprar un pasaje!";
                                } elseif ($tipo == 3){
                                    echo "\n -Pasajero Diferente-";
                                    echo "\n Ingrese el nombre del pasajero: ";
                                    $nombre = trim(fgets(STDIN));
                                    echo "\n Ingrese el apellido del pasajero: ";
                                    $apellido = trim(fgets(STDIN));
                                    echo "\n Ingrese el numero de telefono: ";
                                    $telefono = trim(fgets(STDIN));
                                    echo "\n Ingrese el numero de documento del pasajero: ";
                                    $documento = trim(fgets(STDIN));
                                    echo "\n Ahora ingrese con 0 que refiere a NO, o 1 que refiere a SI,";
                                    echo "\n si el pasajero necesita las siguientes cosas: ";
                                    echo "\n  El pasajero necesita silla de ruedas: ";
                                    $sillaDeRuedas = trim(fgets(STDIN));
                                    while (!(is_numeric($sillaDeRuedas)) || ($sillaDeRuedas > 1 || $sillaDeRuedas < 0)){
                                        echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                                        $sillaDeRuedas = trim(fgets(STDIN));
                                    }
                                    echo "\n  El pasajero necesita asistencia para el embarque o desembarque: ";
                                    $asistenciaBarque = trim(fgets(STDIN));
                                    while (!(is_numeric($asistenciaBarque)) || ($asistenciaBarque > 1 || $asistenciaBarque < 0)){
                                        echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                                        $asistenciaBarque = trim(fgets(STDIN));
                                    }
                                    echo "\n  El pasajero necesita comida especial: ";
                                    $comidaEspecial = trim(fgets(STDIN));
                                    while (!(is_numeric($comidaEspecial)) || ($comidaEspecial > 1 || $comidaEspecial < 0)){
                                        echo "\n La opcion no es valida, solo ingresar 1 o 0: ";
                                        $comidaEspecial = trim(fgets(STDIN));

                                    $objPasajero = new PasajeroDiferente($nombre, $apellido, $telefono, $documento, $sillaDeRuedas, $asistenciaBarque, $comidaEspecial);
                                    $precio = $viaje->venderPasaje($objPasajero);
                                    echo "\n\nEl precio final es de: $" . $precio . "\nMuchas gracias por comprar un pasaje!";
                                    }
                                }
                            }
                        break;

                        case 8:
                            echo "Saliendo...";
                        break;
                    }
                }
            }
        break;

        case 4:
            echo "Saliendo...";
        break;
    }
}

?>