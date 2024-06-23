<!DOCTYPE html>
<html lang="ro">
    <head>

        <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">

        <meta charset="UTF-8">
        <title>
            Home Page
        </title>
        <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    </head>
<body>
  <div class="search-bar" id="searchBar">
    <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'" class="search-barr">Years</button>
</div>

    <div class="section-1">
    <div class="title">Actors Awards</div>
        <div class="button-group">
        <div class="search-container">
                    <form action="http://localhost/ProiectMVC/app/views/Search.php" method="get">
                        <input type="text" name="query" placeholder="Search...">
                        <button type="submit">
                            <img src="http://localhost/ProiectMVC/public/pictures/search.png" alt="Search"
                                style="width: 30px; height: 30px;">
                        </button>
                    </form>
                </div> 
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'"><strong>HomePage</strong></button>
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'">Actors</button>
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
           </div>
    </div>
    <div class="login-box">
        <div class="login-elements">
            <form action="" method="get"> 
                <h2>Login</h2>
                <div class="textbox">
                    <input type="username" placeholder="Username" name="username" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" id="password" name="password" required>
                    <!-- An element to toggle between password visibility -->
                    <p> <input type="checkbox" onclick="myFunction()">Show Password</p>
                </div>
                <a class="forgot-password" href="">Forgot password?</a>
                <button class="button" type="submit-login">Login</button>
            </form>
        </div>
    </div>

  <script>
  function toggleSearchBar() {
    var searchBar = document.getElementById("searchBar");
    searchBar.classList.toggle("show");
  }
  function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "password-reveal";
  } else {
    x.type = "password";
  }
}
  </script>

</body>
</html>