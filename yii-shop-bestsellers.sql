-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 11 2017 г., 14:54
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii-shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`, `createdAt`, `updatedAt`) VALUES
(1, 'admin1', '$2y$13$WBi7JOsXDqBoN6X1BWbobOtmLERddbLsadmEYP7YNjq3CuhuvmYJa', '2017-02-04 18:56:35', '2017-02-04 18:56:35');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `parentId`, `createdAt`, `updatedAt`) VALUES
(1, 'Category 1', NULL, '2017-01-21 19:43:37', '2017-01-21 19:43:37'),
(2, 'Category 2', NULL, '2017-01-28 16:04:21', '2017-01-28 16:19:44'),
(3, 'Category 3', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(4, 'Category 4', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(5, 'Category 5', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(6, 'Category 6', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(7, 'Category 7', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(8, 'Category 8', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(9, 'Category 9', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(10, 'Category 10', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(11, 'Category 11', NULL, '2017-01-28 16:22:18', '2017-01-28 16:22:18'),
(12, 'Category 12', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(13, 'Category 13', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(14, 'Category 14', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(15, 'Category 15', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(16, 'Category 16', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(17, 'Category 17', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(18, 'Category 18', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(19, 'Category 19', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(20, 'Category 20', NULL, '2017-01-28 16:22:19', '2017-01-28 16:22:19'),
(21, 'Category 1 - 1', 1, '2017-01-28 17:19:22', '2017-01-28 17:37:15'),
(22, 'Category 1 - 2', 1, '2017-01-28 17:20:32', '2017-01-28 17:20:32');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `sum` float NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `name`, `email`, `phone`, `address`, `qty`, `sum`, `createdAt`, `updatedAt`) VALUES
(1, 'name', 'email@mail.ru', '2224564', 'address', 3, 1000, '2017-03-09 20:17:45', '2017-03-09 20:17:45'),
(2, 'name1', 'email1@mail.ru', '1234565', 'адрес1', 3, 1000, '2017-03-09 20:38:30', '2017-03-09 20:38:30'),
(3, 'аывща', 'dfj@mail.ru', '25984', 'hgyih', 1, 500, '2017-03-09 21:14:30', '2017-03-09 21:14:30');

-- --------------------------------------------------------

--
-- Структура таблицы `orderitems`
--

CREATE TABLE `orderitems` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderitems`
--

INSERT INTO `orderitems` (`orderId`, `productId`, `name`, `price`, `qty`, `sum`) VALUES
(1, 3, 'Товар 1 - 3', 200, 1, 200),
(1, 4, 'product 2', 300, 1, 300),
(1, 5, 'product 3', 500, 1, 500),
(2, 3, 'Товар 1 - 3', 200, 1, 200),
(2, 4, 'product 2', 300, 1, 300),
(2, 5, 'product 3', 500, 1, 500),
(3, 5, 'product 3', 500, 1, 500);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(16) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `bestseller` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `categoryId`, `price`, `description`, `image`, `createdAt`, `updatedAt`, `bestseller`) VALUES
(1, 'Товар 1 - 1', 1, '100.00', 'When I mention Critical CSS to many frontend developers, I’m often met with a countenance that’s a subtle mixture of confusion and skepticism.', '', '2017-02-02 18:55:47', '2017-03-08 11:41:02', 0),
(2, 'Товар 1 - 2', 1, '100.00', 'When I mention Critical CSS to many frontend developers, I’m often met with a countenance that’s a subtle mixture of confusion and skepticism.', '', '2017-02-04 17:52:31', '2017-03-11 13:48:13', 0),
(3, 'Товар 1 - 3', 1, '200.00', 'When I mention Critical CSS to many frontend developers, I’m often met with a countenance that’s a subtle mixture of confusion and skepticism.', 'Q4QEiDRiK-9gjvUJ', '2017-02-04 17:56:59', '2017-03-09 12:47:50', 1),
(4, 'product 2', 2, '300.00', 'Implementing Critical CSS is an essential part of modern website development, this article shows you how to do it', 'ilE_o5z9SgaEvGzQ', '2017-03-08 11:37:48', '2017-03-08 17:27:22', 1),
(5, 'product 3', 2, '500.00', 'Critical CSS is about courtesy and respect for the visitors of our website. ', 'zkeO4SU09EmiFPGj', '2017-03-08 16:46:21', '2017-03-09 13:30:29', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_to_category`
--

CREATE TABLE `product_to_category` (
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_to_category`
--

INSERT INTO `product_to_category` (`productId`, `categoryId`) VALUES
(1, 1),
(2, 1),
(2, 1),
(3, 1),
(3, 1),
(4, 2),
(4, 2),
(4, 4),
(4, 6),
(5, 1),
(5, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `createdAt`, `updatedAt`) VALUES
(1, 'user1', '$2y$13$5ZhmYTpfJMUiBQcyFltrNOO4d//mp6g8Y7FbzADX4NDOGv2gGufvq', '2017-02-18 16:54:43', '2017-02-18 16:54:43');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_login_uindex` (`login`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Category_name_uindex` (`name`),
  ADD KEY `category_category_id_fk` (`parentId`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderitems`
--
ALTER TABLE `orderitems`
  ADD KEY `orderId` (`orderId`,`productId`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name_uindex` (`name`),
  ADD KEY `product_category_id_fk` (`categoryId`);

--
-- Индексы таблицы `product_to_category`
--
ALTER TABLE `product_to_category`
  ADD KEY `productId` (`productId`,`categoryId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_login_uindex` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_category_id_fk` FOREIGN KEY (`parentId`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_fk` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `product_to_category`
--
ALTER TABLE `product_to_category`
  ADD CONSTRAINT `product_to_category_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_to_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
