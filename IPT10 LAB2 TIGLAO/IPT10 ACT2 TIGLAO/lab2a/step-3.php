<?php

require "helpers/helper-functions.php";

session_start();

$program = $_POST['program'];
$address = $_POST['address'];

if (empty($program) || empty($address)) {
    header("Location: step-2.php");
    exit();
}

$_SESSION['program'] = $program;
$_SESSION['address'] = $address;

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
          Registration (Step 3/3)
        </h1>
      </div>
      <div class="p-section--shallow">
        <form action="thank-you.php" method="POST">

        <fieldset>
          <label>Email address</label>
          <input type="email" name="email" placeholder="example@canonical.com" required>

          <label>Password</label>
          <input type="password" name="password" required>

          <label>
            <input type="checkbox" name="agree" required> I Agree to Terms and Conditions
          </label>

          <input type="submit" value="Register">
        </fieldset>

        </form>

        <form action="step-2.php" method="POST" onsubmit="return confirm('Are you sure you want to go back?');">
            <button type="submit">Back</button>
        </form>

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
