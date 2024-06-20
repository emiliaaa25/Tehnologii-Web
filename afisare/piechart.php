<?php
// Date simulate
$data = [
    ["ID" => 1, "Name" => "John Doe", "Email" => "john@example.com", "Sex" => "Male"],
    ["ID" => 2, "Name" => "Jane Smith", "Email" => "jane@example.com", "Sex" => "Female"],
    ["ID" => 3, "Name" => "Sam Brown", "Email" => "sam@example.com", "Sex" => "Male"]
];

// Contorizarea femeilor și bărbaților
$gender_count = ["Male" => 0, "Female" => 0];
foreach ($data as $person) {
    $gender_count[$person["Sex"]]++;
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afișare Pie Chart</title>
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
    <!-- Afișarea Pie Chart SVG -->
    <h3>Distribuția de gen</h3>
    <svg id="pieChart" width="400" height="400"></svg>
    <button class="download-button" onclick="downloadWEBP()">Download WEBP</button>

    <script>
        // Obține contorizarea genurilor din PHP
        var genderCount = <?php echo json_encode(array_values($gender_count)); ?>;
        var svg = document.getElementById("pieChart");
        var total = genderCount.reduce((acc, count) => acc + count, 0);
        var angles = genderCount.map(count => (count / total) * 2 * Math.PI);

        var colors = ["#FF6384", "#36A2EB"];
        var labels = ["Male", "Female"];
        var startAngle = 0;

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

        // Adaugă legenda în SVG
        var legend = document.createElementNS("http://www.w3.org/2000/svg", "g");
        legend.setAttribute("transform", "translate(10, 350)");

        labels.forEach((label, index) => {
            var colorRect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            colorRect.setAttribute("x", index * 100);
            colorRect.setAttribute("y", 0);
            colorRect.setAttribute("width", 20);
            colorRect.setAttribute("height", 20);
            colorRect.setAttribute("fill", colors[index]);

            var text = document.createElementNS("http://www.w3.org/2000/svg", "text");
            text.setAttribute("x", index * 100 + 25);
            text.setAttribute("y", 15);
            text.textContent = label;

            legend.appendChild(colorRect);
            legend.appendChild(text);
        });

        svg.appendChild(legend);

        // Funcție pentru descărcarea WEBP
        function downloadWEBP() {
            var svgData = new XMLSerializer().serializeToString(svg);
            var canvas = document.createElement("canvas");
            var ctx = canvas.getContext("2d");
            var img = new Image();
            var svgBlob = new Blob([svgData], {type: "image/svg+xml;charset=utf-8"});
            var url = URL.createObjectURL(svgBlob);

            img.onload = function() {
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                canvas.toBlob(function(blob) {
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
    </script>
</body>
</html>
