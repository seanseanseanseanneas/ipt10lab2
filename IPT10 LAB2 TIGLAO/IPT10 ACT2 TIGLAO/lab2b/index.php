<?php

// Start the timer
$start_time = microtime(true);

// Correct the file path to be relative to the current directory
define('CUSTOMERS_FILE_PATH', __DIR__ . '/customers-10000.csv');

function get_customers_data()
{
    // Attempt to open the file
    $opened_file_handler = fopen(CUSTOMERS_FILE_PATH, 'r');

    // Check if the file was opened successfully
    if ($opened_file_handler === false) {
        die('Error: Unable to open the customers file.');
    }

    $data = [];
    $headers = [];
    $row_count = 0;
    while (!feof($opened_file_handler)) {

        $row = fgetcsv($opened_file_handler, 1024);
        if (!empty($row)) {
            if ($row_count == 0) {
                $headers = $row;    
            } else {
                $data[] = $row;
            }
        }

        $row_count++;

    }

    fclose($opened_file_handler);

    return [
        'headers' => $headers,
        'data' => $data
    ];
}

$customers = get_customers_data();

// End the timer
$end_time = microtime(true);
$execution_time = $end_time - $start_time;

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<h1>Customers</h1>
<h4>PHP Execution Time: <?= number_format($execution_time, 4) ?> seconds</h4>
<h4 id="pageLoadTime">Page Load Time: Calculating...</h4>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <?php foreach ($customers['headers'] as $header): ?>
                <th><?= htmlspecialchars($header) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers['data'] as $row): ?>
            <tr>
                <?php foreach ($row as $cell): ?>
                    <td><?= htmlspecialchars($cell) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
// Measure time to load the page fully
window.onload = function() {
    const loadTime = window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart;
    document.getElementById("pageLoadTime").innerHTML = "Page Load Time: " + (loadTime / 1000).toFixed(4) + " seconds";
}
</script>

</body>
</html>
