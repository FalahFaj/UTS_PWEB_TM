<?php

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

function dispatchAction(string $action, array $routes)
{
    if (!isset($routes[$action])) {
        echo "Aksi tidak dikenal.";
        return;
    }

    $route = $routes[$action];

    if (!empty($route['file'])) {
        require_once $route['file'];
    }

    if (!empty($route['callable']) && is_callable($route['callable'])) {
        call_user_func($route['callable']);
        return;
    }

    if (!empty($route['class']) && !empty($route['method'])) {
        $class = $route['class'];
        $method = $route['method'];
        if (!class_exists($class)) {
            echo "Controller class $class tidak ditemukan.";
            return;
        }
        $controller = new $class();
        if (!method_exists($controller, $method)) {
            echo "Metode $method tidak ditemukan di $class.";
            return;
        }
        $controller->$method();
        return;
    }

    echo "Route tidak terkonfigurasi dengan benar.";
}

$routes = [
    'login' => [ 'file' => 'controller/Autentikasi.php', 'class' => 'Authcontroller', 'method' => 'tampilkanLogin' ],
    'doLogin' => [ 'file' => 'controller/Autentikasi.php', 'class' => 'Authcontroller', 'method' => 'login' ],
    'logout' => [ 'file' => 'controller/Autentikasi.php', 'class' => 'Authcontroller', 'method' => 'logout' ],
    'dosenDashboard' => [ 'file' => 'controller/Dosen.php', 'class' => 'DosenController', 'method' => 'dashboard' ],
    'mahasiswaDashboard' => [ 'file' => 'controller/Mahasiswa.php', 'class' => 'MahasiswaController', 'method' => 'dashboard' ],
    // FullCalendar events endpoint
    'events' => [ 'file' => 'controller/Events.php', 'class' => 'EventsController', 'method' => 'list' ],
];

dispatchAction($action, $routes);
?>