<?php
/**
 * Right sidebar check
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Closing the primary container from /global-templates/left-sidebar-check.php.
?>
</div><!-- #primary -->

<div class="col-sm">
	<p>Площадь: <?= the_field('area')?></p>
	<p>Стоимость: <?= the_field('price')?></p>
	<p>Адрес: <?= the_field('address')?></p>
	<p>Жилая площадь: <?= the_field('living-space')?></p>
	<p>Этаж: <?= the_field('floor')?></p>
</div>