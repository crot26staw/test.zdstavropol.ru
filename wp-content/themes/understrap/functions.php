<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}

// Подключаю стили, скрипты

add_action('wp_enqueue_scripts', 'theme_add_scripts');
add_action('wp_footer', 'add_scripts');

function theme_add_scripts()
{
	// подключаем файл стилей темы
	wp_enqueue_style('dop-style', get_template_directory_uri() . '/style/style.css');
}

function add_scripts()
{
	// Подключаем скрипты
	wp_enqueue_script('script', get_template_directory_uri() . '/scripts/script.js', array(), '1.0', true);
}

// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'type_house', [ 'blog' ], [
		'label'                 => 'Типы недвижимости', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Тип недвижимости',
			'singular_name'     => 'Тип недвижимости',
			'search_items'      => 'Искать тип недвижимости',
			'all_items'         => 'Все типы недвижимости',
			'view_item '        => 'Смотреть тип недвижимости',
			'parent_item'       => 'Родительский тип недвижимости',
			'parent_item_colon' => 'Родительский тип недвижимости:',
			'edit_item'         => 'Редактирование типа недвижимости',
			'update_item'       => 'Обновление типа недвижимости',
			'add_new_item'      => 'Добавить тип недвижимости',
			'new_item_name'     => 'Новый тип недвижимости',
			'menu_name'         => 'Тип недвижимости',
			'back_to_items'     => 'Назад',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => true, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => true,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}


// Добавление таксономии в столбцы
function my_custom_taxonomy_columns($columns) {
    $columns['my_taxonomy'] = 'Тип недвижимости'; // Замените на название вашей таксономии
    return $columns;
}
add_filter('manage_blog_posts_columns', 'my_custom_taxonomy_columns');

function my_custom_taxonomy_column_content($column, $post_id) {
    switch ($column) {
        case 'my_taxonomy':
            $terms = get_the_terms($post_id, 'type_house'); // Замените 'my_taxonomy' на вашу таксономию
            if ($terms) {
                foreach ($terms as $term) {
                    echo $term->name . ', ';
                }
            } else {
                echo '-'; // или другой текст по умолчанию
            }
            break;
    }
}
add_action('manage_blog_posts_custom_column', 'my_custom_taxonomy_column_content', 10, 2);


// Замените 'post' на идентификатор вашего произвольного типа записи
add_filter('manage_post_posts_columns', 'my_custom_taxonomy_columns');


function create_blog_type(){
	register_post_type( 'blog', [
		'label'  => null,
		'labels' => [
			'name'               => 'Недвижимость', // основное название для типа записи
			'singular_name'      => 'Недвижимость', // название для одной записи этого типа
			'add_new'            => 'Добавить недвижимость', // для добавления новой записи
			'add_new_item'       => 'Добавление недвижимости', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование недвижимости', // для редактирования типа записи
			'new_item'           => 'Новая недвижимость', // текст новой записи
			'view_item'          => 'Смотреть недвижимость', // для просмотра записи этого типа.
			'search_items'       => 'Искать недвижимость', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Недвижимость', // название меню
		],
		'description'            => '',
		'public'                 => true,
		'publicly_queryable'  => true, // зависит от public
		'exclude_from_search' => false, // зависит от public
		'show_ui'             => true, // зависит от public	
		'show_in_nav_menus'   => true, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ 'category', 'type_house' ],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}
add_action( 'init', 'create_blog_type' ); 


function create_sity_type(){
	register_post_type( 'sity', [
		'label'  => null,
		'labels' => [
			'name'               => 'Города', // основное название для типа записи
			'singular_name'      => 'Город', // название для одной записи этого типа
			'add_new'            => 'Добавить город', // для добавления новой записи
			'add_new_item'       => 'Добавление города', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование города', // для редактирования типа записи
			'new_item'           => 'Новый город', // текст новой записи
			'view_item'          => 'Смотреть город', // для просмотра записи этого типа.
			'search_items'       => 'Искать город', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Города', // название меню
		],
		'description'            => '',
		'public'                 => true,
		'publicly_queryable'  => true, // зависит от public
		'exclude_from_search' => false, // зависит от public
		'show_ui'             => true, // зависит от public	
		'show_in_nav_menus'   => true, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню админки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [ 'category' ],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}
add_action( 'init', 'create_sity_type' ); 


// Добавляем произвольное поле

function add_my_custom_meta_box() {
    add_meta_box(
        'my_custom_meta_box_id',   // ID метабокса
        'Выберите объекты',          // Заголовок метабокса
        'my_custom_meta_box_html', // Callback функция
        'sity'                     // Тип записи
    );
}
add_action('add_meta_boxes', 'add_my_custom_meta_box');


function my_custom_meta_box_html($post) {
    $selected_blogs = get_post_meta($post->ID, '_selected_blog_ids', true) ?: array();
    $blog_posts = get_posts(array('post_type' => 'blog', 'numberposts' => -1));

    echo '<select name="blog_field[]" id="blog_field" multiple style="width: 100%; height: 100px;">';
    foreach ($blog_posts as $blog_post) {
        $isSelected = in_array($blog_post->ID, $selected_blogs) ? ' selected' : '';
        echo '<option value="' . esc_attr($blog_post->ID) . '"' . $isSelected . '>' . esc_html($blog_post->post_title) . '</option>';
    }
    echo '</select>';
}


function save_my_meta_box_data($post_id) {
    if (isset($_POST['blog_field'])) {
        $blog_ids = array_map('sanitize_text_field', $_POST['blog_field']);
        update_post_meta(
            $post_id,
            '_selected_blog_ids',
            $blog_ids
        );
    } else {
        delete_post_meta($post_id, '_selected_blog_ids');
    }
}
add_action('save_post_sity', 'save_my_meta_box_data');

