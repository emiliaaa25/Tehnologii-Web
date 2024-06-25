<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/years.css">
    <meta charset="UTF-8">
    <title>
        Years
    </title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
</head>

<body>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img
                src="http://localhost/ScreenActorAward/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/home'" class="search-barr">Home
            Page</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'"
            class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/years'"
            class="search-barr"><strong>Years</strong></button>
        <button
            onclick="window.location.href='http://localhost/ScreenActorAward/public/index.php?action=statistics&year=0'"
            class="search-barr">Statistics</button>
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
            <button class="button" onclick="window.location.href='http://localhost/ScreenActorAward/public/home'">Home
                Page</button>
            <button class="button"
                onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'">Actors</button>
            <button class="button"
                onclick="window.location.href='http://localhost/ScreenActorAward/public/years'"><strong>Years</strong></button>
            <button class="button"
                onclick="window.location.href='http://localhost/ScreenActorAward/public/index.php?action=statistics'">Statistics</button>
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
    <div class="ani-section1">
        <h1>WINNERS</h1>
        <div class="ani-poze-sec1">
            <?php
            require_once 'C:\xampp\htdocs\ScreenActorAward\app\controllers\YearController.php';

            $yearController = new YearController();

            $years = $yearController->getAllYears();

            foreach ($years as $year) {
                echo '<h2>' . $year['year'] . '</h2>';
                $picturePath = $_SERVER['DOCUMENT_ROOT'] . "/ScreenActorAward/public/pictures/{$year['year']}.png";
                if (file_exists($picturePath)) {
                    echo '<a href="http://localhost/ScreenActorAward/public/year/' . urlencode($year['year']) . '">';
                    echo '<img src="http://localhost/ScreenActorAward/public/pictures/' . $year['year'] . '.png" alt="">';
                    echo '</a>';
                } else {
                    echo '<a href="http://localhost/ScreenActorAward/public/year/' . urlencode($year['year']) . '">';
                    echo '<img src="http://localhost/ScreenActorAward/public/pictures/placeholder.png" alt="">';
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>
    <div class="footer">
    </div>
    <script>
        function toggleSearchBar() {
            var searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("show");
        }
    </script>
</body>

</html>