-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Дек 28 2024 г., 21:03
-- Версия сервера: 11.6.2-MariaDB-ubu2404
-- Версия PHP: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `plext`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dictionary_colors`
--

DROP TABLE IF EXISTS `dictionary_colors`;
CREATE TABLE `dictionary_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ulid` char(26) NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `alt_value` varchar(255) DEFAULT NULL,
  `package` varchar(255) NOT NULL,
  `sort` double NOT NULL DEFAULT 65535,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dictionary_colors`
--

INSERT INTO `dictionary_colors` (`id`, `ulid`, `label`, `value`, `alt_value`, `package`, `sort`, `created_at`, `updated_at`) VALUES
(2, '01haajpv74cf78vk7wghknzcqd', '', '#2E86DF', NULL, 'notes', 500, NULL, NULL),
(4, '01haajpv7czdz1kahr381xhqqm', '', '#10AC84', NULL, 'notes', 500, NULL, NULL),
(5, '01haajpv7f62dt6twbbjd5djy1', '', '#FF851B', NULL, 'notes', 500, NULL, NULL),
(8, '01haajpv7wkshzc190vpbjaefs', '', '#ED5353', NULL, 'notes', 500, NULL, NULL),
(10, '01haajpv82mrv963m7mb479s37', '', '#F367E2', NULL, 'notes', 500, NULL, NULL),
(11, '01haajpv86tx06kza9832n3qnz', '', '#AF3848', NULL, 'avatars', 500, NULL, NULL),
(12, '01haajpv89p1q9fgr5mhxgbafp', '', '#F06634', NULL, 'avatars', 500, NULL, NULL),
(13, '01haajpv8jcx348pprjbhqc8ac', '', '#F15C3C', NULL, 'avatars', 500, NULL, NULL),
(14, '01haajpv8nqw6zfn434sr2y8wf', '', '#FF7853', NULL, 'avatars', 500, NULL, NULL),
(16, '01haajpv8s4kfcaxszbxbrg6zp', '', '#FB8C00', NULL, 'avatars', 500, NULL, NULL),
(18, '01haajpv8wrnq3jy8a8d7j23v4', '', '#AABB10', NULL, 'avatars', 500, NULL, NULL),
(19, '01haajpv8z1g2b195abha8ses2', '', '#D0DA22', NULL, 'avatars', 500, NULL, NULL),
(20, '01haajpv92gzc7bh1d20mwbfzp', '', '#36AE96', NULL, 'avatars', 500, NULL, NULL),
(21, '01haajpv95m1jfepdqhhc0p38z', '', '#7CD4AF', NULL, 'avatars', 500, NULL, NULL),
(22, '01haajpv99qaqxjgn2h80c96e3', '', '#2F7398', NULL, 'avatars', 500, NULL, NULL),
(23, '01haajpv9eqpd9qbays1bt4bhy', '', '#2796C9', NULL, 'avatars', 500, NULL, NULL),
(24, '01haajpv9h011zse8k6hsrqtd3', '', '#519CF3', NULL, 'avatars', 500, NULL, NULL),
(25, '01haajpv9mgsqfj4hds5j1e6x7', '', '#6EC3CF', NULL, 'avatars', 500, NULL, NULL),
(26, '01haajpv9qa4zrqhxesjbs7pf6', '', '#C257D8', NULL, 'avatars', 500, NULL, NULL),
(27, '01haajpv9tawgdb3yjvwzy6f2e', '', '#6C72D4', NULL, 'avatars', 500, NULL, NULL),
(28, '01haajpv9xdppb84eg1dk06d8c', '', '#3CB0C0', NULL, 'avatars', 500, NULL, NULL),
(29, '01haajpva1rabtf9v27dq4vjej', '', '#748498', NULL, 'avatars', 500, NULL, NULL),
(30, '01haajpva4b2p7aah787ne5nz4', '', '#8C8692', NULL, 'avatars', 500, NULL, NULL),
(31, '01haajpva7apwt9m332g5t4vnh', '', '#BFB3A1', NULL, 'avatars', 500, NULL, NULL),
(32, '01haajpvadysahfhm82vmdtzt6', '', '#CC7D24', 'brown', 'appearance', 500, NULL, NULL),
(33, '01haajpvag711hybpkk3j3cvj0', '', '#8D9614', 'olive', 'appearance', 500, NULL, NULL),
(34, '01haajpvakbmgjjptfekxkece7', '', '#24A451', 'forest-green', 'appearance', 500, NULL, NULL),
(35, '01haajpvap1d9jvcemcwn17tyy', '', '#00A99B', 'dark-cyan', 'appearance', 500, NULL, NULL),
(36, '01haajpvatw11qwtez3geahtxk', '', '#00A6DF', 'royal-blue', 'appearance', 500, NULL, NULL),
(37, '01haajpvazmrygt18qtpp7g3qg', '', '#009EF7', 'clear-sky', 'appearance', 500, NULL, NULL),
(38, '01haajpvb2xj2t4387vj8rd1jj', '', '#A27BE7', 'dark-violet', 'appearance', 500, NULL, NULL),
(39, '01haajpvb5n952218rjtfc1n9y', '', '#E65DA9', 'deep-pink', 'appearance', 500, NULL, NULL),
(40, '01haajpvb8gngd27ydgfv4wqv6', '', '#EF6061', 'сoral', 'appearance', 500, NULL, NULL),
(41, '01jg7fz4j2wf75qz5hxjtjtgwp', '', '#FFE066', '', 'highlight', 500, NULL, NULL),
(42, '01jg7fz4j4mbfq8a7cn9ta64x3', '', '#77FF92', '', 'highlight', 500, NULL, NULL),
(43, '01jg7fz4j5fgx8w902pwr14q49', '', '#77C9FF', '', 'highlight', 500, NULL, NULL),
(44, '01jg7fz4j6rtnc18nefmqj9qw7', '', '#FF77E4', '', 'highlight', 500, NULL, NULL),
(45, '01jg7fz4j76ptfcmcf3y2jtqnk', '', '#FF7792', '', 'highlight', 500, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dictionary_colors`
--
ALTER TABLE `dictionary_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dictionary_colors_package_index` (`package`),
  ADD KEY `dictionary_colors_ulid_index` (`ulid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dictionary_colors`
--
ALTER TABLE `dictionary_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;