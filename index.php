<?php
/**
 * Telegram Bot тупо бот access token и URL.
 */
$access_token = '1144041513:AAGKx5bFDD_bGQjyXR-7DldaxnZRNe7Txt0';
$api = 'https://api.telegram.org/bot' . $access_token;
$film_token = '4cf20938fba0e7a47845a44b394d8a1f';
/**
 * Задаём основные переменные.
 */
$output = json_decode(file_get_contents('php://input'), TRUE);
@$chat_id = $output['message']['chat']['id'];
@$message = $output['message']['text'];
// команды тупо-бота
switch($message) {
    case '/start':
    sendMessage($chat_id, "\xF0\x9F\x93\xA1 Вас приветствует бот testFilm123. Если Вы хотите посмотреть новинки, введите /lastfilms ");
    break;
    case '/lastfilms':
      sendMessage($chat_id, "Смотри последние фильмы-новинки на testFilm123:");
      $url = 'https://api.themoviedb.org/3/trending/all/day?api_key=' . $film_token;
      $films = json_decode(file_get_contents($url), TRUE);
      foreach ($films['results'] as $film) {
        echo '<pre>' . print_r($film['title'], TRUE) . '</pre>';
        file_get_contents($output."/sendmessage?chat_id=".@$chat_id."&text=Here's the last films: ". print_r($film['title'], TRUE));
        sendMessage($chat_id, "Here's the last films: ". print_r($film['title'], TRUE));
      }
      
      
    break;
}

function sendMessage($chat_id, $message) {
  file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&parse_mode=html');
}