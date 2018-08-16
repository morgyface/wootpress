<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */
?>

<?php if ( ! have_posts() ) : ?>
		<h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
		<?php get_search_form(); ?>
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="card">
      <img class="card-img-top" src="<?php echo feat_img_fallback($post->ID, 'medium'); ?>" alt="<?php the_title(); ?>">
      <div class="card-body">
    		<h3 class="card-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
    		<p class="card-subtitle text-muted entry-date"><?php echo get_the_date('l jS F Y'); ?></p>
        <?php
        $excerpt = get_the_excerpt();
        if ( $excerpt != '' ) { ?>
            <p class="card-text"><?php echo $excerpt; ?></p>
        <?php } ?>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>

<?php endwhile; // End the loop. ?>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		<?php next_posts_link( __( '&larr; Older posts', 'twentyten' ) ); ?>
		<?php previous_posts_link( __( 'Newer posts &rarr;', 'twentyten' ) ); ?>
<?php endif; ?>
