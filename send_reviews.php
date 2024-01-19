<?php
require_once('wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');


// Теперь вы можете использовать функции WordPress
$my_post = array(
 'post_title' => $_POST['name'],
 'post_content' => $_POST['descr'],
 'post_status' => 'draft',
 'post_author' => 1,
 'post_type'  => 'blog',
 'meta_input'    => array (
    'address'=> $_POST['address'],
    'area' => $_POST['area'], 
    'price' => $_POST['price'], 
    'living-space' => $_POST['square'], 
    'floor' => $_POST['floor'], 
 ),
);

$post_id = wp_insert_post($my_post);


// Получаем данные о файле из массива $_FILES
$file_info = $_FILES['image'];

// Загружаем файл в медиабиблиотеку
$upload = wp_upload_bits($file_info['name'], null, file_get_contents($file_info['tmp_name']));

// Проверяем успешность загрузки
if (empty($upload['error'])) {
    // Файл успешно загружен, получаем его URL
    $file_url = $upload['url'];
    
    // Создаем вложение из загруженного файла
    $attachment = array(
        'guid' => $file_url,
        'post_mime_type' => $file_info['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_info['name'])),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    $attach_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    
    // Привязываем вложение к посту
    set_post_thumbnail($post_id, $attach_id);
} else {
    // Обработка ошибки загрузки файла
    echo 'Ошибка при загрузке файла: ' . $upload['error'];
}
