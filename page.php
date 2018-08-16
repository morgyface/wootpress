<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php if ( ! is_front_page() ) { ?>
			<h1><?php the_title(); ?></h1>
		<?php } ?>

		<?php the_content(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
