<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/actors.css">
    <meta charset="UTF-8">
    <title>Actors</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
</head>

<body>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img
                src="http://localhost/ScreenActorAward/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/home'"
            class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'"
            class="search-barr"><strong>Actors</strong></button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/years'"
            class="search-barr">Years</button>
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
    <div class="actors">
        <div style="color: white; text-align: left;">
            <?php
            require_once 'C:/xampp/htdocs/ScreenActorAward/app/controllers/ActorController.php';
            $actorController = new ActorController();

            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $pageSize = 21;
            $totalActors = $actorController->getTotalActors();
            $totalPages = ceil($totalActors / $pageSize);

            $actors = $actorController->getActorsPaginated($page, $pageSize);

            foreach ($actors as $actor) {
                $encodedName = urlencode($actor['full_name']);
                $actorJson = $actorController->getActorPhotos(['name' => $actor['full_name']]);
                $actorData = json_decode($actorJson, true);

                if (isset($actorData['status']) && $actorData['status'] == 'success') {
                    $actorDetails = $actorData['actor'];
                    $imageUrl = $actorDetails['profile_path'] ?? 'http://localhost/ScreenActorAward/public/pictures/default.png'; // default image if not found
                    echo '<a href="http://localhost/ScreenActorAward/public/actor/' . $encodedName . '">';
                    echo '<img src="' . htmlspecialchars($imageUrl) . '" title="' . htmlspecialchars($actor['full_name']) . '" alt="Picture of ' . htmlspecialchars($actor['full_name']) . '"></a>';
                } else {
                    continue;
                }
            }
            ?>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" <?php if ($i == $page)
                       echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer"></div>
    <script>
        function toggleSearchBar() {
            var searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("show");
        }
    </script>
</body>

</html>