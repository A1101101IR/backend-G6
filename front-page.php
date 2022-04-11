<?php get_header(); ?>
<?php $user = get_current_user_id(); $userdata = get_userdata($user); $firstName = $userdata->first_name; ?>
<section class="main-content-container">
    <!-- Vi hämtar user id, sedan hämtar userdata, hämtar user firstName -->
    <div class="text-area-container">
        <div class="login-header">
            <!-- <div class="login-avatar"></div> -->
        </div>
        <div class="submit-body">
            <!-- Textarea för att skicka data vid post req. -->
            <textarea name="description" id="description" maxlength="240" rows="8" cols="80"></textarea>
            <button onClick="postTweet()" class="big-btns">Post</button>
        </div>
    </div>

    <!-- container för tweets som fylls på när man besöker sidan. -->
    <div class="tweets-container">
      <div id="post"></div>
    </div>


  <!-- våran script tag som innehåller samtliga funktioner. -->
  <script>
    /* Hämtar data coh skapar inlägg av data */
    async function getTweet() {
      let fetchedData = await fetch("http://localhost:8000/tweet", {
        method: 'GET',
      });
      let tweetData = await fetchedData.json();
      let newTweet = "";
      let FeaturesBtn = "";
      if (tweetData) {
        tweetData.reverse().map((tweet) => {
          features = `
          <div class="btn-container-post">
            <div></div>
            <div class="btn-div">
            <button class='btn-in-post edit' id='editBtn' onClick='putPost(${tweet.id})'>Edit</button>
            <button class='btn-in-post edit' id='updateBtn' onClick='updatePost(${tweet.id})'>Update</button>
            <button class='btn-in-post delete' id='deleteBtn' onClick='deleteTweet(${tweet.id})'>Delete</button>
            </div>
          </div>`
          if (currentUser == tweet.author) { FeaturesBtn = features } else { FeaturesBtn = ""}
          newTweet += `<div class="tweet-card-container" key={post.id}>  
              <span class="avatar ${tweet.author}"></span>
              <div class="tweet-text-div">
                <div class="postInfo">
                  <p>@${tweet.author}</p>
                  <p>${tweet.date}</p>
                </div>
                <div class="tweet-text" id=${tweet.id}>${tweet.description}</div>
                <div>
                ${FeaturesBtn}
                </div>
              </div>
          </div>`
        })
      }
      document.getElementById('post').innerHTML = newTweet;
    }



    /* genererar den aktuella datum och tid som i inställd i användarens dator. */
    let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    let date = new Date(Date.now());
    
    



    /* Skapar nya inlägg och skickar till databasen */
    async function postTweet() {
      description = document.getElementById('description').value;
      author = currentUser;
      if (currentUser == signInInput) {
        alert('Entre a username');
        return; 
      }
      if(description.length == 0) {
        alert('You cannot post an empty tweet!');
        return; 
      }
      let tweet = {
        description : description,
        author : author,
        date :  date.toLocaleDateString("en-SE", options), 
      };
      await fetch("http://localhost:8000/tweet/", {
        method: 'POST',
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(tweet),
      })
      document.getElementById('description').value = '';
      getTweet();
    };





    function putPost(id) {
      /* hittar element som vi vill redigera och sätter två attrebiut i de */
      editTweet = document.getElementById(id);
      editTweet.setAttribute("contenteditable", "true");
      editTweet.setAttribute("class", "editable");
      editBtn = document.getElementById('editBtn');
      editBtn.setAttribute("style", "display:none");
      updateBtn = document.getElementById('updateBtn');
      updateBtn.setAttribute("style", "display:block");
    }
    


    async function updatePost(id) {
      newTweet = document.getElementById(id).innerText;
      author = currentUser;
      let tweet = {
        description : newTweet,
        author : author,
        date :  "Was updated at " + date.toLocaleDateString("en-SE", options), 
      };
      await fetch(`http://localhost:8000/tweet/${id}`, {
        method: 'PUT',
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(tweet),
      })
      window.location.reload();
    }





    /* tar bort inlägg och gör en reload på sidan för att uppdatera output */
    function deleteTweet(id) {
      var requestOptions = {
        method: 'DELETE',
      };
      fetch(`http://localhost:8000/tweet/${id}`, requestOptions)
        .then(res => res.json())
        .then(result => console.log("Tweet med id " + id + " togs bort!"))
        .catch(error => console.log('error', error));
        setTimeout(() => {
          location.reload(); 
        }, 500);
      };

    
    


    /* function för SignIn */
    function SignIn(){
      let input = document.querySelector('.field');
      localStorage.setItem("user", input.value);
      window.location.reload();
    }
    

    let signInInput = `
    <div class="signInDiv">
    <input type="text" class="field" placeholder="Enter your username">
    </input><button class="big-btns" onClick='SignIn()'>Sign in</button> </div>`;

    let WordpressUser = "<?php echo $firstName ?>"
    let localUser = localStorage.getItem('user')


    /* If there is any WordpressUser, currentUser = WordpressUser */
    /* else if there is any localUser, currentUser = WordpressUser */
    /* else currentUser = signInInput */
    
    if (WordpressUser) {
      currentUser = WordpressUser
    } else if (localUser) {
      currentUser = localUser
    } else { 
      currentUser = signInInput 
    };


    /* skriver ut currentUser i vår FrontEnd */
    let currentUserOutput = ` ${currentUser}<div></div>`
    document.getElementById('username').innerHTML = currentUserOutput;
    
    getTweet();
  </script>
</section>


<?php get_footer(); ?>
