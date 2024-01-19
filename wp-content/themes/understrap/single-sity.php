<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$house = maybe_unserialize(get_post_custom()['_selected_blog_ids'][0]);
?>

<main>
	<div class="container-xl">
		<h2><?= the_title()?></h2>
		<div class="house__items row gy-5">
			<?
			// параметры по умолчанию
			$my_posts = get_posts( array(
				'numberposts' => 10,
				'post_type'   => 'blog',
				'include'     => $house
			) );

			global $post;

			foreach( $my_posts as $post ){
				setup_postdata( $post );
				?>
				<article class="house__post col-4">
					<a class="house__post-link" href="<?= the_permalink() ?>">
						<img class="house__post-img" src="<?= get_the_post_thumbnail_url()?>" alt="">
					</a>
					<h3 class="house__post-title"><?= $post->post_title ?></h3>
					<p>Площадь: <?= the_field('area')?></p>
					<p>Стоимость: <?= the_field('price')?></p>
					<p>Адрес: <?= the_field('address')?></p>
				</article>
				<?
			}

			wp_reset_postdata(); // сброс
			?>
		</div>
	</div>
</main>

<?php
get_footer();
