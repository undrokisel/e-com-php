<?php

// название вашей базы данных
$dbName = "2is-b06_2is-b06";
// адрес хоста
$hostname = "localhost";
// имя админа базы
$username = "2is-b06_2is-b06";
// пароль для подключения к базе
$password = "fyRkOfzgRs";

$conn = mysqli_connect($hostname, $username, $password, $dbName)
    or die("Ошибка подключения: " . mysqli_connect_error());



