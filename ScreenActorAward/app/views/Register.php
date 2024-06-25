<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/register.css">
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
</head>

<body>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img
                src="http://localhost/ScreenActorAward/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/home'" class="search-barr">Home
            Page</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'"
            class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/years'"
            class="search-barr">Years</button>
        <?php
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
            echo '<button onclick="window.location.href=\'http://localhost/ScreenActorAward/public/login\'" class="search-barr">Login</button>';
        else
            echo '<button onclick="window.location.href=\'http://localhost/ScreenActorAward/public/admin\'" class="search-barr">Agmin Page</button>';
        ?>
    </div>


    <div class="section-1">
        <div class="title">Actors Awards</div>
        <div class="button-group">
            <div class="search-container">
                <form action="#" method="get">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit" class="search-container">
                        <img src="http://localhost/ScreenActorAward/public/pictures/search.png" alt="Search"
                            style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>
            <button class="button"
                onclick="window.location.href='http://localhost/ScreenActorAward/public/home'"><strong>HomePage</strong></button>
            <button class="button"
                onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'">Actors</button>
            <button class="button"
                onclick="window.location.href='http://localhost/ScreenActorAward/public/years'">Years</button>
            <?php
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
                echo '<button class="button" onclick="window.location.href=\'http://localhost/ScreenActorAward/public/login\'" class="search-barr">Login</button>';
            else
                echo '<button class="button" onclick="window.location.href=\'http://localhost/ScreenActorAward/public/admin\'" class="search-barr">Agmin Page</button>';
            ?>
            <button class="button border" onclick="toggleSearchBar()"><img
                    src="http://localhost/ScreenActorAward/public/pictures/3arrows.jpg" alt=""></button>
        </div>
    </div>
    <div class="login-box">
        <div class="register-elements">
            <form action="/ScreenActorAward/public/index.php?action=register" method="post">

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