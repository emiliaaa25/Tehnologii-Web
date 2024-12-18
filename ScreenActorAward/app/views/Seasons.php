<?php
require_once 'C:/xampp/htdocs/ScreenActorAward/app/controllers/TvShowController.php';

if (isset($_GET['show_id'])) {
    $id = urldecode($_GET['show_id']);

    $tvShowController = new TvShowController();
    $tvShowJson = $tvShowController->getAllSeasonsFromTmdb(['id' => $id]);
    $tvShowData = json_decode($tvShowJson, true);
    if ($tvShowData['status'] == 'success') {
        $seasons = $tvShowData['seasons'];
    } else {
        $error = $tvShowData['message'] ?? 'Seasons not found.';
    }
} else {
    $error = 'No show ID specified.';
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/seasons.css">
    <meta charset="UTF-8">
    <title>tvShow's Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
</head>

<body>
<header>
        <div class="search-bar" id="searchBar">
            <button class="dissmis" onclick="toggleSearchBar()"><img
                    src="http://localhost/ScreenActorAward/public/pictures/arrow.png" alt=""></button>
            <button onclick="window.location.href='http://localhost/ScreenActorAward/public/home'"
                class="search-barr">Home Page</button>
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
                    <form action="http://localhost/ScreenActorAward/app/views/Search.php" method="get">
                        <input type="text" name="query" placeholder="Search...">
                        <button type="submit">
                            <img src="http://localhost/ScreenActorAward/public/pictures/search.png" alt="Search"
                                style="width: 30px; height: 30px;">
                        </button>
                    </form>
                </div>
                <button class="button"
                    onclick="window.location.href='http://localhost/ScreenActorAward/public/home'">HomePage</button>
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
    </header>
    <main>
        <div class="container">
            <ul class="seasons-list">
                <?php if (isset($seasons) && !empty($seasons)): ?>
                    <?php foreach ($seasons as $season): ?>
                        <li class="season-item">
                            <div class="last-season-container">
                                <div class="season-poster">
                                    <a
                                        href="Episodes.php?show_id=<?= htmlspecialchars($id); ?>&season_number=<?= htmlspecialchars($season['season_number']); ?>">
                                        <img src="https://image.tmdb.org/t/p/w300<?= htmlspecialchars($season['poster_path']); ?>"
                                            alt="Season Poster">
                                    </a>
                                </div>
                                <div class="season-details">
                                    <?php if ($season['season_number'] == 0): ?>
                                        <h1>Special Episodes</h1>
                                        <p>Rating:⭐ <?= htmlspecialchars($season['vote_average']); ?> · Episodes:
                                            <?= htmlspecialchars($season['episode_count']); ?></p>
                                        <p><a href="Episodes.php?show_id=<?= htmlspecialchars($id); ?>&season_number=0">View Special
                                                Episodes</a></p>
                                    <?php else: ?>
                                        <p>
                                            <a
                                                href="Episodes.php?show_id=<?= htmlspecialchars($id); ?>&season_number=<?= htmlspecialchars($season['season_number']); ?>">
                                                Season <?= htmlspecialchars($season['season_number']); ?>
                                            </a>
                                        </p>
                                        <div class="season-stats">
                                            <p><?= htmlspecialchars($season['overview']); ?></p>
                                            <p>Rating:⭐ <?= htmlspecialchars($season['vote_average']); ?> ·
                                                <?= htmlspecialchars(substr($season['air_date'], 0, 4)); ?> · Episodes:
                                                <?= htmlspecialchars($season['episode_count']); ?></p>
                                            <p>Season <?= htmlspecialchars($season['season_number']); ?> premiered on
                                                <?= htmlspecialchars($season['air_date']) ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No seasons available.</p>
                <?php endif; ?>
            </ul>
        </div>
    </main>
    <script>
        function toggleSearchBar() {
            var searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("show");
        }
    </script>
</body>

</html>