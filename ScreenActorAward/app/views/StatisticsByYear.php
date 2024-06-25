<?php
require_once 'C:/xampp/htdocs/ScreenActorAward/app/controllers/YearController.php';

if (!isset($_GET['year']) || !is_numeric($_GET['year'])) {
    die('Invalid year provided.');
}

$year = intval($_GET['year']);
$yearController = new YearController();
$yearData = $yearController->getAllFromSpecificYear($year);
$genderStatistics = $yearController->getGenderStatisticsByYear($year);

$gender_count = [
    "Male" => intval($genderStatistics['Male'] ?? 0),
    "Female" => intval($genderStatistics['Female'] ?? 0),
    "Show" => intval($genderStatistics['Show'] ?? 0)
];

$svgBar = $yearController->generateBarChartByYear($gender_count);
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <link rel="stylesheet" href="http://localhost/ScreenActorAward/public/css/admin.css">
    <meta charset="UTF-8">
    <title>Statistics for Year <?php echo $year; ?></title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ScreenActorAward/public/pictures/icon.jpg">
    <style>
    </style>
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
                onclick="window.location.href='http://localhost/ScreenActorAward/public/years'"><strong>Years</button>
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

    <br>
    <br>
    <div class="chart-container">
        <h2>Gender distribution of nominees for <?php echo $year; ?></h2>
        <svg id="pieChart" width="400" height="400"></svg>
        <button class="download-button" onclick="downloadWEBP()">Download WEBP</button>
        <div id="legend" class="legend-text" style="margin-top: 20px;">
            <div><span style="color: #FFD700;">&#9632;</span> Male: <?php echo $gender_count['Male']; ?></div>
            <div><span style="color: #8B4513;">&#9632;</span> Female: <?php echo $gender_count['Female']; ?></div>
            <div><span style="color: #FFA500;">&#9632;</span> Show: <?php echo $gender_count['Show']; ?></div>
        </div>
    </div>

    <div class="bar-chart-container">
        <h2>Distribution of nominations for <?php echo $year; ?></h2>
        <div id="barChartContainer">
            <?php echo $svgBar; ?>
        </div>
        <button id="downloadBarChartBtn" class="download-button download-button2">Download Bar Chart as SVG</button>
    </div>

    <div class="user-table">
        <h2 class="legend-text">Nominees for <?php echo $year; ?></h2>
        <div class="pagination-controls">
            <button id="prevAwards">Previous</button>
            <button id="exportAwards">Export to CSV</button>
            <button id="nextAwards">Next</button>
        </div>
        <div class="scrollable-table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Show</th>
                        <th>Full Name</th>
                        <th>Won</th>
                    </tr>
                </thead>
                <tbody id="awardsTableBody">

                </tbody>
            </table>
        </div>
    </div>

    <script>
        let year = <?php echo $year; ?>;
        console.log("Year:", year);
        let userPage = 1;
        let awardPage = 1;
        const pageSize = 10;

        var genderCount = <?php echo json_encode(array_values($gender_count)); ?>;
        var svg = document.getElementById("pieChart");
        var total = genderCount.reduce((acc, count) => acc + count, 0);
        var angles = genderCount.map(count => (count / total) * 2 * Math.PI);

        var colors = ["#FFD700", "#8B4513", "#FFA500"];
        var startAngle = 0;
        function toggleSearchBar() {
            var searchBar = document.getElementById("searchBar");
            searchBar.classList.toggle("show");
        }

        for (var i = 0; i < angles.length; i++) {
            var endAngle = startAngle + angles[i];
            var x1 = 200 + 200 * Math.cos(startAngle);
            var y1 = 200 + 200 * Math.sin(startAngle);
            var x2 = 200 + 200 * Math.cos(endAngle);
            var y2 = 200 + 200 * Math.sin(endAngle);

            var largeArcFlag = angles[i] > Math.PI ? 1 : 0;
            var pathData = [
                "M", 200, 200,
                "L", x1, y1,
                "A", 200, 200, 0, largeArcFlag, 1, x2, y2,
                "Z"
            ].join(" ");

            var path = document.createElementNS("http://www.w3.org/2000/svg", "path");
            path.setAttribute("d", pathData);
            path.setAttribute("fill", colors[i]);
            svg.appendChild(path);

            startAngle = endAngle;
        }

        function downloadWEBP() {
            var svgData = new XMLSerializer().serializeToString(svg);
            var canvas = document.createElement("canvas");
            var ctx = canvas.getContext("2d");
            var img = new Image();
            var svgBlob = new Blob([svgData], { type: "image/svg+xml;charset=utf-8" });
            var url = URL.createObjectURL(svgBlob);

            img.onload = function () {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                canvas.toBlob(function (blob) {
                    var url = URL.createObjectURL(blob);
                    var downloadLink = document.createElement("a");
                    downloadLink.href = url;
                    downloadLink.download = "pie_chart.webp";
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                }, "image/webp");
            };

            img.src = url;
        }

        function downloadSVG(svgContent, filename) {
            var svgBlob = new Blob([svgContent], { type: 'image/svg+xml;charset=utf-8' });
            var url = URL.createObjectURL(svgBlob);
            var downloadLink = document.createElement("a");
            downloadLink.href = url;
            downloadLink.download = filename;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }

        document.getElementById('downloadBarChartBtn').addEventListener('click', () => {
            var svgElement = document.getElementById('barChartContainer').innerHTML;
            downloadSVG(svgElement, 'barchart.svg');
        });

        function loadAwards() {
            console.log("Loading awards, page:", awardPage);
            fetch(`http://localhost/ScreenActorAward/public/index.php?action=getAwardsByYear&year=${year}&page=${awardPage}&pageSize=${pageSize}`)
                .then(response => response.text())
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        const awardsTableBody = document.getElementById('awardsTableBody');
                        awardsTableBody.innerHTML = '';
                        data.awards.forEach(award => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${award.id}</td>
                                <td>${award.year}</td>
                                <td>${award.category}</td>
                                <td>${award.show}</td>
                                <td>${award.full_name}</td>
                                <td>${award.won}</td>
                            `;
                            awardsTableBody.appendChild(row);
                        });
                        document.getElementById('prevAwards').disabled = awardPage <= 1;
                        document.getElementById('nextAwards').disabled = data.awards.length < pageSize;
                    } catch (error) {
                        console.error('Error parsing JSON:', error, text);
                    }
                })
                .catch(error => console.error('Error loading awards:', error));
        }

        document.getElementById('prevAwards').addEventListener('click', () => {
            if (awardPage > 1) {
                awardPage--;
                loadAwards();
            }
        });

        document.getElementById('nextAwards').addEventListener('click', () => {
            awardPage++;
            loadAwards();
        });

        document.getElementById('exportAwards').addEventListener('click', () => {
            window.location.href = 'http://localhost/ScreenActorAward/public/index.php?action=exportAwards';
        });

        loadAwards();
    </script>
</body>

</html>