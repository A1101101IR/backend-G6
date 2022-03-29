<?php

/* lägger till menu support till teman */
add_theme_support('menus');
/*  lägger till en function som visar post bilden */
add_theme_support('post-thumbnails');


/* deklarerar stylesheet och aktiverar functionen. */
function stylesheet()
{
    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), false, 'all');
    wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts', 'stylesheet');

/* deklarerar script och aktiverar functionen. */
function script()
{
  wp_register_script('customjs', get_template_directory_uri() . '/script.js', '', 1, true);
  wp_enqueue_script('customjs');
}
add_action('wp_enqueue_scripts', 'script');

/* registererar menu och aktiverar functionen. */
register_nav_menus(
  array(
    'top-menu' => __('Top Menu', 'theme'),
    'footer-menu' => __('Footer Menu', 'theme'),
  )
);
