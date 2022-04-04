<?php get_header(); ?>

<section>
  <!-- Hämtar titel och visar i en h1 tag -->
  <h1><?php single_cat_title(); ?></h1>
  <p>
  <?php
  $user = get_current_user_id();
  $userdata = get_userdata($user);
  $firstName = $userdata->first_name;
  echo $firstName;
 ?>
  </p>
  
  
  <div class="main-content-container">

    <div class="text-area-container">
      <div>
        <textarea name="description" id="description" maxlength="240" rows="8" cols="80"></textarea>
        <button onClick="postTweet()" class="tweet-btn">Chrip it/Post</button>
      </div>
      <!-- <div class="user-select-container">
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
        <button class="tweet-btn" onClick="postTweet()">Chrip it/Post</button>
      </div> -->
    </div>

    <div class="tweets-container">
    
    <div id="post"></div>
      
    
    </div>
<!-- end content container -->
  </div>
  <script>
    /* Hämtar data coh skapar inlägg av de */
    async function getTweet() {
      var requestOptions = {
        method: 'GET',
        redirect: 'follow'
      };
      let postData = await fetch("http://localhost:8000/tweet", requestOptions);
      let myData = await postData.json();
      btn = `
      <div>
      <button class'btn-in-post edit' onClick='putPost(${post.id})'>Edit</button>
      <button class='btn-tweet delete' onClick='deleteTweet(${post.id})'>Delete</button>
      <button class'btn-in-post edit' onClick='updatePost(${post.id})'>update</button>
      </div>`
      let output = "";
      let myBtn = "";
      if (myData) {
        myData.map((post) => {
          if (test == post.author) { myBtn = btn}
          output += `<div class="tweet-card-container" key={post.id}>  
              <div class="avatar">
                <img src="https://t1.gstatic.com/licensed-image?q=tbn:ANd9GcT0BTHYsJqrUEhxjVReplkbGQlNLDzaFfKwIDXf_aiY4isJBd-3_fLVYpIWNi6r7P604hS3DRwAoyf_jnPhpAs" alt="">
              </div>
              <div class="tweet-text" id=${post.id}  >
                ${post.description}
              </div>
              <div class="btn-container-post">
                ${myBtn}
              </div>
          </div>`
        })
      }
      document.getElementById('post').innerHTML = output;
    }



    /* skapar nya inlägg och skickar till databasen */
    async function postTweet() {
      input = document.getElementById('description').value;
      let tweet = {
        description : input
      };
      await fetch("http://localhost:8000/tweet/", {
        method: 'POST',
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(tweet),
        redirect: 'follow'
      })
      getTweet();
    };


    function putPost(id) {
      editTweetText = document.getElementById(id).innerText;
      editTweet = document.getElementById(id);
      editTweet.setAttribute("contenteditable", "true");
    }

    function updatePost(id) {
      newTweet = document.getElementById(id).value;
      console.log(id);
    }
    /* TODO: send put req to databas, update post & make update btn only appear after clicking edit on specific div*/




    

    /* tar bort inlägg och gör en reload på sidan för att uppdatera output */
    function deleteTweet(id) {
      var urlencoded = new URLSearchParams();

      var requestOptions = {
        method: 'DELETE',
        body: urlencoded,
        redirect: 'follow'
      };

      fetch(`http://localhost:8000/tweet/${id}`, requestOptions)
        .then(response => response.text())
        .then(result => console.log("Tweet med id " + id + " togs bort!"))
        .catch(error => console.log('error', error));
        setTimeout(() => {
          location.reload(); 
        }, 500);
      };
    
    getTweet();
    let test = "<?php echo $firstName ?>";
  </script>
















    

</section>


<?php get_footer(); ?>
