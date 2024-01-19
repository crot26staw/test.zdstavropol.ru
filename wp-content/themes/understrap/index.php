<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<main>
	<section class="house container-xl">
		<h2 class="house__tile">Недвижимость</h2>
		<div class="house__items row gy-5">
			<?
			// параметры по умолчанию
			$my_posts = get_posts( array(
				'numberposts' => 10,
				'post_type'   => 'blog',
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
	</section>
	<section class="city container-xl">
		<h2>Города</h2>
		<div class="city__items row gy-5">
			<?
				// параметры по умолчанию
				$my_posts = get_posts( array(
					'numberposts' => -1,
					'post_type'   => 'sity',
				) );

				global $post;

				foreach( $my_posts as $post ){
					setup_postdata( $post );
					?>
					<article class="city__post col-4">
						<a class="city__post-link" href="<?= the_permalink() ?>">
							<img class="city__post-img" src="<?= get_the_post_thumbnail_url()?>" alt="">
						</a>
						<h3 class="city__post-title"><?= $post->post_title ?></h3>
						<p><?= $post->post_content ?></p>
			
					</article>
					<?
				}

				wp_reset_postdata(); // сброс
			?>
		</div>
	</section>
	<div class="container-xl">
		<h2>Добавить недвижимость</h2>
		<form class="main-mailng__form">
			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Название</label>
				<input type="text" class="form-control" name="name" id="name">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Описание</label>
				<input type="text" class="form-control" name="descr" id="descr">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Адрес</label>
				<input type="text" class="form-control" name="address" id="address">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Площадь</label>
				<input type="text" class="form-control" name="area" id="area">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Стоимость</label>
				<input type="text" class="form-control" name="price" id="price">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Жилая площадь</label>
				<input type="text" class="form-control" name="square" id="square">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Этаж</label>
				<input type="text" class="form-control" name="floor" id="floor">
			</div>
			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Изображение</label>
				<br>
				<input type="file" accept="image/*" name="image" id="image">
			</div>
			<button type="submit" class="btn btn-primary">Добавить</button>
		</form>
	</div>
</main>
<div class="popup">
    <div class="popup__container">
        <div class="popup__close">
            <div class="popup__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M4.41205 4.41076C4.73748 4.08533 5.26512 4.08533 5.59056 4.41076L10.0013 8.82152L14.4121 4.41076C14.7375 4.08533 15.2651 4.08533 15.5906 4.41076C15.916 4.7362 15.916 5.26384 15.5906 5.58928L11.1798 10L15.5905 14.4107C15.916 14.7362 15.916 15.2638 15.5905 15.5892C15.2651 15.9147 14.7375 15.9147 14.412 15.5892L10.0013 11.1785L5.59056 15.5893C5.26512 15.9147 4.73748 15.9147 4.41205 15.5893C4.08661 15.2639 4.08661 14.7362 4.41205 14.4108L8.82281 10L4.41205 5.58928C4.08661 5.26384 4.08661 4.7362 4.41205 4.41076Z"
                        fill="#1570EF" />
                </svg>
            </div>
        </div>
        <div class="popup__content">
            <div class="popup__header">
                <div class="popup__title">
                    <p></p>
                </div>
            </div>
 
        </div>
    </div>
</div>
<?php
get_footer();
