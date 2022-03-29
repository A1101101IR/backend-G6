<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <?php if (has_post_thumbnail()) : ?>
    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
  <?php endif; ?>

  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>

<?php endwhile;
endif; ?>
<?php get_footer(); ?>
