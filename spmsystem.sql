-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 01 2019 г., 16:41
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `spmsystem`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `attributes`
--

INSERT INTO `attributes` (`id`, `title`) VALUES
(1, 'color'),
(2, 'size');

-- --------------------------------------------------------

--
-- Структура таблицы `prods_attrs`
--

CREATE TABLE `prods_attrs` (
  `prod_id` int(11) UNSIGNED NOT NULL,
  `attr_id` int(11) UNSIGNED NOT NULL,
  `value_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prods_attrs`
--

INSERT INTO `prods_attrs` (`prod_id`, `attr_id`, `value_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 1),
(4, 2, 4),
(5, 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`) VALUES
(1, 'Jacket', 'New man&#39;s jacket', '42.95', 'uploads/d77d9d4fcbjacket.jpg'),
(2, 'T-shirt', 'New T-shirt', '2.00', 'uploads/8b304a9eb4t_shirts.jpg'),
(3, 'Shoes', 'New woman&#39;s shoes', '15.99', 'uploads/c484b1bc8fshoes.jpeg'),
(4, 'Shirt', 'New blue shirt', '4.95', 'uploads/c5c2587f1fshirt.jpg'),
(5, 'Product', 'No-image product', '1.00', 'images/no-image.png');

-- --------------------------------------------------------

--
-- Структура таблицы `vals`
--

CREATE TABLE `vals` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `attr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vals`
--

INSERT INTO `vals` (`id`, `title`, `attr_id`) VALUES
(1, 'white', 1),
(2, 'black', 1),
(3, 's', 2),
(4, 'm', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prods_attrs`
--
ALTER TABLE `prods_attrs`
  ADD PRIMARY KEY (`prod_id`,`attr_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vals`
--
ALTER TABLE `vals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `vals`
--
ALTER TABLE `vals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
