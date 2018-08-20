<?php
/**
 * Wootpress functions and definitions
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1140;

/** Tell WordPress to run wootpress_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'wootpress_setup' );

if ( ! function_exists( 'wootpress_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override wootpress_setup() in a child theme, add your own wootpress_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function wootpress_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'wootpress', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'wootpress' ),
		'footer' => __( 'Footer Navigation', 'wootpress' )
	) );
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function wootpress_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'wootpress' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'wootpress' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'wootpress' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'wootpress_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function wootpress_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wootpress_page_menu_args' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wootpress_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wootpress' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'wootpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'wootpress' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'wootpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'wootpress' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'wootpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wootpress_widgets_init' );

// This nugget allows you to have excerpts on pages as well as posts.
add_post_type_support('page', 'excerpt');

// Add support for SVG images
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//Page Slug Body Class
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/**
 * This adds custom CSS for the WP login page as well as adding a link back to the homepage.
 */
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_bloginfo( 'name', 'display' );
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Disabling Emoji following autmoatic inclusion from v4.2.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Remove link manager
if ( get_option( "link_manager_enabled") !== false ) {
    update_option("link_manager_enabled", 0);
} else {
    add_option("link_manager_enabled", 0);
}

// Remove comments from the dashboard menu
function remove_comments_from_menu() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_comments_from_menu' );

// This adds an options page for ACF
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Footer',
    'icon_url'    => 'dashicons-share'
	));
}

// To prevent images being wrapped with an a-tag by default.
update_option('image_default_link_type','none');

// Generating a meta description using standard WP components
function meta_description( $char_limit ) {
		$tagline = get_bloginfo ( 'description' );
    // We match custom post types with a page
    // This allows us to attach content to an archive
    // Here we match the post-type title to the page and grab the corrent post_object
    if ( is_archive() ) {
        $post_type_title = post_type_archive_title('', false);
        $post_object = get_page_by_title( $post_type_title );
    } else {
		    $post_object = get_post();
    }
		$excerpt = $post_object->post_excerpt; // Get the raw excerpt, warts (tags) and all.
		$content = $post_object->post_content; // Get the raw content.
		if ( !empty( $excerpt ) ) { // If there is an excerpt lets use it to generate a meta description
				$excerpt_stripped = strip_tags( $excerpt ); // Remove any tags using the PHP function strip_tags.
				$excerpt_length = strlen( $excerpt_stripped ); // Now lets count the characters
				if ( $excerpt_length > $char_limit ) { // Now work out if we need to trim the character length.
						$offset = $char_limit - $excerpt_length; // This gives us a negative value.
						$position = strrpos( $excerpt_stripped, ' ', $offset ); // This starts looking for a space backwards from the offset
						$description = substr( $excerpt_stripped, 0, $position ); // Trim up until the point of the last space.
			  } else {
						$description = $excerpt_stripped; // The excerpt must be less than the char_limit so lets just print it.
				}
		} elseif( !empty( $content ) ) {
				// If no excerpt exists we use the content, note the use of get_post as we are outside the loop.
				$content_stripped = strip_tags( $content );
				$content_length = strlen( $content_stripped );
				if ( $content_length > $char_limit ) {
				    $content_trimmed = substr( $content_stripped, 0, $char_limit ); // Trim the raw content back to the character limit
				    $last_space = strrpos( $content_trimmed, ' ' ); // Find the last space in the trimmed content which could include incomplete words
						$description = substr( $content_trimmed, 0, $last_space ); // Re-trim the content to the point of the last space.
			  } else {
						$description = $content_stripped;
				}
		} else {
		    $description = $tagline; // If the page is empty we can use the tagline to prevent emptiness.
		}
		return $description;
}

// Register Custom Navigation Walker
require_once('class-wp-bootstrap-navwalker.php');

// Returns either copyrighted date range or single date
function copyright( $build_year ) {
    // Build year should be in YYYY format
    $current_year = date('Y'); // Get A full numeric representation of the current year, 4 digits
    $blogname = get_bloginfo( 'name' ); // Get the Site Title as specified in Settings / General
    $copyright = '&copy;';
    if ( $build_year == $current_year ) {
        $copyright .= $current_year;
    } else {
        $copyright .= $build_year . ' - ' . $current_year;
    }
    $copyright .= ' ' . $blogname;
    return $copyright;
}

// Useful during dev to show order number of fields within acf dashboard list
function acf_field_group_columns($columns) {
    $columns['menu_order'] = __('Order');
    return $columns;
  } // end function reference_columns
  add_filter('manage_edit-acf-field-group_columns', 'acf_field_group_columns', 20);

  function acf_field_group_columns_content($column, $post_id) {
    switch ($column) {
        case 'menu_order':
            global $post;
            echo $post->menu_order;
            break;
        default:
            break;
    } // end switch
  } // end function reference_columns_content
  add_action('manage_acf-field-group_posts_custom_column', 'acf_field_group_columns_content', 20, 2);

  // Removes the default editor
  add_action('admin_head', 'hide_editor');
  function hide_editor() {
      $template_file = $template_file = basename(get_page_template());
      $excluded = array(
          'home.php',
          'contact.php'
      );
      foreach ($excluded as $template){
          if ($template_file == $template) {
              remove_post_type_support('page', 'editor');
          }
      }
  }

  // If the post does not have a featured image
  function feat_img_fallback($post_id, $image_size = 'thumbnail') {
      if ( has_post_thumbnail($post_id) ) {
          $image_id = get_post_thumbnail_id($post_id);
          $image_src = wp_get_attachment_image_src($image_id, $image_size);
          $image_url = $image_src[0];
      } else {
          $image_url = get_bloginfo('template_directory') . '/images/no-image.svg';
      }
      return $image_url;
  }
