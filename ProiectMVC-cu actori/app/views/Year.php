<!DOCTYPE html>
<html lang="ro">
    <head>

        <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">

        <meta charset="UTF-8">
        <title>
            Year
        </title>
        <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    </head>
<body>
<header>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="arrow.png" alt=""></button>
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
            
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'">Home Page</button>
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'">Actors</button>
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'"><strong>Years</strong></button>
              <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
          </div>
    </div>

    <div class ="section-2-year">
        <div>
            <h1>7th Annual Actors Awards 2023: The Winners</h1>
        </div>
        <div class="year-content">
            <div >
                <iframe width="560" height="315" src="https://www.youtube.com/embed/-RLJmx82mqk?si=wSKzcYjQ5CGrh9UC?autoplay=1&mute=1&loop=1&controls=0" title="YouTube video player" ></iframe>
                <p></p>
            </div>
            <div>
                <h3>WINNERS FROM YEAR 2023</h3>
                <a href="http://localhost/ProiectMVC/app/views/Actor.php"><img src="http://localhost/ProiectMVC/public/pictures/aw2023-best_actor_of_the_year.png" alt=""></a>
                <img src="http://localhost/ProiectMVC/public/pictures/aw2023-best_actress_of_the_year.png" alt="">
                <img src="http://localhost/ProiectMVC/public/pictures/aw2023-best_duo_of_the_year.png" alt="">
                <img src="http://localhost/ProiectMVC/public/pictures/aw2023-special_jury_award.png" alt="">
                <img src="http://localhost/ProiectMVC/public/pictures/aw2023-outstanding-performance.png" alt="">
                <img src="http://localhost/ProiectMVC/public/pictures/aw2023-breakthrough_duo_of_the_year.png" alt="">
            </div>
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
    
</header>
</body>
</html>