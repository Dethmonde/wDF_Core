<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'BD-WP' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '#vid8U(=H=huXy@@*uA3Nx] mEq>f C><Ad}RF9)w]dAW1r$I$_}A6Q$C|Sm<87}' );
define( 'SECURE_AUTH_KEY',  '5ac$@Q^;b#}c?,b!>tWp4$*-Ag;M}7M/f~xLz{Z&XLHLeL1Ekw`y(nF[<v`T(8Wt' );
define( 'LOGGED_IN_KEY',    'H1s0v,vE&Xbv#atol#N$U.z!s{fsa73e(O<#:^3A1d*/Shy)6Cdp)i-ray,cG90#' );
define( 'NONCE_KEY',        '0.l|/)}D6&Jc1_YCqdbt/ovTk| a=$aIC.(bp]lE,D[DY6XP`[v@.9jl_vJ:#>2.' );
define( 'AUTH_SALT',        'ulM)rC+Pu.C|9zA3}v;lq|;:6b}WYjFHw@J-%^f0s~I;VaE#j3au@Z@y83~B?~eC' );
define( 'SECURE_AUTH_SALT', '0xNA*2#YK1UfI+E?|IKbuvrLvUm08*(o^kRwY/9~Y/HApuP} 4PsWH/&%qe[Jgns' );
define( 'LOGGED_IN_SALT',   'qJpv1%L+`B<0+T_|]H;_ur=s:e/k#y;TLsGXw/V;>&d+O51rSH-ZQZ{UbriL`nx[' );
define( 'NONCE_SALT',       '/k%~~XNdLVOkqN^ZD,(Gk5 C/ya?]OCgp]@D#FQrDy{fI6#<**k)eoJc8rXeTgeQ' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
