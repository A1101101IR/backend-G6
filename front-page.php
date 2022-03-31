<?php get_header(); ?>

<section>
  <!-- Hämtar titel och visar i en h1 tag -->
  <h1><?php single_cat_title(); ?></h1>

  <div class="main-content-container">

    <div class="text-area-container">
      <div class="user-select-container">
        <label for="user-select">
          <select name="user" id="user-select" class="user-dropdown">
            <option value="">Select User</option>
            <option value="amir">Amir</option>
            <option value="angelica">Angelica</option>
            <option value="filip">Filip</option>
          </select>
        </label>
      </div>
      <div class="text-input">
        <label for="tweet"></label>
        <textarea name="tweets" id="tweet" cols="30" rows="5"></textarea>
      </div>
      <div class="btn-container">
        <button class="tweet-btn">Chrip it/Post</button>
      </div>
    </div>

    <div class="tweets-container">

      <div class="tweet-card-container">
        <div class="avatar"></div>
        <div class="tweet-text">
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam modi harum doloremque at corporis magnam non commodi sequi distinctio debitis, repellat nostrum accusamus nesciunt, dolores quo obcaecati delectus, pariatur unde animi recusandae sint voluptatum aspernatur? Eum quos placeat quaerat earum sequi laudantium impedit eaque nulla ratione magnam fugit tenetur ad delectus voluptatem consequuntur magni perspiciatis cum enim totam nobis tempore numquam, dolor iure aperiam. Repellat excepturi aspernatur aut magni porro ex quaerat laboriosam est minima harum sapiente quis voluptas atque necessitatibus, nemo, quam ut dolor maiores eligendi. Fugiat, odio ut eveniet ad odit ab accusantium iste omnis deleniti, cumque minus.</p>
        </div>
        <div class="btn-container-post">
          <button class="btn-in-post edit">Edit</button>
          <button class="btn-tweet delete">Delete</button>
        </div>
      </div>

      <div class="tweet-card-container">
        <div class="avatar"></div>
        <div class="tweet-text">
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam modi harum doloremque at corporis magnam non commodi sequi distinctio debitis, repellat nostrum accusamus nesciunt, dolores quo obcaecati delectus, pariatur unde animi recusandae sint voluptatum aspernatur? Eum quos placeat quaerat earum sequi laudantium impedit eaque nulla ratione magnam fugit tenetur ad delectus voluptatem consequuntur magni perspiciatis cum enim totam nobis tempore numquam, dolor iure aperiam. Repellat excepturi aspernatur aut magni porro ex quaerat laboriosam est minima harum sapiente quis voluptas atque necessitatibus, nemo, quam ut dolor maiores eligendi. Fugiat, odio ut eveniet ad odit ab accusantium iste omnis deleniti, cumque minus.</p>
        </div>
        <div class="btn-container-post">
          <button class="btn-in-post edit">Edit</button>
          <button class="btn-tweet delete">Delete</button>
        </div>
      </div>

      <script>
        let token = token;
      </script>

      <!-- End tweet card container -->
    </div>
<!-- end content container -->
  </div>





















    

</section>
<div>
  
Helloo
</div>

<?php get_footer(); ?>
