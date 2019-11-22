<?php 
// Инициализация сессии
add_action('init', function () {
    if (session_id() == '') {
        session_start();
    }
});

// Обработка загрузки фотографий по средствам WP
add_action('admin_post_elgoods_upload_file', function () {
    $check1 = wp_verify_nonce($_POST['_wpnonce'],'elgoods_upload_file');
    $check2 = current_user_can('upload_files');
	$check3 = $_FILES['elgoods_upload_file']['type'];
    ob_start();
    if ($check1 && $check2 && $check3 == 'image/jpeg') {
        $overrides = ['test_form' => false];
        $result = wp_handle_upload($_FILES['elgoods_upload_file'],$overrides);
			if (isset($result['error'])) {
				echo 'Ошибка при загрузке файла';
			} else {
				echo 'Файл был успешно загружен';
				echo $_POST['elgoods_link'];
			}
    } else {
        echo 'Проверка не пройдена, файл не загружен';
    }
    $_SESSION['elgoods_upload_file'] = ob_get_clean();
    $redirect = home_url();
    if (isset($_POST['redirect'])) {
        $redirect = $_POST['redirect'];
        $redirect = wp_validate_redirect($redirect, home_url());
    }
    wp_redirect($redirect);
    die();
});

// Функция активируется при добавлении плагина
function activate(){
	global $wpdb;			//Глобальная переменная WordPress для работы с БД
	$table_name = $wpdb->prefix . "elgoods";	//Задание имени таблицы с префиксом WordPress
	// Проверка на наличие таблицы в базе данных и создание если такая не существует
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$sql_query = "CREATE TABLE " . $table_name . " (
				 id mediumint(9) NOT NULL AUTO_INCREMENT,
				 name tinytext NOT NULL COLLATE utf8_general_ci,
				 photo_url tinytext NOT NULL COLLATE utf8_general_ci,
				 url VARCHAR(100) NOT NULL COLLATE utf8_general_ci,
				 UNIQUE KEY id (id)
			  );";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); //Подключение библиотеки для создания запросов
		dbDelta($sql_query);	
	}
}

?>
