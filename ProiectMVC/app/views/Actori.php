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
            <?php
            $initials = range('A', 'Z');
            foreach ($initials as $initial) {
                echo '<a href="#' . $initial . '">' . $initial . '</a>';
            }
            ?>
        </div>
        <div style="color: white; text-align: left;">
            <?php
            foreach ($initials as $initial) {
              require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/ActorController.php';

                $actorController = new ActorController();
                echo '<h2 id="' . $initial . '">' . $initial . '</h2>';
                $actors = $actorController->getActorsStartingWith($initial);
                
                foreach ($actors as $actor) {
                    $encodedName = urlencode($actor['full_name']);
                    $actorJson = $actorController->getActorPhotos(['name' => $actor['full_name']]);
                    $actorData = json_decode($actorJson, true);

                    if (isset($actorData['status']) && $actorData['status'] == 'success') {
                        $actorDetails = $actorData['actor'];
                        $imageUrl = $actorDetails['profile_path'] ?? 'http://localhost/ProiectMVC/public/pictures/default.png'; // default image if not found
                        echo '<a href="http://localhost/ProiectMVC/app/views/Actor.php?name=' . $encodedName . '">';
                        echo '<img src="' . htmlspecialchars($imageUrl) . '" title="' . htmlspecialchars($actor['full_name']) . '" alt="Picture of ' . htmlspecialchars($actor['full_name']) . '"></a>';
                    } else {
                        echo '<p>Error fetching details for ' . htmlspecialchars($actor['full_name']) . ': ' . ($actorData['message'] ?? 'Actor not found.') . '</p>';
                    }
                }
            }
            ?>
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
