<?php

    define('DB_HOST', 'localhost');
    define('DB_USER', 'us_pruebas');
    define('DB_PASS', 'Uask141');
    define('DB_NAME', 'db_pruebas');

    require_once 'Database.php';

    $db = new Database;

    // ====== Ejecutar solo una vez ========
    /*
    $libros = [
        [
            'nombre' => "La piedra en la espada",
            'fecha_publicado' => '1998-01-12 12:00:01'
        ],
        [
            'nombre' => "Cronica de un cena anunciada",
            'fecha_publicado' => '1999-02-15 08:30:00'
        ],
        [
            'nombre' => "Los 3 reyes magos",
            'fecha_publicado' => '2000-05-20 10:30:00'
        ],
        [
            'nombre' => "El monje que compro un ferrari",
            'fecha_publicado' => '2007-06-25 17:50:00'
        ],
        [
            'nombre' => "Padre rico, padre pobre",
            'fecha_publicado' => '2010-10-01 09:00:00'
        ]
        ];

    foreach ($libros as $libro) {
        $db->query("INSERT INTO tb_libros(`nombre`, `fecha_publicado`) values (:p_nombre, :p_fecha_publicado)");
        $db->bind(':p_nombre', $libro['nombre']);
        $db->bind(':p_fecha_publicado', $libro['fecha_publicado']);
        $db->execute();
    }
    */

    function get_current_count($db) {
        $db->query("SELECT count(*) as 'count' from tb_libros;");
        $contadorResult = $db->single();
        return $contadorResult->count;
    }

    function get_registros_asc($db) {
        $db->query("SELECT * from tb_libros r order by r.fecha_publicado asc;");
        return $db->resultSet();
    }

    function get_registros_desc($db) {
        $db->query("SELECT * from tb_libros r order by r.fecha_publicado desc;");
        return $db->resultSet();
    }


    $registros_actuales = get_current_count($db);
    
    header('Content-Type: application/json');
    $registros_asc = get_registros_asc($db);
    $registros_desc = get_registros_desc($db); 

    $response = [
        'count' => $registros_actuales,
        'data_desc' => $registros_desc,
        'data_asc' => $registros_asc
    ];
    echo json_encode($response);