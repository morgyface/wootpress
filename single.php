<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>
    <p class="entry-date"><?php echo get_the_date('l jS F Y'); ?></p>
    <?php the_content(); ?>

    <?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
    <?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
