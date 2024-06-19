<!DOCTYPE html>
<html lang="ro">
    <head>

        <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">

        <meta charset="UTF-8">
        <title>
            Years
        </title>
        <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    </head>
    <body><!--tarile unde au fost nominalizarile / tabel ani/nominalizari/nominallizatul ales + tabele pe ani + ;-->
        <div class="search-bar" id="searchBar">
            <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
            <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-barr">Home Page</button>
            <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-barr">Actors</button>
            <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'" class="search-barr"><strong>Years</strong></button>
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
                <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'">Home Page</button>
                <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'">Actors</button>
                <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'"><strong>Years</strong></button>
                <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
              </div>
        </div>
        <div class="ani-section1">
            <h1>WINNERS</h1>
            <div class="ani-poze-sec1">
                <a href="http://localhost/ProiectMVC/app/views/Year.php"><img src="http://localhost/ProiectMVC/public/pictures/aw2023.png" alt=""></a>
                <a href="http://localhost/ProiectMVC/app/views/Year.php"><img src="http://localhost/ProiectMVC/public/pictures/aw2022.png" alt=""></a>
                <a href="http://localhost/ProiectMVC/app/views/Year.php"><img src="http://localhost/ProiectMVC/public/pictures/aw2021.png" alt=""></a>
                <a href="http://localhost/ProiectMVC/app/views/Year.php"><img src="http://localhost/ProiectMVC/public/pictures/aw2020.png" alt=""></a>
            </div>
        </div>
        <div class="footer">
        </div>
        <script>
            function toggleSearchBar() {
              var searchBar = document.getElementById("searchBar");
              searchBar.classList.toggle("show");
            }
            </script>
    </body>
</html>