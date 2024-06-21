<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <meta charset="UTF-8">
    <title>Actors</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
</head>
<body>
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
            <a href="#B">B</a>
            <a href="#C">C</a>
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
            <?php
require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/ActorController.php';

$actorController = new ActorController();
$actors = $actorController->getActorsStartingWith('A');

foreach ($actors as $actor) {
    $actorName = $actor['full_name'];
    $encodedName = urlencode($actorName);
    $actorJson = $actorController->getActorDetails(['name' => $actorName]);
    $actorData = json_decode($actorJson, true);

    if (isset($actorData['status']) && $actorData['status'] == 'success') {
        $actorDetails = $actorData['actor'];
        $imageUrl = $actorDetails['profile_path'] ?? 'http://localhost/ProiectMVC/public/pictures/default.png'; // default image if not found
        echo '<a href="http://localhost/ProiectMVC/app/views/Actor.php?name=' . $encodedName . '">';
        echo '<img src="' . htmlspecialchars($imageUrl) . '" title="' . htmlspecialchars($actorName) . '" alt="Picture of ' . htmlspecialchars($actorName) . '"></a>';
    } else {
        echo '<p>Error fetching details for ' . htmlspecialchars($actorName) . ': ' . ($actorData['message'] ?? 'Actor not found.') . '</p>';
    }
}
?>

            <h2 id="B">B</h2>
            <?php
            $actors = $actorController->getActorsStartingWith('B');
            foreach ($actors as $actor) {
                $encodedName = urlencode($actor['full_name']);
                echo '<a href="http://localhost/ProiectMVC/app/views/Actor.php?name=' . $encodedName . '">';
                echo '<img src="http://localhost/ProiectMVC/public/pictures/' . str_replace(' ', '_', $actor['full_name']) . '.png" title="' . htmlspecialchars($actor['full_name']) . '" alt="Picture of ' . htmlspecialchars($actor['full_name']) . '"></a>';
            }
            ?>
            <h2 id="C">C</h2>
            <?php
            $actors = $actorController->getActorsStartingWith('C');
            foreach ($actors as $actor) {
                $encodedName = urlencode($actor['full_name']);
                echo '<a href="http://localhost/ProiectMVC/app/views/Actor.php?name=' . $encodedName . '">';
                echo '<img src="http://localhost/ProiectMVC/public/pictures/' . str_replace(' ', '_', $actor['full_name']) . '.png" title="' . htmlspecialchars($actor['full_name']) . '" alt="Picture of ' . htmlspecialchars($actor['full_name']) . '"></a>';
            }
            ?>
            <!-- Repeat for other letters as needed -->
        </div>
    </div>
    <div class="footer"></div>
    <script>
        function toggleSearchBar() {
            var searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("show");
        }
    </script>
</body>
</html>
