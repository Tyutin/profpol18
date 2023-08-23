<?php
if (!empty($_POST['name']) and !empty($_POST['phone'])) {
  $name = htmlspecialchars($_POST["name"]);
  $phone = htmlspecialchars($_POST["phone"]);
  $description = htmlspecialchars($_POST["description"]);

  $sub = "Сообщение с сайта AQUATERRA18.RU";
  $mes = "СООБЩЕНИЕ С САЙТА AQUATERRA18.RU\n
    Имя отправителя: $name
    Телефон отправителя: $phone
    Описание: $description";
  $headers = "From: СООБЩЕНИЕ С САЙТА AQUATERRA18.RU <site@aquaterra18.ru>\r\n";

  if (mail("kerya.tyutin@yandex.ru", $sub, $mes, $headers) and mail("kerya.tyutin@yandex.ru", $sub, $mes, $headers)) {
    http_response_code(200);
    exit;
    http_response_code(400);
    exit;
  }
}
?>