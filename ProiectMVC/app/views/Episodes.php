<?php
require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/TvShowController.php';

if (isset($_GET['show_id']) && isset($_GET['season_number'])) {
    $show_id = $_GET['show_id'];
    $season_number = $_GET['season_number'];
    
    $tvShowController = new TvShowController();
    
    $tvShowJson = $tvShowController->getEpisodes(['id' => $show_id, 'season_number' => $season_number]);

    $tvShowData = json_decode($tvShowJson, true);
    if ($tvShowData['status'] == 'success') {
        $seasons = $tvShowData['episodes'];
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
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/seasons.css">
    <meta charset="UTF-8">
    <title>tvShow's Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
</head>

<body>
    <header>
        <div class="search-bar" id="searchBar">
            <button class="dismiss" onclick="toggleSearchBar()"><img
                    src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
            <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'"
                class="search-btn">Home Page</button>
            <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'"
                class="search-btn"><strong>Actors</strong></button>
            <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'"
                class="search-btn">Years</button>
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
                <button class="button"
                    onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'">Home
                    Page</button>
                <button class="button"
                    onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'"><strong>Actors</strong></button>
                <button class="button"
                    onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
                <button class="button border" onclick="toggleSearchBar()"><img
                        src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <ul class="seasons-list">
                <?php if (isset($seasons) ): ?>
                    <?php foreach ($seasons as $episode): ?>
                        <li class="season-item">
                            <div class="last-season-container">
                                <div class="season-poster">
                                    <img src="https://image.tmdb.org/t/p/w300<?= htmlspecialchars($episode['still_path']); ?>"
                                        alt="Episode Still">
                                </div>
                                <div class="season-details">
                                    <div class="season-stats">
                                        <h1><?= htmlspecialchars($episode['name']); ?></h1>
                                        <p><?= htmlspecialchars($episode['overview']); ?></p>
                                        <p>Rating: ⭐ <?= htmlspecialchars($episode['vote_average']); ?></p>
                                        <p>Air Date: <?= htmlspecialchars($episode['air_date']); ?></p>
                                        <!-- Poți adăuga alte detalii despre episod aici -->
                                    </div>

                                    <div class="crew-guest-stars">
    <h2>Crew</h2>
    <div class="member-container">
        <?php foreach ($episode['crew'] ?? [] as $crewMember): ?>
            <div>
                <?php if ($crewMember['profile_path']): ?>
                    <a href="http://localhost/ProiectMVC/app/views/Actor.php?name=<?= isset($crewMember['name']) ? $crewMember['name']: '1' ?>">
                        <img src="https://image.tmdb.org/t/p/w185<?= htmlspecialchars($crewMember['profile_path']); ?>"
                            alt="<?= htmlspecialchars($crewMember['name']); ?>">
                    </a>
                <?php else: ?>
                    <a href="http://localhost/ProiectMVC/app/views/Actor.php?name=<?= isset($crewMember['name']) ? $crewMember['name']: '1' ?>">
                    <img src="http://localhost/ProiectMVC/public/pictures/default-profile.jpg"
                            alt="Profile Picture">
                    </a>
                <?php endif; ?>
                <div class="member-details">
                    <p><?= htmlspecialchars($crewMember['name']); ?></p>
                    <p><?= htmlspecialchars($crewMember['job']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Guest Stars</h2>
    <div class="member-container">
        <?php foreach ($episode['guest_stars'] ?? [] as $guestStar): ?>
            <div>
                <a href="http://localhost/ProiectMVC/app/views/Actor.php?name=<?= isset($guestStar['name']) ? $guestStar['name'] : '1' ?>">
                    <img src="https://image.tmdb.org/t/p/w185<?= htmlspecialchars($guestStar['profile_path']); ?>"
                        alt="<?= htmlspecialchars($guestStar['name']); ?>">
                </a>
                <div class="member-details">
                    <p><?= htmlspecialchars($guestStar['name']); ?></p>
                    <p><?= htmlspecialchars($guestStar['character']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No episodes available for this season.</p>
                <?php endif; ?>
            </ul>
        </div>
    </main>
</body>

</html>