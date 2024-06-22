<?php
require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/ActorController.php';

// Verificăm dacă parametrul 'name' există în query string
if (isset($_GET['name'])) {
    $actorName = urldecode($_GET['name']);

    // Creăm o instanță a controllerului Actor
    $actorController = new ActorController();

    // Apelăm metoda pentru a obține detalii despre actor
    $actorJson = $actorController->getActorDetails(['name' => $actorName]);

    // Verificăm dacă datele au fost preluate corect
    if ($actorJson === false) {
        echo "Failed to fetch actor details.";
        exit;
    }

    $actorData = json_decode($actorJson, true);

    // Verificăm dacă răspunsul este valid și conține date despre actor
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
        <button class="dismiss" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-btn">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-btn"><strong>Actors</strong></button>
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
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'"><strong>Actors</strong></button>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
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
        <?php elseif (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php else: ?>
            <p>No actor specified.</p>
        <?php endif; ?>
    </div>
</main>
<script src="http://localhost/ProiectMVC/public/js/actor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
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
</body>
</html>
