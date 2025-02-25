<?php
// rcon_control.php
session_start();

// Ограничим доступ к RCON-функционалу только авторизованным администраторам или нужным пользователям
// Здесь можно добавить проверку авторизации (например, через сессию)
if (!isset($_SESSION['steamid'])) {
    die("Доступ запрещен.");
}

require_once __DIR__ . '/inc/Rcon.php';

// Параметры подключения к серверу
$host = '46.174.52.43';        // IP вашего сервера
$port = 27015;                 // Порт сервера
$rconPassword = 'ciAlweYf28NwXorGsSLs'; // RCON-пароль, как указан в server.cfg

// Создаем экземпляр Rcon (таймаут 3 секунды)
$rcon = new Rcon($host, $port, $rconPassword, 3);

if ($rcon->connect()) {
    // Пример команды: вывод сообщения в чат сервера
    $command = 'say Hello from Vexio!';
    $response = $rcon->sendCommand($command);

    // Логируем или выводим ответ сервера
    echo "Ответ RCON: " . htmlspecialchars($response);
} else {
    echo "Не удалось подключиться к RCON-серверу.";
}
?>
