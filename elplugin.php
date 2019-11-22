<?php
/*
 * Plugin Name: ELCORONE Goods
 * Plugin URI: https://elcorone.ru/
 * Description: Goods and Links
 * Version: 0.1
 * Author: Илья Корон
 * Author URI: https://elcorone.ru/
 * License: GPLv2 or later
 */

require_once('function.php');

// Добавление кнопок в Admin Menu
function elgoods_menu() {
	add_menu_page('EL Goods','Товары','manage_options','elgoods','elgoods_main_page','dashicons-cart');
	add_submenu_page( 'elgoods', 'Страница добавления товара', 'Добавление товара', 'manage_options', 'addgoods', 'elgoods_addgoods_page' );
}

function elgoods_main_page() {
	require_once ('page/main.php');
}

function elgoods_addgoods_page() {
	require_once ('page/addgoods.php');
}

add_action( 'admin_menu', 'elgoods_menu' );
register_activation_hook( __FILE__, 'elgoods_activate' );
 ?>
