<!DOCTYPE html>
<html lang="ro">
    <head>

        <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">

        <meta charset="UTF-8">
        <title>
            Actors
        </title>
        <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    </head>
    <body><!--tarile unde au fost nominalizarile / tabel ani/nominalizari/nominallizatul ales + tabele pe ani + ;-->
      <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-barr"><strong>Actors</strong></button>
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
                  <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'"><strong>Actors</strong></button>
                  <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
                <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
              </div>
        </div>
        <div class="actors">
          <p>MOST SEARCHED</p>
          <div>
            <img src="http://localhost/ProiectMVC/public/pictures/aw2023-best_actor_of_the_year.png" alt="best_actor_of_the_year">
            <img src="http://localhost/ProiectMVC/public/pictures/aw2023-best_actress_of_the_year.png" alt="best_actress_of_the_year">
            <img src="http://localhost/ProiectMVC/public/pictures/aw2023-best_duo_of_the_year.png" alt="best_duo_of_the_year">
            <img src="http://localhost/ProiectMVC/public/pictures/aw2023-special_jury_award.png" alt="special_jury_award">
            <img src="http://localhost/ProiectMVC/public/pictures/aw2023-outstanding-performance.png" alt="outstanding-performance">
            <img src="http://localhost/ProiectMVC/public/pictures/aw2023-breakthrough_duo_of_the_year.png" alt="breakthrough_duo_of_the_year">
          </div>
          <div>
            <a href="#A">A</a>
            <?php
            require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/ActorController.php';

            $actorController = new ActorController();
            $actors = $actorController->getActorsStartingWith('A');
            print_r($actors);
            if($actors != null){
              foreach ($actors as $actor) {
                echo "<p style='color:white; background-color: yellow;'>$actor</p>";
              }
            }
            ?>
            <a href="#B">B</a>
            <?php
            require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/ActorController.php';

            $actorController = new ActorController();
            $actors = $actorController->getActorsStartingWith('B');
            var_dump($actors);
            if($actors != null){
              foreach ($actors as $actor) {
                echo "<p style='color:white; background-color: yellow;'>$actor</p>";
              }
            }
            ?>
            <a href="#C">C</a>
            <?php
            require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/ActorController.php';


            $actorController = new ActorController();
            $actors = $actorController->getActorsStartingWith("C");
            var_dump($actors);
            if($actors != null){
              foreach ($actors as $actor) {
                echo "<p style='color:white; background-color: yellow;'>$actor</p>";
              }
            }
            ?>
            <a href="#D">D</a>
            <a href="#E">E</a>
            <a href="#F">F</a>
            <a href="#G">G</a>
            <a href="#H">H</a>
            <a href="#I">I</a>
            <a href="#J">J</a>
            <a href="#K">K</a>
            <a href="#L">L</a>
            <a href="#M">M</a>
            <a href="#N">N</a>
            <a href="#O">O</a>
            <a href="#P">P</a>
            <a href="#Q">Q</a>
            <a href="#R">R</a>
            <a href="#S">S</a>
            <a href="#T">T</a>
            <a href="#U">U</a>
            <a href="#V">V</a>
            <a href="#W">W</a>
            <a href="#X">X</a>
            <a href="#Y">Y</a>
            <a href="#Z">Z</a>
          </div>
          <div style="color: white; text-align: left;">
            <h2 id="A">A</h2>
              <p> 
                <a href="http://localhost/ProiectMVC/app/views/Actor.php"><img src="http://localhost/ProiectMVC/public/pictures/pozica.png" title="Andrei Aradits" alt="Picture with Andrei Aradits"></a>
                <img src="http://localhost/ProiectMVC/public/pictures/jennifer.png" title="Jennifer Aniston" alt="Picture with Jennifer Aniston">
              </p>
            <h2 id="B">B</h2>
            <h2 id="C">C</h2>
            <h2 id="D">D</h2>
            <h2 id="E">E</h2>
            <h2 id="F">F</h2>
            <h2 id="G">G</h2>
            <h2 id="H">H</h2>
            <h2 id="I">I</h2>
            <h2 id="J">J</h2>
            <h2 id="K">K</h2>
            <h2 id="L">L</h2>
            <h2 id="M">M</h2>
            <h2 id="N">N</h2>
            <h2 id="O">O</h2>
              <p>
                <img src ="http://localhost/ProiectMVC/public/pictures/jenna.png" title="Jenna Ortega">
              </p>
            <h2 id="P">P</h2>
            <h2 id="Q">Q</h2>
            <h2 id="R">R</h2>
            <h2 id="S">S</h2>
            <h2 id="T">T</h2>
            <h2 id="U">U</h2>
            <h2 id="V">V</h2>
            <h2 id="W">W</h2>
            <h2 id="X">X</h2>
            <h2 id="Y">Y</h2>
            <h2 id="Z">Z</h2>
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