<?php

    define('DB_HOST', 'localhost');
    define('DB_USER', 'us_pruebas');
    define('DB_PASS', 'Uask141');
    define('DB_NAME', 'db_pruebas');

    require_once 'Database.php';

    $db = new Database;

    function get_current_count($db) {
        $db->query("SELECT count(*) as 'count' from tb_registros;");
        $contadorResult = $db->single();
        return $contadorResult->count;
    }

    function add_new_record($db, $p_nombre) {
        $db->query("INSERT into tb_registros(`nombre`) values(:p_nombre);");
        $db->bind(':p_nombre', $p_nombre);
        $db->execute();
    }

    function print_in_page($str) {
        echo $str . "<br>";
    }

    $registros_actuales = get_current_count($db);
    print_in_page("Contador: " . $registros_actuales);

    $nuevos_registros = [
        "Manolo",
        "Pablo",
        "Julio",
        "Marina",
        "Capitana Marvel",
        "Batman",
        "Aquaman",
        "El Kraken",
        "SuperMan",
        "Iron Man",
        "Calcetin con rombos man"
    ];

    foreach($nuevos_registros as $nuevo_usuario) {
        if ($registros_actuales < 5) {
            add_new_record($db, $nuevo_usuario);
        } else {
            print_in_page("Cupo lleno! " . $registros_actuales);
            break;
        }
        $registros_actuales = get_current_count($db);
    }