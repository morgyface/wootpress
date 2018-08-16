<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */
?>

<?php
$homelink = esc_url( home_url( '/' ) );
$frontpage_id = get_option( 'page_on_front' );
$frontpage_title = get_the_title ( $frontpage_id );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="https://use.typekit.net/bgd4qzz.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/font-awesome.min.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="description" content="<?php echo meta_description(155); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  	  <div class="container">
          <?php if ( ! is_front_page() ) { ?>
              <a class="navbar-brand d-block" href="<?php echo $homelink; ?>" title="<?php echo esc_html( $frontpage_title ); ?>" rel="home">
          <?php } ?>
              <img class="<?php if ( is_front_page() ) { ?>navbar-brand <?php }?>d-block" src="<?php echo get_bloginfo('template_url') . '/images/wordpress.png'; ?>"  alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>">
          <?php if ( ! is_front_page() ) { ?>
              </a>
          <?php } ?>
      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>
      		</button>
      		<?php
      		wp_nav_menu( array(
      				'theme_location'	=> 'primary',
      				'depth'						=> 2,
      				'container'				=> 'div',
      				'container_class'	=> 'collapse navbar-collapse',
      				'container_id'		=> 'navbar',
      				'menu_class'			=> 'navbar-nav ml-auto',
      				'fallback_cb'			=> 'WP_Bootstrap_Navwalker::fallback',
      				'walker'					=> new WP_Bootstrap_Navwalker())
      		);
      		?>
  	  </div> <!-- close .container -->
	</nav>

<?php
if ( is_front_page() ) {
		// Let us display a jumbotron on the homepage
		$frontpage = get_post( $frontpage_id );
	  $frontpage_excerpt = $frontpage->post_excerpt;
    ?>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><?php echo $frontpage_title; ?></h1>
            <?php if ( $frontpage_excerpt ) { ?>
                <p><?php echo $frontpage_excerpt; ?></p>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<div id="main" class="container">
