<!DOCTYPE html>
<html lang="en">
<head>
      <?php wp_head(); ?>
</head>
<body
<?php body_class(); ?>>
<header>
  <nav class="nav-container">
    <!-- <div class="nav-cont"><p class="user-name">USER</p></div>
    <div class="nav-input login-header">
      <span id="username" class="currentUserText"><div class="login-avatar"></div></span>
    </div>
    <div class="nav-logo"></div> -->
    <div class="nav-input login-header">
      <span id="username" class="currentUserText"><div class="login-avatar"></div></span>
    </div>
  </nav>
  <a class="logo" href="/"><h1 class="header-name"><?php echo get_bloginfo( 'name' ); ?></h1></a>
</header>

