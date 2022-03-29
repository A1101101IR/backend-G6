<?php get_header(); ?>

<section>
  <!-- Hämtar titel och visar i en h1 tag -->
  <h1><?php single_cat_title(); ?></h1>

    <!-- loop, kollar om det finns några post att visa -->
    <?php if (have_posts()) : while (have_posts()) : the_post();?>

      <!-- kollar om post som visas har en bild, om ja visar bilden. -->
      <?php if(has_post_thumbnail()):?>
        <img src="<?php the_post_thumbnail_url();?>" alt="<?php the_title();?>">
      <?php endif;?>

      <!-- hämtar post title och visar i h3 tag -->
      <h3><?php the_title();?></h3>

      <!-- Hämtar post content (kort version av texten) och visar i en p tag -->
      <?php the_excerpt();?>

      <!-- hämtar länken till vår post och visar i en a tag -->
      <a href="<?php the_permalink();?>"><button>Read more</button></a>
    <?php endwhile; endif;?>

</section>

<?php get_footer(); ?>
