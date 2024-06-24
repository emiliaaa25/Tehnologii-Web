<?php
require_once 'C:/xampp/htdocs/ProiectMVC/app/controllers/YearController.php';
$yearRaw = isset($_GET['year']) ? $_GET['year'] : date('Y'); 
$yearRaw = substr($yearRaw, 0, 4);

if (isset($_GET['year'])) {
    $year = $_GET['year'];
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'movie';  // Default filter type: 'movie'
    $yearController = new YearController();

    // Fetch categories and nominees for the given year
    $yearJson = $yearController->getYearDetails(['year' => $year]);
    $yearData = json_decode($yearJson, true);
 // Filter nominees based on the selected filter
    if (!empty($yearData['year'])) {
        foreach ($yearData['year'] as $category => &$categoryData) {
            $categoryData['nominees'] = array_filter($categoryData['nominees'], function($nominee) use ($filter) {
                return $nominee['type'] === $filter;
            });
        }
        // Remove categories that have no nominees after filtering
        $yearData['year'] = array_filter($yearData['year'], function($categoryData) {
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
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/year.css">
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">
    <script>
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
        <button class="dissmis" onclick="toggleSearchBar()"><img src="arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'" class="search-barr"><strong>Years</strong></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/StatisticsByYear.php?year=<?php echo $yearRaw; ?>'" class="search-barr"><strong>Statistics</strong></button>
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
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/StatisticsByYear.php?year=<?php echo $yearRaw;?>'"><strong>Statistics</strong></button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
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
        background-color:  #B8860B;
        color: white;
        border: none;
        padding: 20px 20px;
        margin: 10px;
        cursor: pointer;
        width: 200px; /* Setează lățimea */
        height: 100px; /* Setează înălțimea */
        font-size: 18px; /* Mărește fontul */
        }

        .filter-buttons button:hover {
        background-color:  rgb(155, 137, 38);
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
                    <img id="image-<?php echo htmlspecialchars($category); ?>" src="<?php echo htmlspecialchars($categoryData['imageUrl']); ?>" alt="Award Image" class="background-image">
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
                                        <img src="http://localhost/ProiectMVC/public/pictures/trophy.png" alt="Trophy" class="trophy">
                                        <button class="winner" onclick="updateImage('<?php echo htmlspecialchars($category); ?>', '<?php echo htmlspecialchars($nominee['imageUrl']); ?>')">
                                            <?php echo htmlspecialchars($nominee['name']); ?> (<?php echo htmlspecialchars($nominee['type']); ?>)
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <button onclick="updateImage('<?php echo htmlspecialchars($category); ?>', '<?php echo htmlspecialchars($nominee['imageUrl']); ?>')">
                                        <?php echo htmlspecialchars($nominee['name']); ?> (<?php echo htmlspecialchars($nominee['type']); ?>)
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
