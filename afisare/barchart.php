<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart Example</title>
    <style>
        .download-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .download-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
// Setarea datelor (placeholder pentru baza de date)
$data = [
    'Jan' => 120,
    'Feb' => 80,
    'Mar' => 95,
    'Apr' => 100,
    'May' => 60,
    'Jun' => 70,
    'Jul' => 85,
    'Aug' => 110,
    'Sep' => 90,
    'Oct' => 95,
    'Nov' => 105,
    'Dec' => 130
];

// Setarea dimensiunilor graficului
$width = 600;
$height = 400;
$barWidth = 30;
$barSpacing = 10;
$maxValue = max($data);
$scale = ($height - 20) / $maxValue; // Scale pentru a ajusta înălțimea barelor la dimensiunea graficului

// Crearea SVG-ului
$svg = '<svg width="' . $width . '" height="' . $height . '" xmlns="http://www.w3.org/2000/svg">';
$x = 10; // Poziția inițială pe axa X

foreach ($data as $month => $value) {
    $barHeight = $value * $scale;
    $y = $height - $barHeight - 20; // Calcularea poziției Y
    $svg .= '<rect x="' . $x . '" y="' . $y . '" width="' . $barWidth . '" height="' . $barHeight . '" fill="blue" />';
    $svg .= '<text x="' . ($x + $barWidth / 2) . '" y="' . ($height - 5) . '" font-size="10" text-anchor="middle">' . $month . '</text>';
    $svg .= '<text x="' . ($x + $barWidth / 2) . '" y="' . ($y - 5) . '" font-size="10" text-anchor="middle">' . $value . '</text>';
    $x += $barWidth + $barSpacing;
}

$svg .= '</svg>';

// Salvarea fișierului SVG
file_put_contents('barchart.svg', $svg);
?>

<!-- Afișarea graficului SVG în pagină -->
<h2>Bar Chart in SVG</h2>
<div>
    <?php echo $svg; ?>
</div>

<!-- Buton pentru descărcarea SVG-ului -->
<h2>Download SVG</h2>
<div>
    <a href="barchart.svg" download="barchart.svg" class="download-button">Download Bar Chart as SVG</a>
</div>

</body>
</html>
