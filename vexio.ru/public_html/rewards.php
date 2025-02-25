<?php
// Включаем отображение ошибок для отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Подключаем автозагрузку Composer, поскольку vendor лежит в public_html
require_once __DIR__ . '/vendor/autoload.php';

// Подключаем остальные файлы (путь относительно public_html)
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';
require_once __DIR__ . '/inc/functions.php';

use xPaw\SourceQuery\SourceQuery;

// Настройки сервера (из вашего server.cfg)
$serverIP     = '46.174.52.43';
$serverPort   = 27015;
$timeout      = 1;
$engine       = SourceQuery::SOURCE;
$rconPassword = 'ciAlweYf28NwXorGsSLs';

// Переменная для хранения результата команды RCON
$output = '';

try {
    $Query = new SourceQuery();
    $Query->Connect($serverIP, $serverPort, $timeout, $engine);
    $Query->SetRconPassword($rconPassword);

    // Отправляем команду RCON 'status' для получения информации о сервере
    $result = $Query->Rcon('status');
    $output = print_r($result, true);
} catch (Exception $e) {
    $output = "Ошибка: " . $e->getMessage();
} finally {
    if (isset($Query)) {
        $Query->Disconnect();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Призы - Vexio</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo"><h1>Vexio</h1></a>
        <nav>
            <a href="index.php" class="nav-btn">Главная</a>
            <a href="tournaments.php" class="nav-btn">Турниры</a>
            <a href="profile.php" class="nav-btn">Профиль</a>
            <a href="rewards.php" class="nav-btn active">Призы</a>
            <a href="rules.php" class="nav-btn">Правила</a>
            <?php if (isLoggedIn()): ?>
                <a href="?logout" class="nav-btn">Выйти</a>
            <?php else: ?>
                <a href="profile.php" class="nav-btn">Войти</a>
            <?php endif; ?>
        </nav>
    </header>
    <main style="padding: 80px 20px;">
        <h1>Тест RCON</h1>
        <pre><?php echo htmlspecialchars($output); ?></pre>
        <a href="index.php">Назад</a>
    </main>
    <footer>
        <p>© 2025 Vexio.ru</p>
    </footer>
</body>
</html>
