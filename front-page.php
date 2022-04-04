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
        <button class="tweet-btn" onClick="postTweet()">Post</button>
      </div>
    </div>

    <div class="tweets-container">

    <div id="post"></div>
      

    </div>
<!-- end content container -->
  </div>




  <script>
    /* Hämtar data coh skapar inlägg av de */
    async function getPost() {
      var requestOptions = {
        method: 'GET',
        redirect: 'follow'
      };
      let postData = await fetch("http://localhost:8000/tweet", requestOptions);
      let myData = await postData.json();
      let output = "";
      if (myData) {
        myData.map((post) => {
          output += `<div class="tweet-card-container" key={post.id}>  
              <div class="avatar">
                <img src="https://t1.gstatic.com/licensed-image?q=tbn:ANd9GcT0BTHYsJqrUEhxjVReplkbGQlNLDzaFfKwIDXf_aiY4isJBd-3_fLVYpIWNi6r7P604hS3DRwAoyf_jnPhpAs" alt="">
              </div>
              <div class="tweet-text">
                <p>${post.description}</p>
              </div>
              <div class="btn-container-post">
                <button class="btn-in-post edit">Edit</button>
                <button class="btn-tweet delete" onClick="deleteTweet(${post.id})">Delete</button>
              </div>
          </div>`
        })
      }
      document.getElementById('post').innerHTML = output;
    }

    /* skapar nya inlägg och skickar till databasen */
    function postTweet() {
      var myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
      input = document.getElementById('tweet').value;
      inputData = {
        tweet : {
          description: input
        }
      }
      console.log(inputData);
      var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: inputData,
        redirect: 'follow'
      };

      fetch("http://localhost:8000/tweet/", requestOptions)
        .then(response => response.text())
        .then(result => console.log(result))
        .catch(error => console.log('error', error));
    }



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
    
    getPost();
  </script>
















    

</section>


<?php get_footer(); ?>
