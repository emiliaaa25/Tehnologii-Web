<?php
require_once 'C:/xampp/htdocs/ScreenActorAward/app/controllers/YearController.php';
$yearRaw = isset($_GET['year']) ? $_GET['year'] : date('Y');
$yearRaw = substr($yearRaw, 0, 4);

if (isset($_GET['year'])) {
    $year = $_GET['year'];
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'movie'; 
    $yearController = new YearController();

    $yearJson = $yearController->getYearDetails(['year' => $year]);
    $yearData = json_decode($yearJson, true);
    if (!empty($yearData['year'])) {
        foreach ($yearData['year'] as $category => &$categoryData) {
            $categoryData['nominees'] = array_filter($categoryData['nominees'], function ($nominee) use ($filter) {
                return $nominee['type'] === $filter;
            });
        }
        $yearData['year'] = array_filter($yearData['year'], function ($categoryData) {
            return !empty($categoryData['nominees']);
        });
    }
} else {
    $error = 'No year specified.';
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <title>Year</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/year.css">
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/styles.css">
    <script>
        function toggleSearchBar() {
                var searchBar = document.getElementById("searchBar");
                searchBar.classList.toggle("show");
            }
        function updateImage(categoryId, nomineeImageUrl) {
            const imageElement = document.getElementById(`image-${categoryId}`);
            if (imageElement) {
                imageElement.src = nomineeImageUrl;
            }
        }
        function filterNominees(filter) {
            const year = "<?php echo $year; ?>";
            window.location.href = `?year=${year}&filter=${filter}`;
        }
    </script>
</head>
<header>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ScreenActorAward/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/home'" class="search-barr">Home
            Page</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/actors'"
            class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ScreenActorAward/public/years'"
            class="search-barr"><strong>Years</strong></button>
        <button
            onclick="window.location.href='http://localhost/ScreenActorAward/app/views/StatisticsByYear.php?year=<?php echo $yearRaw; ?>'"
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
                onclick="window.location.href='http://localhost/ScreenActorAward/app/views/StatisticsByYear.php?year=<?php echo $yearRaw; ?>'"><strong>Statistics</strong></button>
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
</header>
<main>
    <style>
        .filter-buttons {
            text-align: center;
            margin: 20px 0;
        }

        .filter-buttons button {
            background-color: #B8860B;
            color: white;
            border: none;
            padding: 20px 20px;
            margin: 10px;
            cursor: pointer;
            width: 200px;
            height: 100px;
            font-size: 18px;
        }

        .filter-buttons button:hover {
            background-color: rgb(155, 137, 38);
        }
    </style>
    <div class="filter-buttons">
        <button onclick="filterNominees('movie')">Movies</button>
        <button onclick="filterNominees('tv')">TV Shows</button>
        <button onclick="filterNominees('person')">Actors</button>
        <button onclick="filterNominees('diagrams')">Diagrams</button>

    </div>
    <?php if (isset($yearData) && !empty($yearData['year'])): ?>
        <?php $alignmentClass = 'left-aligned'; ?>
        <?php foreach ($yearData['year'] as $category => $categoryData): ?>
            <div class="container <?php echo $alignmentClass; ?>">
                <div class="left-section">
                    <img id="image-<?php echo htmlspecialchars($category); ?>"
                        src="<?php echo htmlspecialchars($categoryData['imageUrl']); ?>" alt="Award Image"
                        class="background-image">
                    <div class="text-overlay">
                        <p class="performance-text">Outstanding Performance by a</p>
                        <h1><?php echo htmlspecialchars($category); ?></h1>
                    </div>
                </div>
                <div class="right-section">
                    <ul>
                        <?php foreach ($categoryData['nominees'] as $nominee): ?>
                            <li>
                                <?php if ($nominee['name'] === $categoryData['winner']): ?>
                                    <div class="recipient">
                                        <img src="http://localhost/ScreenActorAward/public/pictures/trophy.png" alt="Trophy"
                                            class="trophy">
                                        <button class="winner"
                                            onclick="updateImage('<?php echo htmlspecialchars($category); ?>', '<?php echo htmlspecialchars($nominee['imageUrl']); ?>')">
                                            <?php echo htmlspecialchars($nominee['name']); ?>
                                            (<?php echo htmlspecialchars($nominee['type']); ?>)
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <button
                                        onclick="updateImage('<?php echo htmlspecialchars($category); ?>', '<?php echo htmlspecialchars($nominee['imageUrl']); ?>')">
                                        <?php echo htmlspecialchars($nominee['name']); ?>
                                        (<?php echo htmlspecialchars($nominee['type']); ?>)
                                    </button>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php $alignmentClass = ($alignmentClass === 'left-aligned') ? 'right-aligned' : 'left-aligned'; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No data available for the specified filter and year.</p>
    <?php endif; ?>
</main>
</body>

</html>