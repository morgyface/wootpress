<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) the_post(); ?>

<?php $archivetitle = post_type_archive_title('', false); // No prefix and false to display ?>

<h1><?php echo $archivetitle; ?></h1>

<?php
rewind_posts();
get_template_part( 'loop', 'archive' );
?>

<?php get_footer(); ?>
