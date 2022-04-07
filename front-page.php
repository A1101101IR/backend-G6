<?php get_header(); ?>

<section class="main-content-container">
    <!-- Vi hämtar user id, sedan hämtar userdata, hämtar user firstName -->
    <div class="text-area-container">
      <div class="login-header">
          <span class="currentUserText">
            <?php
            $user = get_current_user_id();
            $userdata = get_userdata($user);
            $firstName = $userdata->first_name;
            echo $firstName;
            ?>
          </span>
          <div class="login-avatar"></div>
      </div>
        <div class="submit-body">
            <!-- Textarea för att skicka data vid post req. -->
            <textarea name="description" id="description" maxlength="240" rows="8" cols="80"></textarea>
            <button onClick="postTweet()" class="tweet-btn">Post</button>
        </div>
    </div>
    <!-- container för tweets som fylls på när man besöker sidan. -->
    <div class="tweets-container">
      <div id="post"></div>
    </div>
    <!-- end content container -->


  <!-- våran script tag som innehåller samtliga funktioner. -->
  <script>
    /* Hämtar data coh skapa inlägg av data */
    async function getTweet() {
      var requestOptions = {
        method: 'GET',
        redirect: 'follow'
      };
      let postData = await fetch("http://localhost:8000/tweet", requestOptions);
      let myData = await postData.json();
      let output = "";
      let myBtn = "";
      if (myData) {
        myData.reverse().map((post) => {
          btn = `
          <div class="btn-container-post">
            <div></div>
            <div class="btn-div">
            <button class='btn-in-post edit' onClick='putPost(${post.id})'>Edit</button>
            <button class='btn-in-post edit' onClick='updatePost(${post.id})'>Update</button>
            <img onClick='deleteTweet(${post.id})' src="https://www.iconpacks.net/icons/1/free-trash-icon-347-thumb.png" alt="trash" class="trash-img">
            </div>
          </div>`
          if (currentUser == post.author) { myBtn = btn } else { myBtn = ""}
          output += `<div class="tweet-card-container" key={post.id}>  
              <div class="avatar ${post.author}">
                
              </div>
              <div class="tweet-text-div"   >
                <div class="postInfo">
                  <p>@${post.author}</p>
                  <p>${post.date}</p>
                </div>
                <div class="tweet-text" id=${post.id}>${post.description}</div>
                <div>
                ${myBtn}
                </div>
              </div>
              
          </div>`
        })
      }
      document.getElementById('post').innerHTML = output;
    }

    let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    let date = new Date(Date.now());
    
    /* Skapar nya inlägg och skickar till databasen */
    async function postTweet() {
      input = document.getElementById('description').value;
      author = currentUser;
      if(input.length == 0) {
        alert('You cannot post an empty tweet!');
        return; 
      }
      
      let tweet = {
        description : input,
        author : author,
        date :  date.toLocaleDateString("en-SE", options), 
      };

      await fetch("http://localhost:8000/tweet/", {
        method: 'POST',
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(tweet),
        redirect: 'follow'
      })
      getTweet();
    };

    /* skapar en put req (edit req) */
    function putPost(id) {
      editTweetText = document.getElementById(id).innerText;
      editTweet = document.getElementById(id);
      editTweet.setAttribute("contenteditable", "true");
    }

    function updatePost(id) {
      newTweet = document.getElementById(id).innerText;
      author = currentUser;
      let tweet = {
        description : newTweet,
        author : author,
        date :  "Was updated at " + date.toLocaleDateString("en-SE", options), 
      };
      fetch(`http://localhost:8000/tweet/${id}`, {
        method: 'PUT',
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(tweet),
        redirect: 'follow'
      })
      getTweet();
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
        .then(res => res.json())
        .then(result => console.log("Tweet med id " + id + " togs bort!"))
        .catch(error => console.log('error', error));
        setTimeout(() => {
          location.reload(); 
        }, 500);
      };

    /* aktiverar våran getTweet funktion */
    getTweet();
    let thisUser = "";
    let currentUser = "<?php echo $firstName ?>";
    if (currentUser) { thisUser = currentUser } else { thisUser = "nobody"}
    console.log(thisUser);
  </script>
















    

</section>


<?php get_footer(); ?>
