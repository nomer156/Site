<?php
// bot_api.php
header('Content-Type: application/json');

// Подключаем конфигурацию и функции для работы с ботом
require_once __DIR__ . '/../config.php';
require_once 'ппп/bot_functions.php'; // файл с функциями бота

// Пример обработки запроса для инициирования трейда
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'initiate_trade') {
        // Получаем параметры трейда, например, SteamID, ID скина, сумма валюты и т.д.
        $steamId = $_POST['steamid'] ?? '';
        $skinId = $_POST['skin_id'] ?? '';
        $currencyAmount = $_POST['currency'] ?? 0;

        // Вызываем функцию инициирования трейда
        $result = initiate_trade($steamId, $skinId, $currencyAmount);
        echo json_encode($result);
        exit;
    }
    // Дополнительные действия можно добавить здесь
}

echo json_encode(['status' => 'error', 'message' => 'Неверный запрос']);
?>
