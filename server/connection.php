<?php

$dbName = "magazon";
$hostname = "localhost";
$username = "root";

$conn = mysqli_connect($hostname, $username, "root", $dbName);
// Проверка соединения
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}


