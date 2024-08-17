<?php

require "helpers/helper-functions.php";

session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$agree = $_POST['agree'];

if (empty($email) || empty($password) || empty($agree)) {
    header("Location: step-3.php");
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$_SESSION['email'] = $email;
$_SESSION['password'] = $hashed_password;

$form_data = $_SESSION;
$age = $form_data['age'];

// Prepare the data to be saved in the CSV
$registration_data = [
    $form_data['fullname'],
    $form_data['birthdate'],
    $age,
    $form_data['contact_number'],
    $form_data['sex'],
    $form_data['program'],
    $form_data['address'],
    $form_data['email'],
    $hashed_password // Include the hashed password
];

// Append the data to the CSV file
$csv_file = fopen('registrations.csv', 'a');
fputcsv($csv_file, $registration_data);
fclose($csv_file);

session_destroy();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<section class="p-section--hero">
  <div class="row--50-50-on-large">
    <div class="col">
      <div class="p-section--shallow">
        <h1>
          Thank You Page
        </h1>
      </div>
      <div class="p-section--shallow">
        <img class="p-image-container__image" src="/mnt/data/image.png" alt="ITTC">
        <table aria-label="Session Data">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Complete Name</td>
                    <td><?= htmlspecialchars($form_data['fullname']) ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?= htmlspecialchars($form_data['birthdate']) ?></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><?= htmlspecialchars($age) ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?= htmlspecialchars($form_data['contact_number']) ?></td>
                </tr>
                <tr>
                    <td>Sex</td>
                    <td><?= htmlspecialchars($form_data['sex']) ?></td>
                </tr>
                <tr>
                    <td>Program</td>
                    <td><?= htmlspecialchars($form_data['program']) ?></td>
                </tr>
                <tr>
                    <td>Complete Address</td>
                    <td><?= htmlspecialchars($form_data['address']) ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= htmlspecialchars($form_data['email']) ?></td>
                </tr>
                <tr>
                    <td>Hashed Password</td>
                    <td><?= htmlspecialchars($hashed_password) ?></td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>

    <div class="col">
      <div class="p-image-container--3-2 is-cover">
        <img class="p-image-container__image" src="/mnt/data/image.png" alt="ITTC">
      </div>
    </div>

  </div>
</section>

</body>
</html>
