-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 08 2020 г., 00:05
-- Версия сервера: 10.3.21-MariaDB-log-cll-lve
-- Версия PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mathexpe_system`
--

-- --------------------------------------------------------

--
-- Структура таблицы `levels_tests`
--

CREATE TABLE `levels_tests` (
  `id` int(11) NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `levels_tests`
--

INSERT INTO `levels_tests` (`id`, `level`) VALUES
(1, 'A1.1'),
(2, 'A1.2');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `last_name` text CHARACTER SET utf8 DEFAULT NULL,
  `first_name` text CHARACTER SET utf8 DEFAULT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_birth` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_reg` text COLLATE utf8_unicode_ci DEFAULT current_timestamp(),
  `status` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `date_pass` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_test` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_test` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_test` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `admin`, `last_name`, `first_name`, `phone_number`, `password`, `date_birth`, `date_reg`, `status`, `date_pass`, `level`, `level_test`, `start_test`, `end_test`) VALUES
(9, NULL, NULL, NULL, '999', '123', NULL, '2019-11-28 13:04:57', NULL, NULL, NULL, 'A1.1', '1578344280', '1578344280');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
