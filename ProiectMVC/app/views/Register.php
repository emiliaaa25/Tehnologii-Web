<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <meta charset="UTF-8">
    <title>Register</title>
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
                <form action="#" method="get">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit" class="search-container">
                        <img src="http://localhost/ProiectMVC/public/pictures/search.png" alt="Search" style="width: 30px; height: 30px;">
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
        <div class="register-elements">
        <form action="/ProiectMVC/public/index.php?action=register" method="post">
            
        <h2>Register</h2>
            <div class="textbox">
                <label for="firstname">
                    <i class="fas fa-user"></i>
                </label>
                <input type="firstname" name="firstname" placeholder="First Name" id="firstname" required>
                <label for="lastname">
                    <i class="fas fa-user"></i>
                </label>
                <input type="lastname" name="lastname" placeholder="Last Name" id="lastname" required>
                <label for="email">
                    <i class="fas fa-envelope"></i>
                </label>
                <input type="email" name="email" placeholder="Email" id="email" required>
                <label for="username">
                    <i class="fas fa-user"></i>
                </label>
                <input type="username" name="username" placeholder="Username" id="username" required>
                <label for="password">
                    <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" required>
                <button class="button" type="submit-login">Register</button>
           
            </form>
            </div>
           <!--
           <form action="/ProiectMVC/public/index.php?action=register" method="post" method="post">
                <h2>Register</h2>
                <div class="textbox">
                    First name: <input type="text" placeholder="First Name" name="firstname" required>
                    Last name: <input type="text" placeholder="Last Name" name="lastname" required>
                    Email: <input type="email" placeholder="Email" name="email" required>
                    Username: <input type="text" placeholder="Username" name="username" required>
                    Password: <input type="password" placeholder="Password" name="password" required>
                </div>
                <button class="button" type="submit">Register</button>
            </form> -->
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
