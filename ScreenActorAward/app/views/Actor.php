<?php
require_once 'C:/xampp/htdocs/ScreenActorAward/app/controllers/ActorController.php';

if (isset($_GET['name'])) {
    $actorName = urldecode($_GET['name']);
    $actorController = new ActorController();
    $actorJson = $actorController->getActorDetails(['name' => $actorName]);

    if ($actorJson === false) {
        echo "Failed to fetch actor details.";
        exit;
    }

    $actorData = json_decode($actorJson, true);
    if (isset($actorData['status']) && $actorData['status'] == 'success') {
        $actor = $actorData['actor'];
    } else {
        $error = $actorData['message'] ?? 'Actor not found.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/actor.css">
    <script src="http://localhost/ScreenActorAward/public/js/actor.js"></script>
    <script>
        function toggleSearchBar() {
            var searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("show");
        }
        document.addEventListener('DOMContentLoaded', function () {
            const actorData = <?php echo isset($actor) ? json_encode($actor) : 'null'; ?>;

            if (actorData) {
                displayKnownFor({ actor: actorData });
                displayFilmography({ actor: actorData });
            } else {
                document.getElementById('actor-details').innerHTML = '<p>No actor specified.</p>';
            }

            document.getElementById('production-type').addEventListener('change', filterFilmography);
        });

    </script>
    <meta charset="UTF-8">
    <title>Actor's Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
</head>

<body>
    <header>
        <div class="search-bar" id="searchBar">
            <button class="dismiss" onclick="toggleSearchBar()"><img
                    src="http://localhost/ScreenActorAward/public/pictures/arrow.png" alt=""></button>
            <button onclick="window.location.href='http://localhost/ScreenActorAward/public/home'"
                class="search-btn">Home Page</button>
            <button onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'"
                class="search-btn"><strong>Actors</strong></button>
            <button onclick="window.location.href='http://localhost/ScreenActorAward/public/years'"
                class="search-btn">Years</button>
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
                    <form action="http://localhost/ScreenActorAward/app/views/Search.php" method="get">
                        <input type="text" name="query" placeholder="Search...">
                        <button type="submit">
                            <img src="http://localhost/ScreenActorAward/public/pictures/search.png" alt="Search"
                                style="width: 30px; height: 30px;">
                        </button>
                    </form>
                </div>

                <button class="button"
                    onclick="window.location.href='http://localhost/ScreenActorAward/public/home'">Home
                    Page</button>
                <button class="button"
                    onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'"><strong>Actors</strong></button>
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
    </header>
    <main>
        <div id="actor-details">
            <?php if (isset($actor)): ?>
                <div class="actor">
                    <div class="actor-image">
                        <img id="actor-img" src="<?php echo htmlspecialchars($actor['profile_path']); ?>" alt="Actor Photo">
                        <div class="personal-info">
                            <p><strong>Birthday:</strong> <span
                                    id="actor-birthday"><?php echo htmlspecialchars($actor['birthday']); ?></span></p>
                            <p><strong>Place of Birth:</strong> <span
                                    id="actor-place-of-birth"><?php echo htmlspecialchars($actor['place_of_birth']); ?></span>
                            </p>
                            <p><strong>Gender:</strong> <span
                                    id="actor-gender"><?php echo htmlspecialchars($actor['gender']); ?></span></p>
                        </div>
                    </div>
                    <div class="actor-info">
                        <h1 id="actor-name"><?php echo htmlspecialchars($actor['name']); ?></h1>
                        <div class="biography-section">
                            <p><strong>Biography:</strong> <span
                                    id="actor-biography"><?php echo htmlspecialchars($actor['biography']); ?></span></p>
                            <button id="show-more-btn" onclick="toggleBiography()">Show More</button>
                        </div>
                        <div class="known-for">
                            <h3>Known For</h3>
                            <div id="known-for-movies" class="movies-container">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="filmography">
                    <div class="filter-options">
                        <select id="production-type" onchange="filterFilmography()">
                            <option value="all">All</option>
                            <option value="movie">Movies</option>
                            <option value="tv">TV Shows</option>
                        </select>
                    </div>
                    <div class="filmography-list">
                        <div id="filmography-container" class="filmography-container">
                        </div>
                    </div>
                </div>
                <div class="filmography">
                    <div class="filmography-list">
                        <div id="filmography-container" class="filmography-container">
                            <?php

                            $articles = $actorController->fetchNewsForActor($actorName);
                            echo '<div class="news-container">';
                            $ct = 1;
                            foreach ($articles as $article) {
                                if ($ct > 3)
                                    break;
                                $ct++;
                                echo '<div class="news-article">';
                                echo '<h2>' . $article['title'] . '</h2>';
                                echo '<p>' . $article['description'] . '</p>';
                                echo '<a href="' . $article['url'] . '" target="_blank">Read more</a>';
                                echo '</div>';
                            }
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
            <?php elseif (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php else: ?>
                <p>No actor specified.</p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>