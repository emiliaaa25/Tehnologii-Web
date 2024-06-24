<?php
require_once 'C:/xampp/htdocs/ScreenActorAward/app/controllers/SearchController.php';

if (isset($_GET['query'])) {
    $query = urldecode($_GET['query']);
   
    $searchController = new SearchController();
    $searchJson = $searchController->getSearch(['query' => $query]);
    $searchData = json_decode($searchJson, true);
    if ($searchData['status'] == 'success') {
        $search = $searchData['search'];
    } else {
        $error = $searchData['message'] ?? 'Search not found.';
    }
} else {
    $error = 'No show ID specified.';
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/search.css">
    <meta charset="UTF-8">
    <title>tvShow's Page</title>
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
    <div class="container">
        <div class="filter-buttons">
            <button onclick="filterResults('movie')">Movies</button>
            <button onclick="filterResults('tv')">TV Shows</button>
            <button onclick="filterResults('person')">People</button>
        </div>
        <?php if (isset($search) && !empty($search)): ?>
            <h2>Results</h2>
            <div class="search-results">
                <?php foreach ($search as $result): ?>
                    <div class="search-result-item" data-type="<?= htmlspecialchars($result['media_type']); ?>">
                        <?php 
                            $detailLink = '#';
                            if ($result['media_type'] === 'movie') {
                                $detailLink = "http://localhost/ScreenActorAward/app/views/Movie.php?title=" . htmlspecialchars($result['title']);
                            } elseif ($result['media_type'] === 'tv') {
                                $detailLink = "http://localhost/ScreenActorAward/app/views/TvShow.php?title=" . htmlspecialchars($result['name']);
                            } elseif ($result['media_type'] === 'person') {
                                $detailLink = "http://localhost/ScreenActorAward/public/actor/" . htmlspecialchars($result['name']);
                            }
                        ?>
                        <a href="<?= $detailLink; ?>">
                            <?php if (isset($result['poster_path']) || isset($result['profile_path'])): ?>
                                <img src="https://image.tmdb.org/t/p/w185<?= htmlspecialchars($result['poster_path'] ?? $result['profile_path']); ?>" alt="<?= htmlspecialchars($result['name'] ?? $result['title']); ?>">
                            <?php else: ?>
                                <img src="http://localhost/ScreenActorAward/public/pictures/default-poster.jpg" alt="Default Poster">
                            <?php endif; ?>
                        </a>
                        <p><?= htmlspecialchars($result['name'] ?? $result['title']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</main>
    <script src="http://localhost/ScreenActorAward/public/js/search.js"></script>
</body>

</html>
