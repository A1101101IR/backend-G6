<?php get_header(); ?>

<h1><?php the_title(); ?></h1>
<?php the_content();?>


<div>
    <div class="tweet-card-container">  
        <div class="avatar">
            <img src="./img/amir.jpg" alt="">
        </div>
        <div class="tweet-text">
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam modi harum doloremque at corporis magnam non commodi sequi distinctio debitis, repellat nostrum accusamus nesciunt, dolores quo obcaecati delectus, pariatur unde animi recusandae sint voluptatum aspernatur? Eum quos placeat quaerat earum sequi laudantium impedit eaque nulla ratione magnam fugit tenetur ad delectus voluptatem consequuntur magni perspiciatis cum enim totam nobis tempore numquam, dolor iure aperiam. Repellat excepturi aspernatur aut magni porro ex quaerat laboriosam est minima harum sapiente quis voluptas atque necessitatibus, nemo, quam ut dolor maiores eligendi. Fugiat, odio ut eveniet ad odit ab accusantium iste omnis deleniti, cumque minus.</p>
        </div>
        <div class="btn-container-post">
          <button class="btn-in-post edit">Edit</button>
          <button class="btn-tweet delete">Delete</button>
        </div>
    </div>
</div>
<?php get_footer(); ?>
