-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2023 г., 09:46
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `messanger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `group_chat`
--

CREATE TABLE `group_chat` (
  `id` int(10) NOT NULL,
  `user_group` json NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoundDisable` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `group_chat`
--

INSERT INTO `group_chat` (`id`, `user_group`, `Name`, `SoundDisable`) VALUES
(1, '{\"1\": \"admin\", \"2\": \"Jimka\"}', 'Чат с админом 1', '1 '),
(3, '{\"1\": \"admin\", \"2\": \"Jimka\"}', 'Чатс с админом 2', '0 '),
(4, '{\"1\": \"admin\", \"2\": \"Jimka\", \"3\": \"Alice\"}', 'Чатс с админом 3', '0 '),
(5, '{\"1\": \"Jimka\", \"2\": \"Alice\"}', 'Чат простых пользователей 1', '0'),
(6, '{\"1\": \"Jimka\", \"2\": \"Alice\"}', 'Чат простых пользователей 2', '0'),
(7, '{\"1\": \"admin\", \"2\": \"Jimka\"}', 'Чатс с админом 4', '0 '),
(8, '{\"1\": \"Jimka\", \"2\": \"admin\", \"3\": \"Alice\"}', 'Новый чат ', '0 ');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` int(10) DEFAULT NULL,
  `recipientGroupChatId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `text`, `recipient`, `recipientGroupChatId`) VALUES
(1, 1, 'Привет', 0, NULL),
(2, 2, 'Тестовое 1', 0, NULL),
(3, 1, 'Добрый день', 4, NULL),
(4, 2, 'Тестовое 2', 4, NULL),
(5, 1, 'Добрый вечер', 0, NULL),
(6, 1, 'Доброе утро', 4, NULL),
(11, 4, 'Добрый день Маришка', 1, NULL),
(21, 5, 'С днюхой ', 4, NULL),
(161, 5, 'С днюхой ', 5, NULL),
(176, 4, 'Добрый день Джимка ', 2, NULL),
(199, 4, 'Добрый день простым пользователям', 0, 1),
(200, 5, 'С днюхой Админ', 4, 3),
(201, 2, 'Тестовое 2 для админа', 4, 4),
(202, 4, 'Добрый день простым пользователям', 0, NULL),
(203, 4, 'Добрый день простым пользователям', 0, NULL),
(204, 2, 'Тестовое 2 для админа', 4, 1),
(205, 2, 'Тестовое 2 для админа', 4, 3),
(206, 5, 'Как погода Админ?', 4, 3),
(207, 4, 'Здарова ', NULL, 1),
(208, 4, 'фыв ', NULL, 1),
(209, 4, 'asdasd ', 1, NULL),
(210, 4, 'на удаление ', 4, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `SoundSetting`
--

CREATE TABLE `SoundSetting` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `SoundDisable` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `SoundSetting`
--

INSERT INTO `SoundSetting` (`id`, `user_id`, `sender_id`, `SoundDisable`) VALUES
(3, 4, 1, 1),
(4, 4, 5, 0),
(5, 4, 2, 0),
(6, 4, 4, 0),
(7, 4, 1, 0),
(8, 4, 1, 1),
(9, 4, 1, 0),
(10, 4, 1, 1),
(11, 4, 1, 0),
(12, 4, 1, 0),
(13, 4, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'defolt.jpg',
  `friends_id` json DEFAULT NULL,
  `nicknameIsHidden` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `nickname`, `password`, `img`, `friends_id`, `nicknameIsHidden`) VALUES
(1, 'Marish@mail.ru', 'Маришка', '21', 'female2.jpg', '{\"1\": \"1\", \"2\": \"2\"}', 1),
(2, 'Jimka@mail.ru', 'Джимка', '21', 'defolt.jpg', 'null', 0),
(4, 'admin@mail.ru', 'Маришка Рейнер', '25', 'defolt.jpg  ', '{\"1\": \"1\", \"2\": \"2\", \"4\": \"4\", \"5\": \"5\"}', 0),
(5, 'Alice@mail.ru', 'Алиса', '21', 'female1.jpg', 'null', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `SoundSetting`
--
ALTER TABLE `SoundSetting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT для таблицы `SoundSetting`
--
ALTER TABLE `SoundSetting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `SoundSetting`
--
ALTER TABLE `SoundSetting`
  ADD CONSTRAINT `soundsetting_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `soundsetting_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
