<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
$templatedir = get_bloginfo('template_directory');
echo '<link rel="stylesheet" type="text/css" media="all" href="' . $templatedir . '/css/under-construction.css" />' . PHP_EOL;
?>
</head>
<body id="under-construction">
<div id="coming-soon">
  <?php 
  $logoname = 'wordpress.png'; /* change this to the name of your logo */
  $blogname = get_bloginfo( 'name' );
  echo '<img src="' . $templatedir . '/images/' . $logoname . '" alt="' . $blogname . '">' . PHP_EOL;
  ?>
</div>
</body>
</html>