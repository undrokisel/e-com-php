-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 21 2024 г., 14:42
-- Версия сервера: 5.7.38
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `magazon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(13) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_street` varchar(255) NOT NULL,
  `user_house` varchar(255) NOT NULL,
  `user_flat` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(9, 'Тиара', 'Кольца', 'Кольцо Тиара розовое из латуни с покрытием желтым золотом', 'tiara1.jpg', 'tiara2.jpg', 'tiara1.jpg', 'tiara2.jpg', '3900.00', 0, '0'),
(10, 'Я звезда', 'Серьги', 'Серьги из серебра 925 с эмалью и покрытием желтым золотом', 'star1.jpg', 'star2.jpg', 'star1.jpg', 'star2.jpg', '2500.00', 0, '0'),
(11, 'Каменное сердце', 'Кольца', 'Кольцо Pokerface из серебра 925 с покрытием белым родием</br>\nДлина - 3.6 см\n</br>Ширина - 2.8 см\n</br>Высота - 1.6 см\n</br>вес - 17.2 г', 'heart1.jpg', 'heart2.jpg', 'heart1.jpg', 'heart2.jpg', '4800.00', 0, '0'),
(12, 'Тигр', 'Кольца', 'Кольцо из серебра 925 с покрытием желтым золотом. </br>Длина\r\n 2.4 см</br>Ширина 2.2 см</br>Высота 1.3 см.</br>Средний вес\r\n17.9г', 'tigr1.jpg', 'tigr2.jpg', 'tigr3.jpg', 'tigr4.jpg', '7800.00', 0, '0'),
(13, 'Аллигатор', 'Кольца', 'Кольцо из серебра 925 с опалами и покрытием античным золотом</br>\r\nВес 15.5г', 'crok1.jpg', 'crok2.jpg', 'crok3.jpg', 'crok4.jpg', '4900.00', 0, '0'),
(14, 'Артефакт', 'Кольца', 'Кольцо из серебра 925 с кварцем и покрытием античным золотом\r\n</br>Длина 4.5 см\r\n</br>Ширина 2 см\r\n</br>Средний вес 10.4г', 'arte1.jfif', 'arte2.jfif', 'arte1.jfif', 'arte2.jfif', '6300.00', 0, '0'),
(16, 'Бабочка', 'Броши', 'Брошь из серебра 925 с эмалью и покрытием желтым золотом.\r\n</br>Длина 6 см\r\n</br>Ширина 7 см\r\n</br>Вес 15.5г', 'butter1.jfif', 'butter2.jfif', 'butter3.jfif', 'butter4.jfif', '2300.00', 0, '0'),
(17, 'Стрекоза', 'Броши', 'Брошь из серебра 925 с эмалью и покрытием желтым золотом — элегантная и стильная вещь, выполненная в бохо-дизайне. \r\n</br>Длина 5 см\r\n</br>Ширина 8 см\r\n</br>Вес 11.8г', 'dragon1.jfif', 'dragon2.jfif', 'dragon1.jfif', 'dragon2.jfif', '9200.00', 0, '0'),
(18, 'Натурелия', 'Серьги', 'Серьги из серебра 925 c покрытием желтым золотом\r\n</br>Вес - 14 гр', 'natur1.jpg', 'natur2.jpg', 'natur3.jpg', 'natur4.jpg', '1900.00', 0, '0'),
(19, 'Ариадна', 'Серьги', 'Серьги подвесные из серебра 925 с эмалью и покрытием желтым золотом\r\n</br>Вес 6.7г', 'ariadna1.jpg', 'ariadna2.jpg', 'ariadna1.jpg', 'ariadna2.jpg', '1200.00', 0, '0'),
(20, 'Гекко', 'Кольца', 'Кольцо из серебра 925 с аметистом и покрытием желтым золотом\r\n</br>Вес 18.2г', 'gecko1.jpg', 'gecko2.jpg', 'gecko1.jpg', 'gecko2.jpg', '500.00', 0, '0'),
(21, 'Лакки', 'Серьги', 'Серьги из серебра 925 с агатом и покрытием желтым золотом\r\n</br>вес 8.6 г', 'lucky1.jpg', 'lucky2.jpg', 'lucky1.jpg', 'lucky2.jpg', '4400.00', 1, '1'),
(22, 'Лошадка', 'Броши', 'Брошь из серебра 925 с эмалью и покрытием черным родием\r\n</br>вес - 38.7 г', 'pony1.jpg', 'pony2.jpg', 'pony1.jpg', 'pony2.jpg', '3300.00', 0, '0'),
(23, 'Загадка Давинчи', 'Колье', 'Колье из серебра 925 с покрытием желтым золотом\r\n</br>вес - 20.7 г', 'hint1.jpg', 'hint2.jpg', 'hint1.jpg', 'hint2.jpg', '1900.00', 0, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(2, 'dron', 'dron@dron', 'bfbd27c47fb3a49507d93643e45fb1bb');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
