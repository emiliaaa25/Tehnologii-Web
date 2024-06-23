<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Year</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/year.css">
</head>
<body>
<header>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'" class="search-barr">Years</button>
    </div>
    <div class="section-1">
        <div class="title">Actors Awards</div>
        <div class="button-group">
            <div class="search-container">
                <form action="http://localhost/ProiectMVC/app/views/Search.php" method="get">
                    <input type="text" name="query" placeholder="Search...">
                    <button type="submit">
                        <img src="http://localhost/ProiectMVC/public/pictures/search.png" alt="Search" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'">Home Page</button>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'">Actors</button>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'"><strong>Years</strong></button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <div class="left-section">
            <img src="http://localhost/ProiectMVC/public/pictures/imag2.png" alt="Award Image" class="background-image">
            <div class="text-overlay">
                <p class="performance-text">Outstanding Performance by a</p>
                <h1>CAST IN A MOTION PICTURE</h1>
                <a href="#" class="view-cast">View Cast</a>
            </div>
        </div>
        <div class="right-section">
            <h3>RECIPIENT</h3>
            <h2>SPOTLIGHT</h2>
            <ul>
                <li>BEASTS OF NO NATION</li>
                <li>THE BIG SHORT</li>
                <li class="recipient">
                    <img src="http://localhost/ProiectMVC/public/pictures/trophy.png" alt="Trophy" class="trophy">
                    <span>SPOTLIGHT</span>
                </li>
                <li>STRAIGHT OUTTA COMPTON</li>
                <li>TRUMBO</li>
            </ul>
        </div>
    </div>
</main>
</body>
</html>
