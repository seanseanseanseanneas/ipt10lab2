<?php

// Function to get registrants data from CSV file
function get_registrants_data($file)
{
    $registrants = [];
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $registrants[] = $data;
        }
        fclose($handle);
    }
    return $registrants;
}

$registrants = get_registrants_data('registrations.csv');
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Registrants</title>
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<h1>Registered Users</h1>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Complete Name</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Contact Number</th>
            <th>Sex</th>
            <th>Program</th>
            <th>Complete Address</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registrants as $registrant): ?>
            <tr>
                <?php foreach ($registrant as $field): ?>
                    <td><?= htmlspecialchars($field) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
