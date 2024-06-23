<?php
require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/MovieController.php';

if (isset($_GET['title'])) {
    $movieName = urldecode($_GET['title']);
    $movieController = new MovieController();
    $movieJson = $movieController->getMovieDetailsFromTmdb(['title' => $movieName]); // Trimite un array cu numele filmului
    if ($movieJson === false) {
        echo "Failed to fetch movie details.";
    }

    $movieData = json_decode($movieJson, true);
    if ($movieData['status'] == 'success') {
        $movie = $movieData['movie']; // Atribuie datele filmului la variabila $movie
    } else {
        $error = $movieData['message'] ?? 'Movie not found.';
    }
} else {
    $error = 'No movie specified.';
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/movie.css">
    <meta charset="UTF-8">
    <title>Movie's Page</title>
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
        <div class="movie-container">
            <?php if (isset($movie)): ?>
                <div class="backdrop"
                    style="background-image: url('https://image.tmdb.org/t/p/original<?= htmlspecialchars($movie['backdrop_path']); ?>');">
                    <div class="backdrop-overlay">
                        <div class="movie-poster">
                            <img src="https://image.tmdb.org/t/p/w300<?= htmlspecialchars($movie['poster_path']); ?>"
                                alt="Movie Poster">
                        </div>
                        <div class="backdrop-info">
                            <div class="backdrop-title"><?= htmlspecialchars($movie['title']); ?>
                                (<?= htmlspecialchars(substr($movie['release_date'], 0, 4)); ?>)</div>
                            <div class="backdrop-details">
                                <p><?= htmlspecialchars($movie['release_date']); ?>
                                    (<?= htmlspecialchars(implode(', ', $movie['origin_country'])); ?>) ·
                                    <?= htmlspecialchars(implode(', ', $movie['genres'])); ?> ·
                                    <?= htmlspecialchars($movie['duration']); ?> minutes
                                </p>
                                <div class="button-group-round">
                                    <button class="round-button" onclick="addToFavorites()">❤</button>
                                    <button class="round-button" onclick="addToWatchList()">➕</button>
                                    <button class="round-button" onclick="watchTrailer()">▶</button>
                                </div>
                            </div>
                            <div class="overview">
                                <p><?= htmlspecialchars($movie['tagline']); ?></p>
                                <h2>Overview</h2>
                                <p><?= htmlspecialchars($movie['overview']); ?></p>
                                <h2>Credits</h2>
                            </div>
                            <div class="credits">
                                <div>
                                    <p class="role">Directors</p>
                                    <p class="role"><?= htmlspecialchars(implode(', ', $movie['director'])); ?></p>
                                </div>
                                <div>
                                    <p class="role">Writers</p>
                                    <p class="role"><?= htmlspecialchars(implode(', ', $movie['writer'])); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="error-message"><?= isset($error) ? htmlspecialchars($error) : 'No movie specified.'; ?></div>
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
            const movieData = <?php echo isset($movie) ? json_encode($movie) : 'null'; ?>;
            if (movieData) {
                displayCast({ movie: movieData });
            } else {
                const castContainer = document.getElementById('cast-container');
                castContainer.innerHTML = '<p>No movie specified.</p>';
            }
        });

        function displayCast(data) {
    const movie = data.movie;
    if (movie && movie.cast) {
        const castContainer = document.getElementById('cast-container');
        castContainer.innerHTML = ''; // Curăță containerul

        movie.cast.forEach(item => {
            const castItem = document.createElement('div');
            castItem.className = 'cast-item';

            // Construim link-ul către pagina actorului
            const actorPageUrl = `http://localhost/ProiectMVC/app/views/Actor.php?name=${encodeURIComponent(item.name)}`;

            // Adăugăm imaginea, numele și personajul actorului ca link
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
        console.error('Movie or cast data is undefined or empty:', movie);
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

            // Obține URL-ul trailerului din PHP (aici trebuie să aveți o logică pentru a obține cheia video corectă)
            const videoKey = '<?php echo isset($movie['video_key']) ? htmlspecialchars($movie['video_key']) : ''; ?>';
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
