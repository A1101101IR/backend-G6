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
            <button onClick="postTweet()" class="tweet-btn">Post</button>
        </div>
    </div>

    <!-- container för tweets som fylls på när man besöker sidan. -->
    <div class="tweets-container">
      <div id="post"></div>
    </div>


  <!-- våran script tag som innehåller samtliga funktioner. -->
  <script>
    /* Hämtar data coh skapa inlägg av data */
    async function getTweet() {
      let fetchedData = await fetch("http://localhost:8000/tweet", {
        method: 'GET',
        redirect: 'follow'
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
            <button class='btn-in-post edit' onClick='putPost(${tweet.id})'>Edit</button>
            <button class='btn-in-post edit' onClick='updatePost(${tweet.id})'>Update</button>
            <img onClick='deleteTweet(${tweet.id})' src="https://www.iconpacks.net/icons/1/free-trash-icon-347-thumb.png" alt="trash" class="trash-img">
            </div>
          </div>`
          if (currentUser == tweet.author) { FeaturesBtn = features } else { FeaturesBtn = ""}
          newTweet += `<div class="tweet-card-container" key={post.id}>  
              <div class="avatar ${tweet.author}"></div>
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
        redirect: 'follow'
      })
      getTweet();
    };




    
    function putPost(id) {
      /* editTweetText = document.getElementById(id).innerText;
      console.log(editTweetText); */


      /* hittar element som vi vill redigera och sätter två attrebiut i de */
      editTweet = document.getElementById(id);
      editTweet.setAttribute("contenteditable", "true");
      editTweet.setAttribute("class", "editable");

      /* hittar edit knappen och sätter en  */

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
        redirect: 'follow'
      })
      window.location.reload();
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
    



    /* kollar om det finns någon användare sparad i localStorage */
    /* Om det finns en, localUser är lika med namnet */
    /* Om det finns inte, LocalUser är lika med signInInput där användaren kan slå in sitt namn. */
    let localUser = "";
    let signInInput = `
    <div class="signInDiv">
    <input type="text" class="field" placeholder="Enter your username">
    </input><button onClick='SignIn()'>Sign in</button> </div>`;
    if (localStorage.getItem('user')) { localUser = localStorage.getItem('user') } else { localUser = signInInput } 




    /* Kollar om det finns ett WordpressUser som är inloggad */
    /* Om ja, currentUser är lika med WordpressUser */
    /* Om inte, currentUser är lika med LocalUser */
    let currentUser = "";
    let WordpressUser = "<?php echo $firstName ?>"
    let currentUserOutput = ""; 
    if (WordpressUser) {currentUser = WordpressUser} else {currentUser = localUser};




    /* skriver ut currentUser i vår FrontEnd */
    currentUserOutput += `${currentUser}<div></div>`
    document.getElementById('username').innerHTML = currentUserOutput;
    
    

    

    getTweet();
  </script>
</section>


<?php get_footer(); ?>
