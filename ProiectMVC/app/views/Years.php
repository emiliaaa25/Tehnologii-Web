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
                    <form action="http://localhost/ProiectMVC/app/views/Search.php" method="get">
                        <input type="text" name="query" placeholder="Search...">
                        <button type="submit">
                            <img src="http://localhost/ProiectMVC/public/pictures/search.png" alt="Search"
                                style="width: 30px; height: 30px;">
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
            <?php
            // Include the YearModel.php file
            require_once 'C:\xampp\htdocs\ProiectMVC\app\controllers\YearController.php';

            // Create an instance of the YearModel class
            $yearController = new YearController();

            // Get the values returned from YearModel.php
            $years = $yearController-> getAllYears();

            // Loop through the years and display them
            foreach ($years as $year) {
                echo '<h2>' . $year['year'] . '</h2>';
                $picturePath = $_SERVER['DOCUMENT_ROOT'] . "/ProiectMVC/public/pictures/{$year['year']}.png";
                if (file_exists($picturePath)) {
                    // The picture exists
                    echo '<a href="http://localhost/ProiectMVC/app/views/Year.php"><img src="http://localhost/ProiectMVC/public/pictures/' . $year['year'] . '.png" alt=""></a>';
                
                } else {
                    // The picture does not exist
                    echo '<a href="http://localhost/ProiectMVC/app/views/Year.php"><img src="http://localhost/ProiectMVC/public/pictures/placeholder.png" alt=""></a>';
                
                }
            }
        ?>
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