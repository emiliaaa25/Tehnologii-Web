<?php
require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/TvShowController.php';

if (isset($_GET['title'])) {
    $tvShowName = urldecode($_GET['title']);
    $tvShowController = new TvShowController();
    $tvShowJson = $tvShowController->gettvShowDetailsFromTmdb(['name' => $tvShowName]); 
    if ($tvShowJson === false) {
        echo "Failed to fetch tvShow details.";
    }
    $tvShowData = json_decode($tvShowJson, true);
    if ($tvShowData['status'] == 'success') {

        $tvShow = $tvShowData['tvShow'];
    } else {
        $error = $tvShowData['message'] ?? 'tvShow not found.';
    }
} else {
    $error = 'No tvShow specified.';
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/tvShow.css">
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
                    <form action="#" method="get">
                        <input type="text" name="search" placeholder="Search...">
                        <button type="submit" class="search-container">
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
        <div class="tvShow-container">
            <?php if (isset($tvShow)): ?>
                <div class="backdrop"
                    style="background-image: url('https://image.tmdb.org/t/p/original<?= htmlspecialchars($tvShow['backdrop_path']); ?>');">
                    <div class="backdrop-overlay">
                        <div class="tvShow-poster">
                            <img src="https://image.tmdb.org/t/p/w300<?= htmlspecialchars($tvShow['poster_path']); ?>"
                                alt="tvShow Poster">
                        </div>
                        <div class="backdrop-info">
                            <div class="backdrop-title"><?= htmlspecialchars($tvShow['name']); ?>
                                (<?= htmlspecialchars(substr($tvShow['first_air_date'], 0, 4)); ?>)</div>
                            <div class="backdrop-details">
                                <p><?= htmlspecialchars($tvShow['first_air_date']); ?>
                                    (<?= htmlspecialchars(implode(', ', $tvShow['origin_country'])); ?>) ·
                                    <?= htmlspecialchars(implode(', ', $tvShow['genres'])); ?> 
                                </p>
                                <div class="button-group-round">
                                    <button class="round-button" onclick="addToFavorites()">❤</button>
                                    <button class="round-button" onclick="addToWatchList()">➕</button>
                                    <button class="round-button" onclick="watchTrailer()">▶</button>
                                </div>
                            </div>
                            <div class="overview">
                                <p><?= htmlspecialchars($tvShow['tagline']); ?></p>
                                <h2>Overview</h2>
                                <p><?= htmlspecialchars($tvShow['overview']); ?></p>
                                <h2>Credits</h2>
                            </div>
                            <div class="credits">
                                <div>
                                    <p class="role">Producers</p>
                                    <p class="role"><?= htmlspecialchars(implode(', ', $tvShow['director'])); ?></p>
                                </div>
                                <div>
                                    <p class="role">Writers</p>
                                    <p class="role"><?= htmlspecialchars(implode(', ', $tvShow['writer'])); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="error-message"><?= isset($error) ? htmlspecialchars($error) : 'No tvShow specified.'; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            </div>
            <div class="cast">
            <div class="cast-list">
                    <div id="cast-container" class="cast-container">
                    </div>
                </div>
            </div>
          <h2>Last Season</h2>
            <div class="last-season-container">
    <div class="season-poster">
        <img src="https://image.tmdb.org/t/p/w300<?= htmlspecialchars($tvShow['last_season']['poster_path']); ?>"
             alt="Season Poster">
    </div>
    <div class="season-details">
        <p> Season <?= htmlspecialchars($tvShow['last_season']['season_number']); ?></p>
        <div class="season-stats">
            <p>Rating: ⭐<?= htmlspecialchars($tvShow['last_season']['vote_average'])?>/10</p>
            <p><?= htmlspecialchars(substr($tvShow['first_air_date'], 0, 4)); ?> · <?= htmlspecialchars($tvShow['last_season']['episode_count']); ?> Episodes</p>
            <p><?= htmlspecialchars($tvShow['last_season']['air_date']); ?></p>
            <p><?= htmlspecialchars($tvShow['last_season']['overview']); ?></p>
        </div>
        <a href="#" class="view-more">View All Seasons</a>
    </div>
</div>
            <div id="trailerModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeTrailerModal()">&times;</span>
                    <iframe id="trailerFrame" width="560" height="315" src="" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
       
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tvShowData = <?php echo isset($tvShow) ? json_encode($tvShow) : 'null'; ?>;
            console.log(tvShowData);
            if (tvShowData) {
                displayCast({ tvShow: tvShowData });
            } else {
                const castContainer = document.getElementById('cast-container');
                castContainer.innerHTML = '<p>No tvShow specified.</p>';
            }
        });

        function displayCast(data) {
    const tvShow = data.tvShow;
    if (tvShow && tvShow.cast) {
        const castContainer = document.getElementById('cast-container');
        castContainer.innerHTML = '';

        tvShow.cast.forEach(item => {
            const castItem = document.createElement('div');
            castItem.className = 'cast-item';
            const actorPageUrl = `http://localhost/ProiectMVC/app/views/Actor.php?name=${encodeURIComponent(item.name)}`;
            castItem.innerHTML = `
                <a href="${actorPageUrl}">
                            <img src="${item.profile_path ? `https://image.tmdb.org/t/p/w185${item.profile_path}` : 'http://localhost/ProiectMVC/public/pictures/default.jpg'}" alt="${item.name} Poster">
                    <p>${item.name}</p>
                    <p>${item.character}</p>
                </a>
            `;
            castContainer.appendChild(castItem);
        });
    } else {
        console.error('tvShow or cast data is undefined or empty:', tvShow);
    }
}



        function addToFavorites() {
            alert('Added to favorites!');
            // Adăugați aici funcționalitatea pentru a adăuga la favorite
        }

        function addToWatchList() {
            alert('Added to watch list!');
            // Adăugați aici funcționalitatea pentru a adăuga la watch list
        }

        function watchTrailer() {
            const trailerModal = document.getElementById('trailerModal');
            const trailerFrame = document.getElementById('trailerFrame');
            const videoKey = '<?php echo isset($tvShow['video_key']) ? htmlspecialchars($tvShow['video_key']) : ''; ?>';
            if (videoKey) {
                trailerFrame.src = `https://www.youtube.com/embed/${videoKey}?autoplay=1`;
                trailerModal.style.display = 'block';
           
            } else {
                alert('Sorry, no trailer available.');
            }
        }

        function closeTrailerModal() {
            const trailerModal = document.getElementById('trailerModal');
            const trailerFrame = document.getElementById('trailerFrame');

            trailerFrame.src = '';
            trailerModal.style.display = 'none';
        }
    </script>
</body>

</html>
