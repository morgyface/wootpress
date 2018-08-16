<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */
echo '<div class="col-3" id="sidebar">' . PHP_EOL;
if ( is_active_sidebar( 'primary-widget-area' ) ) :
    echo '<ul class="primary widget-area">' . PHP_EOL;
    dynamic_sidebar( 'primary-widget-area' );
    echo '</ul>' . PHP_EOL;
endif;
// A second sidebar for widgets.
if ( is_active_sidebar( 'secondary-widget-area' ) ) :
    echo '<ul class="secondary widget-area">' . PHP_EOL;
    dynamic_sidebar( 'secondary-widget-area' );
    echo '</ul>' . PHP_EOL;
endif;
echo '</div>' . PHP_EOL; // Close div#sidebar
?>
