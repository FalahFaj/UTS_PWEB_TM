<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Muat autoloader Composer dan file .env di awal
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
    if (class_exists('Dotenv\Dotenv')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load(); // Gunakan load() untuk memberikan error jika .env tidak ada
    }
}

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
    'register' => [ 'file' => 'controller/Autentikasi.php', 'class' => 'Authcontroller', 'method' => 'tampilkanRegisterForm' ],
    'doRegister' => [ 'file' => 'controller/Autentikasi.php', 'class'=> 'Authcontroller', 'method'=> 'register'],
    'logout' => [ 'file' => 'controller/Autentikasi.php', 'class' => 'Authcontroller', 'method' => 'logout' ],
    'adminDashboard' => [ 'file' => 'controller/Admin.php', 'class' => 'AdminController', 'method' => 'dashboard' ],
    'showUploadTugasForm' => [ 'file' => 'controller/Admin.php', 'class' => 'AdminController', 'method' => 'showUploadTugasForm' ],
    'uploadTugas' => [ 'file' => 'controller/Admin.php', 'class' => 'AdminController', 'method' => 'uploadTugas' ],
    'mahasiswaDashboard' => [ 'file' => 'controller/Mahasiswa.php', 'class' => 'MahasiswaController', 'method' => 'dashboard' ],
    'events' => [ 'file' => 'controller/Events.php', 'class' => 'EventsController', 'method' => 'list' ],
];

dispatchAction($action, $routes);
?>