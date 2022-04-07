<!DOCTYPE html>
<html lang="en">
<head>
      <?php wp_head(); ?>
</head>
<body
<?php body_class(); ?>>
<header>
  <nav class="nav-container">
    <div class="nav-cont"><p class="user-name">USER</p></div>
    <div class="nav-input"></div>
    <div class="nav-logo"><div class="login-avatar"></div></div>
</nav>
  <a class="logo" href="/"><h1 class="header-name"><?php echo get_bloginfo( 'name' ); ?></h1></a>
</header>

