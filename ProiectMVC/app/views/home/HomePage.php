<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/slideshow.css">
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
</head>
<body>
<header>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
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
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'"><strong>HomePage</strong></button>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'">Actors</button>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
        </div>
    </div>
    </header>
              <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag1.png" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag2.png" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag3.jpg" alt="Image 3">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag4.jpg" alt="Image 4">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag5.jpg" alt="Image 5">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag6.jpg" alt="Image 6">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag7.png" alt="Image 7">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag8.jpg" alt="Image 8">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag9.png" alt="Image 9">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag10.jpg" alt="Image 10">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag11.jpg" alt="Image 11">
                </div>
                <div class="carousel-item">
                    <img src="http://localhost/ProiectMVC/public/pictures/imag12.jpg" alt="Image 12">
                </div>
                
            </div>
            <a class="prev" onclick="moveSlides(-1)">&#10094;</a>
            <a class="next" onclick="moveSlides(1)">&#10095;</a>
        </div>
        
        <div class="footer">
        </div>

<script>
let slideIndex = 0; // Indexul curent al slide-ului, începând de la prima imagine

const itemsToShow = 3; // Numărul de imagini afișate simultan
const totalItems = document.querySelectorAll('.carousel-item').length-1;

function moveSlides(n) {
    slideIndex += n;
    
    // Verificăm dacă am trecut peste ultima imagine și ne întoarcem la prima
    if (slideIndex >= totalItems) {
        slideIndex = 0;
    }
    
    // Verificăm dacă am trecut înainte de prima imagine și ne ducem la ultima
    if (slideIndex < 0) {
        slideIndex = totalItems - 1;
    }
    
    showSlides();
}

function showSlides() {
    let offset = slideIndex * (100 / itemsToShow);
    
    // Ajustăm offset-ul pentru a centra ultima imagine în carusel
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
