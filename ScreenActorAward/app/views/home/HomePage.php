<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/slideshow.css">
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
</head>
<body>
<header>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ScreenActorAward/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/home'" class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'" class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/years'" class="search-barr">Years</button>
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
                        <img src="http://localhost/ScreenActorAward/public/pictures/search.png" alt="Search" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>
            <button class="button" onclick="window.location.href='http://localhost/ScreenActorAward/public/home'"><strong>HomePage</strong></button>
            <button class="button" onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'">Actors</button>
            <button class="button" onclick="window.location.href='http://localhost/ScreenActorAward/public/years'">Years</button>
            <?php 
                if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
                    echo '<button class="button" onclick="window.location.href=\'http://localhost/ScreenActorAward/public/login\'" class="search-barr">Login</button>';
                else 
                    echo '<button class="button" onclick="window.location.href=\'http://localhost/ScreenActorAward/public/admin\'" class="search-barr">Agmin Page</button>';
            ?>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ScreenActorAward/public/pictures/3arrows.jpg" alt=""></button>
        </div>
    </div>
    </header>
    <body>
              <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag1.png" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag2.png" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag3.jpg" alt="Image 3">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag4.jpg" alt="Image 4">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag5.jpg" alt="Image 5">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag6.jpg" alt="Image 6">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag7.png" alt="Image 7">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag8.jpg" alt="Image 8">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag9.png" alt="Image 9">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag10.jpg" alt="Image 10">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag11.jpg" alt="Image 11">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ScreenActorAward/public/pictures/imag12.jpg" alt="Image 12">
                </div>

            </div>
            <a class="prev" onclick="moveSlides(-1)">&#10094;</a>
            <a class="next" onclick="moveSlides(1)">&#10095;</a>
        </div>
        <div class="center-button">
        <button-year onclick="window.location.href='http://localhost/ScreenActorAward/public/years'" class="button">Go to Years</button>
        </div>
        <div class="footer">
        </div>

<script>
let slideIndex = 0; 

const itemsToShow = 3; 
const totalItems = document.querySelectorAll('.carousel-item').length-1;

function moveSlides(n) {
    slideIndex += n;

    if (slideIndex >= totalItems) {
        slideIndex = 0;
    }

    if (slideIndex < 0) {
        slideIndex = totalItems - 1;
    }

    showSlides();
}

function showSlides() {
    let offset = slideIndex * (100 / itemsToShow);

    if (slideIndex + itemsToShow > totalItems) {
        offset = (totalItems - itemsToShow) * (100 / itemsToShow);
    }

    document.querySelector('.carousel-inner').style.transform = `translateX(-${offset}%)`;
}

showSlides();

function toggleSearchBar() {
    var searchBar = document.getElementById("searchBar");
    searchBar.classList.toggle("show");
}

</script>
</body>
</html>