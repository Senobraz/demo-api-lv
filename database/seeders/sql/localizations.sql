-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Дек 28 2024 г., 21:05
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
-- Структура таблицы `localizations`
--

DROP TABLE IF EXISTS `localizations`;
CREATE TABLE `localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `package` varchar(255) NOT NULL,
  `ru` text DEFAULT NULL,
  `en` text DEFAULT NULL,
  `sort` double NOT NULL DEFAULT 65535,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `localizations`
--

INSERT INTO `localizations` (`id`, `code`, `package`, `ru`, `en`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'username', 'general', 'Имя', 'Username', 500, NULL, NULL),
(2, 'language', 'general', 'Язык', 'Language', 500, NULL, NULL),
(3, 'timezone', 'account', 'Часовой пояс', 'Time Zone', 500, NULL, NULL),
(6, 'save', 'general', 'Сохранить', 'Save', 500, NULL, NULL),
(7, 'save_changes', 'general', 'Сохранить изменения', 'Save Changes', 500, NULL, NULL),
(8, 'update', 'general', 'Изменить', 'Update', 500, NULL, NULL),
(9, 'cancel', 'general', 'Отмена', 'Cancel', 500, NULL, NULL),
(10, 'delete', 'general', 'Удалить', 'Delete', 500, NULL, NULL),
(13, 'email', 'general', 'E-mail', 'E-mail', 500, NULL, NULL),
(14, 'email_2', 'general', 'Электронная почта', 'Email Address', 500, NULL, NULL),
(15, 'password', 'general', 'Пароль', 'Password', 500, NULL, NULL),
(17, 'show', 'general', 'Показать', 'Show', 500, NULL, NULL),
(18, 'hide', 'general', 'Скрыть', 'Hide', 500, NULL, NULL),
(19, 'email_incorrect', 'validate', 'Неправильный адрес электронной почты', 'Wrong email address', 510, NULL, NULL),
(20, 'email_required', 'validate', 'Введите адрес электронной почты', 'Enter your email address', 510, NULL, NULL),
(21, 'password_required', 'validate', 'Введите пароль', 'Enter a password', 510, NULL, NULL),
(22, 'password_confirm', 'general', 'Подтвердите пароль', 'Confirm Password', 500, NULL, NULL),
(23, 'password_current', 'general', 'Текущий пароль', 'Current password', 500, NULL, NULL),
(24, 'password_confirmation_match', 'validate', 'Пароль не совпадает', 'Password doesn\'t match', 510, NULL, NULL),
(25, 'password_new', 'general', 'Новый пароль', 'New password', 500, NULL, NULL),
(26, 'password_new_confirm', 'general', 'Подтвердите новый пароль', 'Confirm New Password', 500, NULL, NULL),
(27, 'password_new_required', 'validate', 'Введите новый пароль', 'Enter a new password', 510, NULL, NULL),
(28, 'password_new_confirmation_required', 'validate', 'Введите подтверждение нового пароля', 'Enter new password confirmation', 510, NULL, NULL),
(29, 'password_current_required', 'validate', 'Введите текущий пароль', 'Enter the current password', 510, NULL, NULL),
(31, 'title_edit_password', 'account', 'Изменить пароль', 'Change password', 500, NULL, NULL),
(32, 'password_contain_required', 'validate', 'Пароль должен содержать не менее {count} символов', 'The password must be at least {count} characters', 510, NULL, NULL),
(33, 'my_account', 'menu', 'Мой аккаунт', 'My Account', 530, NULL, NULL),
(34, 'exit_to_app', 'menu', 'Выйти', 'Log out', 530, NULL, NULL),
(35, 'open_head_account_menu', 'hint', 'Открыть меню ', 'Open menu', 500, NULL, NULL),
(36, 'open_head_notifications', 'hint', 'Открыть уведомления', 'Open notifications', 500, NULL, NULL),
(38, 'edit_avatar', 'account', 'Изменить аватар', 'Change avatar', 500, NULL, NULL),
(39, 'delete_avatar', 'account', 'Удалить', 'Delete', 500, NULL, NULL),
(40, 'title_avatar_edit', 'account', 'Изменить аватар профиля', 'Change your profile photo', 500, NULL, NULL),
(42, 'username_required', 'validate', 'Введите имя', 'Enter your name', 510, NULL, NULL),
(43, 'avatar_color', 'account', 'Цвет', 'Color', 500, NULL, NULL),
(44, 'finish', 'general', 'Готово', 'Finish', 500, NULL, NULL),
(45, 'default', 'general', 'По умолчанию', 'Default', 500, NULL, NULL),
(46, 'clear_icon', 'general', 'Убрать значок', 'Clear icon', 500, NULL, NULL),
(47, 'avatar_icon', 'account', 'Иконка', 'Icon', 500, NULL, NULL),
(48, 'http_400_title', 'error', 'Ошибка клиента', 'Client Error', 490, NULL, NULL),
(49, 'http_400_message', 'error', 'Неправильный, некорректный запрос', 'Wrong, invalid request', 490, NULL, NULL),
(50, 'http_401_message', 'error', 'Не авторизован ', 'Not authorized', 490, NULL, NULL),
(51, 'http_403_message', 'error', 'Доступ к запрещен или ограничен', 'Access denied or restricted', 490, NULL, NULL),
(52, 'http_404_message', 'error', 'К сожалению, запрашиваемая страница не найдена', 'Unfortunately, the requested page was not found', 490, NULL, NULL),
(53, 'http_500_title', 'error', 'Ошибка сервера', 'Server error', 490, NULL, NULL),
(54, 'http_500_message', 'error', 'Мы зарегистрировали ошибку и приступим к ее исправлению. Повторите попытку позже. Спасибо за понимание.', 'We have logged the error and will start working on fixing it, please try again later, thanks for your understanding', 490, NULL, NULL),
(55, 'http_419_message', 'error', 'Токен авторизации устарел или оказался некорректным, попробуйте выйти и выполнить авторизацию', 'We have logged the error and will start working on fixing it, please try again later, thanks for your understanding', 490, NULL, NULL),
(57, 'back', 'general', 'Назад', 'Go Back', 500, NULL, NULL),
(58, 'menu_account', 'account', 'Мой профиль', 'My profile', 530, NULL, NULL),
(59, 'menu_appearance', 'account', 'Внешний вид', 'Appearance', 530, NULL, NULL),
(60, 'menu_subscription', 'account', 'Подписки', 'Subscriptions', 530, NULL, NULL),
(61, 'menu_notifications', 'account', 'Уведомления', 'Notifications', 530, NULL, NULL),
(62, 'title_setting_account', 'account', 'Мой профиль', 'My profile', 540, NULL, NULL),
(63, 'title_setting_appearance', 'account', 'Внешний вид', 'Appearance', 540, NULL, NULL),
(64, 'title_setting_notifications', 'account', 'Уведомления', 'Notifications', 540, NULL, NULL),
(65, 'title_setting_subscription', 'account', 'Подписки', 'Subscriptions', 540, NULL, NULL),
(66, 'workspace_name', 'notes', 'All Notes', 'All Notes', 500, NULL, NULL),
(67, 'create_category', 'notes', 'Создать категорию', 'Create category', 500, NULL, NULL),
(68, 'settings', 'notes', 'Настройки', 'Settings', 530, NULL, NULL),
(69, 'create_section', 'notes', 'Создать коллекцию', 'Create collection', 500, NULL, NULL),
(70, 'title_all_notes', 'notes', 'Все заметки', 'Home', 530, NULL, NULL),
(71, 'type_title', 'general', 'Введите заголовок', 'Enter the title', 500, NULL, NULL),
(72, 'type_text', 'general', 'Введите текст', 'Enter the text', 500, NULL, NULL),
(73, 'tag', 'notes', 'Ярлык', 'Tag', 500, NULL, NULL),
(74, 'tags', 'notes', 'Ярлыки', 'Tags', 500, NULL, NULL),
(75, 'color', 'notes', 'Цвет', 'Color', 500, NULL, NULL),
(77, 'open_in_dialog', 'notes', 'Открыть в диалоговом окне', 'Open in dialog', 500, NULL, NULL),
(78, 'hint_create_note_1', 'notes', 'Создайте заметку здесь или в диалоговом окне, нажав', 'Create a note here, or in the dialog box by pressing N', 500, NULL, NULL),
(79, 'hint_create_note_2', 'notes', 'а затем', 'and then', 500, NULL, NULL),
(80, 'search', 'general', 'Поиск', 'Search', 500, NULL, NULL),
(81, 'create', 'general', 'Создать', 'Create', 500, NULL, NULL),
(82, 'new', 'general', 'Новый', 'New', 500, NULL, NULL),
(83, 'calendar', 'general', 'Календарь', 'Calendar', 500, NULL, NULL),
(84, 'sections', 'general', 'Разделы', 'Sections', 500, NULL, NULL),
(85, 'calendar_open', 'calendar', 'Открыть календарь', 'Open calendar', 500, NULL, NULL),
(86, 'calendar_close', 'calendar', 'Закрыть календарь', 'Close calendar', 500, NULL, NULL),
(87, 'calendar_today', 'calendar', 'Сегодня', 'Today', 500, NULL, NULL),
(88, 'clear', 'calendar', 'Очистить', 'Clear', 500, NULL, NULL),
(89, 'calendar_prev_month', 'calendar', 'Предыдущий месяц', 'Previous month', 500, NULL, NULL),
(90, 'calendar_next_month', 'calendar', 'Следующий месяц', 'Next month', 500, NULL, NULL),
(93, 'categories', 'general', 'Категории', 'Categories', 500, NULL, NULL),
(94, 'section_settings', 'notes', 'Настройки коллекции', 'Collection Settings', 500, NULL, NULL),
(96, 'empty_sections_text', 'notes', 'Здесь могут быть коллекции', 'There may be collections here', 500, NULL, NULL),
(98, 'hint_click_for_create_note', 'notes', 'Нажмите, чтобы создать новую заметку', 'Click to create a new note', 500, NULL, NULL),
(99, 'select_section', 'notes', 'Выберите коллекцию', 'Select collection', 500, NULL, NULL),
(100, 'hint_select_section_for_note', 'notes', 'Создайте или измените коллекцию', 'Create or edit a collection', 500, NULL, NULL),
(101, 'section', 'general', 'Раздел', 'Section', 500, NULL, NULL),
(102, 'images', 'general', 'Картинки', 'Images', 500, NULL, NULL),
(103, 'add_picture', 'notes', 'Добавить картинку', 'Add picture', 500, NULL, NULL),
(104, 'hint_select_picture_for_note', 'notes', 'Добавьте картинки в заметку', 'Add pictures to a note', 500, NULL, NULL),
(105, 'hint_select_color', 'notes', 'Измените цвет', 'Change note color', 500, NULL, NULL),
(106, 'select_color', 'notes', 'Выберите цвет', 'Choose a color', 500, NULL, NULL),
(107, 'hint_select_tags_for_note', 'notes', 'Добавьте ярлыки для упрощенного поиска по заметкам', 'Add tags for easy note search', 500, NULL, NULL),
(108, 'add_tags', 'notes', 'Добавить ярлыки', 'Add Tags', 500, NULL, NULL),
(109, 'open_help_center', 'hint', 'Открыть справочный центр', 'Open help center', 500, NULL, NULL),
(110, 'open_calendar', 'notes', 'Открыть календарь', 'Open calendar', 520, NULL, NULL),
(111, 'open_search', 'notes', 'Открыть поиск', 'Open search', 520, NULL, NULL),
(112, 'title_settings', 'account', 'Настройки', 'Settings', 540, NULL, NULL),
(113, 'menu_general', 'account', 'Основные', 'General', 530, NULL, NULL),
(114, 'title_setting_general', 'account', 'Основные настройки', 'Basic Settings', 540, NULL, NULL),
(116, 'menu_upgrade', 'account', 'Обновить', 'Upgrade', 530, NULL, NULL),
(117, 'username', 'account', 'Имя', 'Name', 500, NULL, NULL),
(118, 'email', 'account', 'Электронная почта', 'E-mail', 500, NULL, NULL),
(119, 'password', 'account', 'Пароль', 'Password', 500, NULL, NULL),
(120, 'language', 'account', 'Язык', 'Language', 500, NULL, NULL),
(121, 'date_and_time', 'account', 'Дата и время', 'Date and Time', 500, NULL, NULL),
(123, 'success_title', 'alert', 'Успешно', 'Successfully', 500, NULL, NULL),
(128, 'email_confirm', 'general', 'Подтвердить Email', 'Confirm Email', 500, NULL, NULL),
(129, 'email_verified', 'general', 'Подтвержден', 'Confirmed', 500, NULL, NULL),
(130, 'date_format', 'account', 'Формат даты', 'Date Format', 500, NULL, NULL),
(131, 'time_format', 'account', 'Формат времени', 'Time Format', 500, NULL, NULL),
(132, 'week_start', 'account', 'Начало недели', 'Week Start', 500, NULL, NULL),
(133, 'appearance_mode', 'account', 'Тема', 'Theme mode', 500, NULL, NULL),
(134, 'appearance_primary_color', 'account', 'Основной цвет', 'Primary color', 500, NULL, NULL),
(135, 'workspace_private', 'notes', 'Личные заметки', 'Personal notes', 500, NULL, NULL),
(136, 'workspace_public', 'notes', 'Публичные заметки', 'Public notes', 500, NULL, NULL),
(137, 'settings', 'general', 'Настройки', 'Settings', 500, NULL, NULL),
(138, 'section_name', 'notes', 'Название коллекции', 'Сollection Name', 500, NULL, NULL),
(139, 'category', 'notes', 'Категория', 'Сategory', 500, NULL, NULL),
(140, 'section_required', 'notes-validate', 'Введите название коллекции', 'Enter the name of the collection', 500, NULL, NULL),
(141, 'hint_select_category', 'notes', 'Создайте или измените коллекцию заметки', 'Create or edit a collection of notes', 500, NULL, NULL),
(142, 'icon', 'general', 'Иконка', 'Icon', 500, NULL, NULL),
(143, 'hint_empty_category_for_select', 'notes', 'У вас пока нет категорий, введите название новой категории', 'You don\'t have any categories yet, enter the name of the new category', 500, NULL, NULL),
(144, 'select_placeholder', 'general', 'Выбрать', 'Select', 500, NULL, NULL),
(145, 'select_loading', 'general', 'Загрузка...', 'Loading...', 500, NULL, NULL),
(146, 'select_no_match', 'general', 'Нет совпадающих данных', 'No matching data', 500, NULL, NULL),
(147, 'select_no_data', 'general', 'Нет данных', 'No data', 500, NULL, NULL),
(148, 'hint_category_for_select', 'notes', 'Выберите категорию или введите название новой категории', 'Select a category or enter the name of a new category', 500, NULL, NULL),
(149, 'empty', 'general', 'Пусто', 'Empty', 500, NULL, NULL),
(150, 'empty_all_sections_text', 'notes', 'Здесь могут быть категории и коллекции', 'There can be categories and collections here', 500, NULL, NULL),
(151, 'category_name', 'notes', 'Название категории', 'Category name', 500, NULL, NULL),
(152, 'category_required', 'notes-validate', 'Введите название категории', 'Enter category name', 500, NULL, NULL),
(153, 'all_notes', 'notes-menu', 'Все заметки', 'Home', 530, NULL, NULL),
(154, 'create_category', 'notes-menu', 'Новая категория', 'New category', 500, NULL, NULL),
(155, 'create_section', 'notes-menu', 'Новая коллекция', 'New collection', 500, NULL, NULL),
(157, 'settings', 'notes-menu', 'Настройки', 'Settings', 500, NULL, NULL),
(158, 'shared_notes', 'notes-menu', 'Совместные', 'Shared', 500, NULL, NULL),
(159, 'menu_settings', 'account', 'Настройки', 'Settings', 530, NULL, NULL),
(160, 'title_shared_notes', 'notes', 'Совместные заметки', 'Shared notes', 500, NULL, NULL),
(161, 'delete_section', 'notes', 'Удалить коллекцию', 'Delete collection', 500, NULL, NULL),
(162, 'section_general', 'notes-menu', 'Основные', 'General', 500, NULL, NULL),
(163, 'title_section_overview', 'notes', 'Основные настройки', 'Basic Settings', 500, NULL, NULL),
(164, 'section_description', 'notes', 'Описание коллекции', 'Description of the collection', 500, NULL, NULL),
(165, 'ok', 'general', 'Хорошо', 'Ok', 500, NULL, NULL),
(166, 'alert_delete_section', 'notes', 'Вы уверены что хотите удалить коллекцию {NAME} ?', 'Are you sure you want to delete the {NAME} collection?', 500, NULL, NULL),
(167, 'more', 'general', 'Еще', 'More', 500, NULL, NULL),
(168, 'update_category', 'notes-menu', 'Изменить категорию', 'Update category', 500, NULL, NULL),
(169, 'update_category', 'notes', 'Изменить категорию', 'Update category', 500, NULL, NULL),
(170, 'alert_delete_category', 'notes', 'Вы уверены что хотите удалить категорию {NAME} ?', 'Are you sure you want to delete the {NAME} category?', 500, NULL, NULL),
(171, 'delete_category', 'notes', 'Удалить категорию', 'Delete category', 500, NULL, NULL),
(172, 'hint_select_color_for_note', 'notes', 'Измените цвет карточки', 'Change the color of the card', 500, NULL, NULL),
(173, 'notice_note_moved_to_section', 'notes', 'Заметка перемещена в коллекцию {NAME}', 'The note has been moved to the {NAME} collection', 500, NULL, NULL),
(174, 'notice_note_created_to_section', 'notes', 'Заметка была создана в коллекции {NAME}', 'The note was created in the {NAME} collection', 500, NULL, NULL),
(175, 'share', 'general', 'Поделиться', 'Share', 500, NULL, NULL),
(176, 'like', 'general', 'Нравится', 'Like', 500, NULL, NULL),
(177, 'comment', 'general', 'Комментарий', 'Comment', 500, NULL, NULL),
(178, 'type_text_2', 'general', 'Начните писать текст', 'Start writing text', 500, NULL, NULL),
(179, 'type_text', 'editor', 'Напишите что-нибудь...', 'Write something ...', 500, NULL, NULL),
(180, 'tool_code', 'editor', 'Код', 'Code', 500, NULL, NULL),
(181, 'tool_checklist', 'editor', 'Контрольный список', 'Checklist', 500, NULL, NULL),
(182, 'tool_ordered_list', 'editor', 'Нумерованный список', 'Ordered List', 500, NULL, NULL),
(183, 'tool_bullet_list', 'editor', 'Маркированный список', 'Bullet List', 500, NULL, NULL),
(184, 'tool_heading', 'editor', 'Заголовок', 'Heading', 500, NULL, NULL),
(185, 'type_heading', 'editor', 'Введите заголовок', 'Type heading', 500, NULL, NULL),
(186, 'empty_section_notes', 'notes', 'Здесь могут быть ваши заметки', 'Your notes may be here', 500, NULL, NULL),
(187, 'close', 'general', 'Закрыть', 'Close', 500, NULL, NULL),
(188, 'did_not_save_changes', 'alert', 'Вы не сохранили изменения!', 'You didn\'t save the changes!', 500, NULL, NULL),
(189, 'open_in_dialog', 'hint', 'Открыть в диалоговом окне', 'Open in a dialog box', 500, NULL, NULL),
(190, 'changed_last_ago', 'notes', 'Изменено {TEXT}', 'Changed {TEXT}', 500, NULL, NULL),
(191, 'http_413_message', 'error', 'Содержимое слишком велико', 'The content is too large', 500, NULL, NULL),
(192, 'http_request_message', 'error', 'Не получилось отправить запрос, возможно что содержимое слишком велико', 'The request could not be sent, it is possible that the content is too large', 500, NULL, NULL),
(193, 'http_request_title', 'error', 'Ошибка запроса', 'Request error', 500, NULL, NULL),
(194, 'tool_heading_1', 'editor', 'Заголовок 1', 'Heading 1', 500, NULL, NULL),
(195, 'tool_heading_2', 'editor', 'Заголовок 2', 'Heading 2', 500, NULL, NULL),
(197, 'tool_text', 'editor', 'Текст', 'Text', 500, NULL, NULL),
(198, 'tool_code_block', 'editor', 'Блок кода', 'Code Block', 500, NULL, NULL),
(199, 'tool_bold', 'editor', 'Жирный', 'Bold', 500, NULL, NULL),
(200, 'tool_italic', 'editor', 'Курсивный', 'Italic', 500, NULL, NULL),
(201, 'tool_strike', 'editor', 'Зачеркнутый', 'Strike', 500, NULL, NULL),
(202, 'tool_align_left', 'editor', 'Выравнивание по левому краю', 'Left alignment', 500, NULL, NULL),
(203, 'tool_align_center', 'editor', 'Выравнивание по центру', 'Center alignment', 500, NULL, NULL),
(204, 'tool_align_right', 'editor', 'Выравнивание по правому краю', 'Right alignment', 500, NULL, NULL),
(205, 'tool_align_justify', 'editor', 'Выравнивание по ширине', 'Justify alignment', 500, NULL, NULL),
(206, 'tool_highlight', 'editor', 'Выделить текст', 'Text highlighting', 500, NULL, NULL),
(207, 'tool_convert_to', 'editor', 'Преобразовать', 'Сonvert to', 500, NULL, NULL),
(208, 'saved', 'general', 'Сохранено', 'Saved', 500, NULL, NULL),
(209, 'delete_note', 'notes', 'Удалить заметку', 'Delete note', 500, NULL, NULL),
(210, 'hint_create_note', 'notes', 'Новая заметка ...', 'New note ...', 500, NULL, NULL),
(211, 'create_in_dialog', 'notes', 'Создать в диалоговом окне', 'Create in dialog', 500, NULL, NULL),
(212, 'email_verification', 'general', 'Письмо отправлено', 'The email has been sent', 500, NULL, NULL),
(213, 'sent_email_verification', 'alert', 'Вам отправлено письмо с ссылкой для подтверждения электронной почты!', 'An email has been sent to you with a link to confirm your email!', 500, NULL, NULL),
(214, 'sent_email_title', 'alert', 'Проверьте свою электронную почту', 'Check your email', 500, NULL, NULL),
(215, 'empty_sections_in_picker', 'notes', 'Здесь могут быть коллекции.\nВведите название коллекции в поиске чтобы создать его', 'There may be collections here.\nEnter the name of the collection in the search to create it', 500, NULL, NULL),
(216, 'tool_align', 'editor', 'Выравнивание', 'Alignment', 500, NULL, NULL),
(217, 'tool_code_inline', 'editor', 'Строка кода', 'Inline Code', 500, NULL, NULL),
(218, 'tool_heading_3', 'editor', 'Заголовок 3', 'Heading 3', 500, NULL, NULL),
(219, 'tool_blockquote', 'editor', 'Цитата', 'Blockquote', 500, NULL, NULL),
(220, 'tool_link', 'editor', 'Ссылка', 'Link', 500, NULL, NULL),
(221, 'tool_сlear_format', 'editor', 'Очистить форматирование', 'Clear formatting', 500, NULL, NULL),
(222, 'hint_add_link', 'editor', 'Вставьте ссылку', 'Paste the link', 500, NULL, NULL),
(223, 'uri_incorrect', 'validate', 'Неправильный URL-адрес', 'Invalid URL', 510, NULL, NULL),
(224, 'copied_to_clipboard', 'alert', 'Скопировано в буфер обмена!', 'Copied to clipboard!', 500, NULL, NULL),
(225, 'created_last_ago', 'notes', 'Создано {TEXT}', 'Created {TEXT}', 500, NULL, NULL),
(227, 'report_page', 'collaborative', 'Пожаловаться', 'Report a page', 500, NULL, NULL),
(228, 'hint_available_after_saving', 'notes', 'Доступно после сохранения', 'Available after saving', 500, NULL, NULL),
(229, 'title_share_note_access', 'notes', 'Доступ к заметке', 'Access to the note', 530, NULL, NULL),
(230, 'share_note_public_title', 'notes', 'Все, у кого есть ссылка', 'Everyone who has a link', 530, NULL, NULL),
(231, 'share_note_public_subtext', 'notes', 'Просматривать могут все в интернете, у кого есть эта ссылка.', 'Anyone on the Internet who has this link can view it.', 530, NULL, NULL),
(232, 'copy', 'general', 'Копировать', 'Copy', 500, NULL, NULL),
(233, 'copy_link', 'general', 'Копировать ссылку', 'Copy link', 500, NULL, NULL),
(234, 'changed_last_ago', 'collaborative', 'Изменено {TEXT}', 'Changed {TEXT}', 500, NULL, NULL),
(235, 'created_last_ago', 'collaborative', 'Создано {TEXT}', 'Created {TEXT}', 500, NULL, NULL),
(236, 'published_last_ago', 'collaborative', 'Опубликовано {TEXT}', 'Published {TEXT}', 500, NULL, NULL),
(237, 'title_complaint_reporting', 'collaborative', 'Причина подачи жалобы', 'The reason for the complaint', 500, NULL, NULL),
(238, 'complaint_spam', 'collaborative', 'Фишинг или спам', 'Phishing or spam', 500, NULL, NULL),
(239, 'complaint_content', 'collaborative', 'Неприемлемый контент', 'Inappropriate content', 500, NULL, NULL),
(240, 'complaint_other', 'collaborative', 'Другое', 'Other', 500, NULL, NULL),
(241, 'complaint_additional_info', 'collaborative', 'Добавьте дополнительную информацию', 'Add additional information', 500, NULL, NULL),
(242, 'cancel', 'collaborative', 'Отмена', 'Cancel', 500, NULL, NULL),
(243, 'finish', 'collaborative', 'Готово', 'Finish', 500, NULL, NULL),
(244, 'text_cannot_longer', 'validate', 'Длина текста не может превышать {count} символов', 'Text cannot be longer than {count} characters', 500, NULL, NULL),
(246, 'sections', 'notes', 'Коллекции', 'Collections', 500, NULL, NULL),
(247, 'section', 'notes', 'Коллекция', 'Collection', 500, NULL, NULL),
(248, 'title_sections', 'notes', 'Коллекции', 'Collections', 500, NULL, NULL),
(249, 'fieldset_text_styles', 'editor', 'Стили', 'Styles', 500, NULL, NULL),
(250, 'fieldset_lists', 'editor', 'Списки', 'Lists', 500, NULL, NULL),
(251, 'fieldset_text_elements', 'editor', 'Элементы', 'Elements', 500, NULL, NULL),
(252, 'tool_highlight_color', 'editor', 'Цвет маркера', 'Marker Color', 500, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `localizations`
--
ALTER TABLE `localizations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `localizations`
--
ALTER TABLE `localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;