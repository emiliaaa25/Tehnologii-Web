<?php
if (isset($_GET['name'])) {
    $actorName = urldecode($_GET['name']);

    // Fetch actor details using $actorName
    require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/ActorController.php';
    $actorController = new ActorController();
    $actorJson = $actorController->getActorDetails(['name' => $actorName]);
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
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/actor.css">
    <meta charset="UTF-8">
    <title>Actor's Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
</head>
<body>
<header>
    <div class="search-bar" id="searchBar">
        <button class="dismiss" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt="Close"></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-btn">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-btn">Actors</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'" class="search-btn">Years</button>
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
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt="Toggle Search"></button>
        </div>
    </div>
</header>
<main>
    <?php if (isset($actor)): ?>
        <div class="actor">
            <div class="actor-image">
                <img id="actor-img" src="<?php echo htmlspecialchars($actor['profile_path']); ?>" alt="Actor Photo">
                <div class="personal-info">
                    <p><strong>Birthday:</strong> <span id="actor-birthday"><?php echo htmlspecialchars($actor['birthday']); ?></span></p>
                    <p><strong>Place of Birth:</strong> <span id="actor-place-of-birth"><?php echo htmlspecialchars($actor['place_of_birth']); ?></span></p>
                    <p><strong>Gender:</strong> <span id="actor-gender"><?php echo htmlspecialchars($actor['gender']); ?></span></p>
                </div>
            </div>
            <div class="actor-info">
                <h1 id="actor-name"><?php echo htmlspecialchars($actor['name']); ?></h1>
                <div class="biography-section">
                    <p><strong>Biography:</strong> <span id="actor-biography"><?php echo htmlspecialchars($actor['biography']); ?></span></p>
                    <button id="show-more-btn" onclick="toggleBiography()">Show More</button>
                </div>
                <div class="known-for">
                    <h3>Known For</h3>
                    <div id="known-for-movies" class="movies-container">
                        <?php foreach ($actor['known_for'] as $movie): ?>
                            <div class="movie">
                                <img src="<?php echo htmlspecialchars($movie['poster_path']); ?>" alt="Movie Poster">
                                <p><?php echo htmlspecialchars($movie['title']); ?></p>
                            </div>
                        <?php endforeach; ?>
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
                    <?php foreach ($actor['filmography'] as $item): ?>
                        <div class="filmography-item" data-type="<?php echo htmlspecialchars($item['media_type']); ?>">
                            <img src="<?php echo htmlspecialchars($item['poster_path']); ?>" alt="Poster">
                            <p><?php echo htmlspecialchars($item['title']); ?></p>
                            <p><?php echo htmlspecialchars($item['release_date']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php elseif (isset($error)): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php else: ?>
        <p>No actor specified.</p>
    <?php endif; ?>
</main>
<script src="http://localhost/ProiectMVC/public/js/actor.js"></script>
<script>
function toggleSearchBar() {
    var searchBar = document.getElementById("searchBar");
    searchBar.classList.toggle("show");
}

function toggleBiography() {
    const bio = document.getElementById('actor-biography');
    const btn = document.getElementById('show-more-btn');
    if (bio.classList.contains('show-more')) {
        bio.classList.remove('show-more');
        btn.innerText = 'Show More';
    } else {
        bio.classList.add('show-more');
        btn.innerText = 'Show Less';
    }
}

function filterFilmography() {
    const type = document.getElementById('production-type').value;
    const items = document.querySelectorAll('.filmography-item');
    items.forEach(item => {
        if (type === 'all' || item.getAttribute('data-type') === type) {
            item
