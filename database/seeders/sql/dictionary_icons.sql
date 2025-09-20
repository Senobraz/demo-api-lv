-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Фев 21 2024 г., 17:46
-- Версия сервера: 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
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
-- Структура таблицы `dictionary_icons`
--

CREATE TABLE IF NOT EXISTS `dictionary_icons` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ulid` char(26) NOT NULL,
  `label` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `alt_value` varchar(255) DEFAULT NULL,
  `package` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 500,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dictionary_icons_package_index` (`package`),
  KEY `dictionary_icons_ulid_index` (`ulid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dictionary_icons`
--

INSERT INTO `dictionary_icons` (`id`, `ulid`, `label`, `value`, `alt_value`, `package`, `sort`, `created_at`, `updated_at`) VALUES
(2, '01haajpvdksasn4k2vkrpv4m5v', '', 'fluent-emoji-high-contrast:bat', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(3, '01haajpvdpe03xbybzxtv5cvkg', '', 'fluent-emoji-high-contrast:bear', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(4, '01haajpvdrkk6zra7y7n8ardkc', '', 'fluent-emoji-high-contrast:beaver', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(5, '01haajpvdvanvfdk01htj9fzbf', '', 'fluent-emoji-high-contrast:bird', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(6, '01haajpvdyhgva1yzvr9nzdxke', '', 'fluent-emoji-high-contrast:black-cat', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(7, '01haajpve4q1qvxnsm8ejbcv19', '', 'fluent-emoji-high-contrast:blossom', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(8, '01haajpve7jpwr3a0c7xa1ymw2', '', 'fluent-emoji-high-contrast:blowfish', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(9, '01haajpveakkzzrydxef6897ck', '', 'fluent-emoji-high-contrast:butterfly', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(10, '01haajpved6wvv72j6whrdekn2', '', 'fluent-emoji-high-contrast:cat-face', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(11, '01haajpvejx43k5a5pg0yn64d9', '', 'fluent-emoji-high-contrast:cherry-blossom', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(12, '01haajpveny8wkppn5be87kdr3', '', 'fluent-emoji-high-contrast:chipmunk', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(13, '01haajpveryvspyqjk5bzm5dd0', '', 'fluent-emoji-high-contrast:deciduous-tree', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(14, '01haajpvevfze6te2e4zyp89n8', '', 'fluent-emoji-high-contrast:dog-face', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(15, '01haajpveymza6zfn2nmwzfhd6', '', 'fluent-emoji-high-contrast:dolphin', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(16, '01haajpvf2evjpze39jnfjzpta', '', 'fluent-emoji-high-contrast:dove', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(17, '01haajpvf7b85s92br7y0xvhm0', '', 'fluent-emoji-high-contrast:dragon', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(19, '01haajpvfdsba1rwv0zd4f7c72', '', 'fluent-emoji-high-contrast:rabbit-face', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:25'),
(20, '01haajpvfgayrgq0eyvgd8hvgv', '', 'fluent-emoji-high-contrast:raccoon', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:26'),
(21, '01haajpvfmhzzwxq1dw46ct7gx', '', 'fluent-emoji-high-contrast:face-with-steam-from-nose', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:26'),
(22, '01haajpvfqcbjwyhe9t7z92a5c', '', 'fluent-emoji-high-contrast:face-with-open-mouth', NULL, 'avatar', 500, NULL, '2023-09-14 22:29:26'),
(28, '01hkf0hmk6vccpc4qh189qpcbn', '', 'mingcute:bug-line', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(29, '01hkf0hmke67j14c2xgz7h3han', '', 'mingcute:check-fill', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(30, '01hkf0hmkg5k6dt8s7hk5v249g', '', 'mingcute:bookmark-line', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(31, '01hkf0hmkh7wffpf56hf2wtkb1', '', 'fluent-emoji-high-contrast:magic-wand', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(32, '01hkf0hmkj8t0mbgvy8qdeewnn', '', 'mingcute:alert-diamond-line', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(33, '01hkf0hmkkcffc206evpwx0b1x', '', 'mingcute:bulb-line', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(34, '01hkf0hmkmccv9m99fmc4k618t', '', 'humbleicons:exclamation', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(35, '01hkf0hmkn12wj65dfh08m9wb3', '', 'fluent-emoji-high-contrast:high-voltage', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(36, '01hkf0hmkn12wj65dfh08m9wb4', '', 'fluent-emoji-high-contrast:heart-suit', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(37, '01hkf0hmkpqp7h7ne3gh18jreg', '', 'fluent-emoji-high-contrast:jack-o-lantern', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(38, '01hkf0hmkqce7s644v6ewzr0gt', '', 'fluent-emoji-high-contrast:sparkles', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(39, '01hkf0hmkrhxtpnpz0k4b9v52f', '', 'fluent-emoji-high-contrast:prohibited', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(40, '01hkf0hmksz8s6pz36fd3e1s5j', '', 'fluent-emoji-high-contrast:red-question-mark', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(41, '01hkf0hmksz8s6pz36fd3e1s5k', '', 'fluent-emoji-high-contrast:party-popper', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(42, '01hkf0hmkt49rgejxz5hav39jv', '', 'fluent-emoji-high-contrast:heavy-dollar-sign', NULL, 'section', 500, NULL, '2024-01-06 09:09:29'),
(43, '01hkfb9jqak3j44539seyj4jj8', '', 'fluent-emoji-high-contrast:dizzy', NULL, 'avatar', 500, NULL, '2024-01-06 12:17:19'),
(44, '01hkfb9jqchg71zz1msxe2mcr0', '', 'fluent-emoji-high-contrast:grinning-face-with-big-eyes', NULL, 'avatar', 500, NULL, '2024-01-06 12:17:19'),
(45, '01hkfb9jqd53yz27dtyyjsbjdx', '', 'fluent-emoji-high-contrast:growing-heart', NULL, 'avatar', 500, NULL, '2024-01-06 12:17:19'),
(46, '01hkfb9jqfdb671vwb3qjhrnp6', '', 'fluent-emoji-high-contrast:ghost', NULL, 'avatar', 500, NULL, '2024-01-06 12:17:19'),
(47, '01hkfb9jqgmtk00z161bg3yqhb', '', 'fluent-emoji-high-contrast:smiling-face-with-smiling-eyes', NULL, 'avatar', 500, NULL, '2024-01-06 12:17:19'),
(48, '01hkfb9jqh4h3kf9qrwtkek6q3', '', 'fluent-emoji-high-contrast:thinking-face', NULL, 'avatar', 500, NULL, '2024-01-06 12:17:19'),
(49, '01hkfc6jf014abv3g2cydykgze', '', 'fluent-emoji-high-contrast:cowboy-hat-face', NULL, 'avatar', 500, NULL, '2024-01-06 12:33:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
