<?php

// Definición de la clase Jugador
class Jugador {
    public $nombre;
    public $nivelHabilidad;
    public $fuerza;
    public $velocidad;

    public function __construct($nombre, $nivelHabilidad, $fuerza, $velocidad) {
        $this->nombre = $nombre;
        $this->nivelHabilidad = $nivelHabilidad;
        $this->fuerza = $fuerza;
        $this->velocidad = $velocidad;
    }
}

// Función para simular un enfrentamiento entre dos jugadores
function enfrentamiento($jugador1, $jugador2) {
    // Calcular el puntaje total de cada jugador con un factor de variabilidad adicional reducido
    $puntaje1 = $jugador1->nivelHabilidad * 0.4 + $jugador1->fuerza * 0.3 + $jugador1->velocidad * 0.3 + rand(-3, 5);
    $puntaje2 = $jugador2->nivelHabilidad * 0.4 + $jugador2->fuerza * 0.3 + $jugador2->velocidad * 0.3 + rand(-3, 5);

    // Introducir un factor de suerte más amplio
    $suerte = rand(0, 100); // Genera un número aleatorio entre 0 y 100

    // Determinar al ganador
    if ($suerte < 80) { // 80% de las veces, el jugador con mayor puntaje gana
        if ($puntaje1 > $puntaje2) {
            return $jugador1;
        } else {
            return $jugador2;
        }
    } else { // 20% de las veces, el jugador con menor puntaje gana
        if ($puntaje1 > $puntaje2) {
            return $jugador2;
        } else {
            return $jugador1;
        }
    }
}

// Función para simular un torneo completo y generar un cuadro de torneo
function simularTorneo($jugadores) {
    $ronda = 1;
    $cuadroTorneo = array();

    // Mientras haya más de un jugador en el torneo
    while (count($jugadores) > 1) {
        $ganadores = array();
        $rondaActual = array();

        // Generar enfrentamientos para esta ronda
        for ($i = 0; $i < count($jugadores); $i += 2) {
            $jugador1 = $jugadores[$i];
            $jugador2 = $jugadores[$i + 1];
            $ganador = enfrentamiento($jugador1, $jugador2);
            $ganadores[] = $ganador;
            $rondaActual[] = array($jugador1->nombre, $jugador2->nombre, $ganador->nombre);
        }

        // Agregar los resultados de la ronda al cuadro de torneo
        $cuadroTorneo[] = array("Ronda $ronda" => $rondaActual);

        // Preparar para la siguiente ronda
        $jugadores = $ganadores;
        $ronda++;
    }

    // Mostrar el ganador final
    echo "El ganador del torneo es: " . $jugadores[0]->nombre . "\n\n";

    // Mostrar el cuadro de torneo completo
    foreach ($cuadroTorneo as $ronda) {
        foreach ($ronda as $titulo => $enfrentamientos) {
            echo "$titulo\n";
            foreach ($enfrentamientos as $enfrentamiento) {
                echo $enfrentamiento[0] . " vs " . $enfrentamiento[1] . " - Ganador: " . $enfrentamiento[2] . "\n";
            }
            echo "\n";
        }
    }
}

// Crear jugadores
$jugadores = array(
    new Jugador("Roger Federer", 90, 80, 85),
    new Jugador("Rafael Nadal", 88, 85, 82),
    new Jugador("Novak Djokovic", 92, 82, 88),
    new Jugador("Andy Murray", 85, 88, 80),
    new Jugador("Stefanos Tsitsipas", 80, 90, 75),
    new Jugador("Alexander Zverev", 78, 92, 73),
    new Jugador("Dominic Thiem", 87, 85, 85),
    new Jugador("Daniil Medvedev", 85, 87, 80),
    new Jugador("Kei Nishikori", 85, 80, 88),
    new Jugador("Gael Monfils", 82, 85, 82),
    new Jugador("Milos Raonic", 85, 90, 78),
    new Jugador("Stan Wawrinka", 88, 85, 85),
    new Jugador("David Goffin", 83, 88, 80),
    new Jugador("Felix Auger-Aliassime", 80, 92, 75),
    new Jugador("Denis Shapovalov", 78, 90, 73),
    new Jugador("Grigor Dimitrov", 85, 85, 85)
);

// Simular el torneo y mostrar el cuadro de torneo
simularTorneo($jugadores);
?>
