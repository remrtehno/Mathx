-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 08 2020 г., 12:28
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
-- База данных: `mathexpe_tests`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fiz_form_1`
--

CREATE TABLE `fiz_form_1` (
  `id` int(11) NOT NULL,
  `glava` text COLLATE utf8_unicode_ci NOT NULL,
  `text_formula` text COLLATE utf8_unicode_ci NOT NULL,
  `formula` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `fiz_form_1`
--

INSERT INTO `fiz_form_1` (`id`, `glava`, `text_formula`, `formula`) VALUES
(1, '1', 'Формула пути при равномерном движении:', 's=vt');

-- --------------------------------------------------------

--
-- Структура таблицы `mat_a1_1`
--

CREATE TABLE `mat_a1_1` (
  `id` int(11) NOT NULL,
  `uslovie` text COLLATE utf8_unicode_ci NOT NULL,
  `otvet` text COLLATE utf8_unicode_ci NOT NULL,
  `kod_otvet` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `mat_a1_1`
--

INSERT INTO `mat_a1_1` (`id`, `uslovie`, `otvet`, `kod_otvet`) VALUES
(1, 'Укажите ряд, составленный из простых чисел. <br> A) $3, 5, 7, 9$ $\\;$ B) $1, 2, 3, 5, 7$ $\\;$ C) $2, 3, 5, 7, 21$ $\\;$ D) $2, 3, 5, 7, 19, 29$', '-', 'D'),
(2, 'На какое число делится без остатка число $17827542$? <br> A) $4$ $\\;$ B) $8$ $\\;$ C) $6$ $\\;$ D) $12$', '-', 'C'),
(3, 'Найдите наибольший делитель среди трехзначных чисел для числа $111777$. <br> A) $703$ $\\;$ B) $159$ $\\;$ C) $177$ $\\;$ D) $111$', '-', 'A'),
(4, 'Найти остаток при делении семизначного числа вида $11...1$ на $11$.', '$1$', '1'),
(5, 'Представить число $50600$ в каноническом виде.', '$2^3\\cdot5^2\\cdot11\\cdot23$', '2^3*5^2*11*23'),
(6, 'Найдите канонический вид числа $33\\cdot18^2\\cdot24^3$. <br> <b> Примечание. </b> Необходимо записать в таком виде $2^n\\cdot3^m\\cdot...$ и т.д. <br> Степень $1$ писать не нужно.', '$2^{11}\\cdot3^8\\cdot11$', '2^{11}*3^8*11 : 2^11*3^8*11 : 2^{11}*3^8*11^1 : 2^11*3^8*11^1'),
(8, 'В каноническом разложении числа $1\\cdot2\\cdot3\\cdot...\\cdot30$ имеются множители вида $2^n, 3^m$ и $7^k$. Найти сумму $n + m + k$.', '$44$', '44'),
(9, 'Сколько натуральных делителей имеет произведение $1\\cdot2\\cdot3\\cdot4\\cdot5\\cdot6\\cdot7\\cdot8\\cdot9\\cdot10$? <br> <b> Указание. </b> Использовать формулу для $N$ из теории.', '$270$', '270'),
(10, 'Найти сумму всех натуральных делителей числа $1440$. <br> <b> Указание. </b> Использовать формулу для $\\sigma(n)$ из теории.', '$4914$', '4914'),
(11, 'Найдите сумму натуральных делителей произведения $144\\cdot49$. <br> <b> Указание. </b> Использовать формулу для $\\sigma(n)$ из теории.', '$22971$', '22971');

-- --------------------------------------------------------

--
-- Структура таблицы `mat_a1_2`
--

CREATE TABLE `mat_a1_2` (
  `id` int(11) NOT NULL,
  `uslovie` text COLLATE utf8_unicode_ci NOT NULL,
  `otvet` text COLLATE utf8_unicode_ci NOT NULL,
  `kod_otvet` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `mat_a1_2`
--

INSERT INTO `mat_a1_2` (`id`, `uslovie`, `otvet`, `kod_otvet`) VALUES
(1, 'Какое из чисел меньших $18$ обладает наибольшим количеством делителей? <br> A) $14$ $\\;$ B) $15$ $\\;$ C) $12$ $\\;$ D) $16$ <br> <b> Указание. </b> Исходить из ответов.', '-', 'C'),
(2, 'Найдите сумму общих делителей чисел $144$ и $128$.', '$31$', '31'),
(3, 'Сколько общих делителей имеют числа $1434$ и $1456$? <br> <b> Указание. </b> При $a>b$ верно $\\text{НОД}\\,(a;b)=\\text{НОД}\\,(a-b;b)$. <br> <b> Примечание. </b> Если не имеют общих делителей то писать $0$. ', '$2$', '2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `fiz_form_1`
--
ALTER TABLE `fiz_form_1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mat_a1_1`
--
ALTER TABLE `mat_a1_1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mat_a1_2`
--
ALTER TABLE `mat_a1_2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `fiz_form_1`
--
ALTER TABLE `fiz_form_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `mat_a1_1`
--
ALTER TABLE `mat_a1_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `mat_a1_2`
--
ALTER TABLE `mat_a1_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
