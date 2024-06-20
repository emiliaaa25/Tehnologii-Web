<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
<link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/actor.css">
<script src="http://localhost/ProiectMVC/public/js/actor.js"></script>

<meta charset="UTF-8">
    <title>Actor's Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    </head>
<body>
<header>
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
                        <img src="search.png" alt="Search" style="width: 30px; height: 30px;">
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
    <div class="actor">
        <div class="actor-image">
            <img id="actor-img" src="" alt="Actor Photo">
            <div class="personal-info">
                <p><strong>Birthday:</strong> <span id="actor-birthday"></span></p>
                <p><strong>Place of Birth:</strong> <span id="actor-place-of-birth"></span></p>
                <p><strong>Gender:</strong> <span id="actor-gender"></span></p>
            </div>
        </div>
        <div class="actor-info">
            <h1 id="actor-name">Actor Name</h1>
            <div class="biography-section">
                <p><strong>Biography:</strong> <span id="actor-biography"></span></p>
                <button id="show-more-btn" onclick="toggleBiography()">Show More</button>
            </div>
            <div class="known-for">
                <h3>Known For</h3>
                <div id="known-for-movies" class="movies-container">
                    <!-- Movies will be injected here by JavaScript -->
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
                <!-- Filmography will be injected here by JavaScript -->
            </div>
        </div>
    </div>
</main>
<script src="actor.js"></script>
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
</script>
</body>
</html>
