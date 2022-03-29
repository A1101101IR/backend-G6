<!DOCTYPE html>
<html lang="en">

<head>
      <?php wp_head(); ?>
</head>

<body
<?php body_class(); ?>>
<header>
  <a href="/"><h1><?php echo get_bloginfo( 'name' ); ?></h1></a>
  <?php wp_nav_menu(
      array (
          'theme-location' => 'top-menu',
          'menu_class' => 'navbar_ul'
        )
  ); ?>
</header>
