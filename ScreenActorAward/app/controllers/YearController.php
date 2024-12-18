<?php
require_once ('C:\xampp\htdocs\ScreenActorAward\app\models\YearModel.php');

class YearController
{
    public function index()
    {
        require_once '../app/views/Years.php';
    }
    public function yearDetail($params)
    {
        if (!empty($params)) {
            $param = $params[0];
            $decodedParam = urldecode($param);
            $viewFilePath = '../app/views/Year.php';
            if (file_exists($viewFilePath)) {
                $_GET['year'] = $decodedParam;
                require_once $viewFilePath;
            } else {
                echo "View file not found.";
            }
        } else {
            echo "No year or category specified.";
        }
    }
    public function getAllYears()
    {
        $yearModel = new YearModel();
        $years = $yearModel->getAllYears();
        return $years;
    }

    public function getAllFromSpecificYear($params)
    {
        if (isset($params['year']) && !empty($params['year']) && is_string($params['year'])) {
            $year = $params['year'];
            $yearModel = new YearModel();
            $years = $yearModel->getAllFromSpecificYear($year);
            return json_encode($years);
        }
    }

    public function getYearDetails($params)
    {
        if (isset($params['year']) && !empty($params['year']) && is_string($params['year'])) {
            $year = $params['year'];
            $yearModel = new YearModel();
            $years = $yearModel->getCategoriesAndNomineesForYear($year);
            return json_encode($years);
        }
    }

    public function fetchImageUrl($name, $type)
    {

        if (isset($_GET['name']) && isset($_GET['type'])) {
            $name = $_GET['name'];
            $type = $_GET['type'];

            $yearController = new YearController();
            $imageUrl = $yearController->fetchImageUrl($name, $type);
            return json_encode(['imageUrl' => $imageUrl]);
        } else {
            return json_encode(['error' => 'Invalid parameters.']);
        }
    }


    public function getNominationsCount($year)
    {
        $yearModel = new YearModel();
        return $yearModel->getNominationsCount($year);
    }

    public function getYearData($year)
    {
        $yearModel = new YearModel();
        return $yearModel->getYearData($year);
    }

    public function exportScreenActorGuildAwardsToCSV()
    {
        $yearModel = new YearModel();
        $awards = $yearModel->fetchAllScreenActorGuildAwards();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=screen_actor_guild_awards.csv');

        $output = fopen('php://output', 'w');

        fputcsv($output, array('ID', 'Year', 'Category', 'Show', 'Full Name', 'Won'));

        foreach ($awards as $award) {
            fputcsv($output, $award);
        }

        fclose($output);
        exit();
    }

    public function getGenderStatistics()
    {
        $yearController = new YearModel();
        $genderStats = $yearController->getGenderStatistics();
        return ($genderStats);
    }


    public function generateBarChart()
    {
        $yearModel = new YearModel();
        $data = $yearModel->getNominationsData();

        $width = 1000;
        $height = 600;
        $barWidth = 30;
        $barSpacing = 20;
        $maxValue = max($data);
        $scale = ($height - 100) / $maxValue;

        $svg = '<svg width="' . $width . '" height="' . $height . '" xmlns="http://www.w3.org/2000/svg">';
        $x = 10;

        foreach ($data as $year => $value) {
            $barHeight = $value * $scale;
            $y = $height - $barHeight - 20;
            $svg .= '<rect x="' . $x . '" y="' . $y . '" width="' . $barWidth . '" height="' . $barHeight . '" fill="brown" />'; // Bars are brown
            $svg .= '<text x="' . ($x + $barWidth / 2) . '" y="' . ($height - 5) . '" font-size="12" text-anchor="middle" fill="gold">' . $year . '</text>'; // Year text in gold
            $svg .= '<text x="' . ($x + $barWidth / 2) . '" y="' . ($y - 5) . '" font-size="12" text-anchor="middle" fill="gold">' . $value . '</text>'; // Value text in gold
            $x += $barWidth + $barSpacing;
        }

        $svg .= '</svg>';

        file_put_contents('barchart.svg', $svg);
        return $svg;
    }


    public function generateBarChartByYear($gender_count)
    {
        $maleCount = $gender_count['Male'];
        $femaleCount = $gender_count['Female'];
        $showCount = $gender_count['Show'];

        $total = $maleCount + $femaleCount + $showCount;

        $maleHeight = ($maleCount / $total) * 100;
        $femaleHeight = ($femaleCount / $total) * 100;
        $showHeight = ($showCount / $total) * 100;

        $svgBar = '
            <svg width="300" height="200" viewBox="0 0 300 200" xmlns="http://www.w3.org/2000/svg">
                <style>
                    .bar { fill: goldenrod; }
                    .label { fill: goldenrod; font-family: Arial, sans-serif; font-size: 14px; }
                </style>
                <rect x="10" y="' . (200 - $maleHeight * 2) . '" width="80" height="' . ($maleHeight * 2) . '" class="bar"/>
                <text x="50" y="' . (190 - $maleHeight * 2) . '" text-anchor="middle" class="label">Male: ' . $maleCount . '</text>
                
                <rect x="110" y="' . (200 - $femaleHeight * 2) . '" width="80" height="' . ($femaleHeight * 2) . '" class="bar"/>
                <text x="150" y="' . (190 - $femaleHeight * 2) . '" text-anchor="middle" class="label">Female: ' . $femaleCount . '</text>
                
                <rect x="210" y="' . (200 - $showHeight * 2) . '" width="80" height="' . ($showHeight * 2) . '" class="bar"/>
                <text x="250" y="' . (190 - $showHeight * 2) . '" text-anchor="middle" class="label">Show: ' . $showCount . '</text>
            </svg>
        ';

        return $svgBar;
    }


    public function getGenderStatisticsByYear($year)
    {
        $yearModel = new YearModel();
        $genderStats = $yearModel->getGenderStatisticsByYear($year);
        return ($genderStats);
    }

    public function generatePieChartByYear($stats)
    {
        ob_start();
        $total = array_sum($stats);
        $angles = array_map(function ($count) use ($total) {
            return ($count / $total) * 2 * M_PI; }, $stats);
        $colors = ["#FFD700", "#8B4513", "#FFA500"];
        $startAngle = 0;

        echo '<svg width="400" height="400">';
        foreach ($angles as $i => $angle) {
            $endAngle = $startAngle + $angle;
            $x1 = 200 + 200 * cos($startAngle);
            $y1 = 200 + 200 * sin($startAngle);
            $x2 = 200 + 200 * cos($endAngle);
            $y2 = 200 + 200 * sin($endAngle);
            $largeArcFlag = $angle > M_PI ? 1 : 0;
            echo '<path d="M200,200 L' . $x1 . ',' . $y1 . ' A200,200 0 ' . $largeArcFlag . ',1 ' . $x2 . ',' . $y2 . ' Z" fill="' . $colors[$i] . '"></path>';
            $startAngle = $endAngle;
        }
        echo '</svg>';

        return ob_get_clean();
    }



}
