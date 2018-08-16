<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Wootpress
 * @since Wootpress 1.0
 */
?>
</div><!--close and clear #main.container -->

<footer>
  <div class="footer-wrap container">
    <p class="copyright"><?php echo copyright( '2018' ); ?>. All Rights Reserved.</p>
    <?php
    wp_nav_menu( array(
    		'theme_location'	=> 'footer',
    		'depth'						=> 2,
    		'container'				=> 'div',
    		'container_class'	=> 'menu-footer container',
    		'menu_class'			=> 'nav',
    		'fallback_cb'			=> 'WP_Bootstrap_Navwalker::fallback',
    		'walker'					=> new WP_Bootstrap_Navwalker())
    );
    ?>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>
