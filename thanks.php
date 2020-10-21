<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="author" content="Nancy Ma">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forms PHP</title>
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
  <h1>Submission Successful! Thank you!</h1>
  <?php
  $connect = mysqli_connect('localhost', 'formuser', 'd%u5U3AmKXdG', 'forms');
  $query = 'SELECT colour, month, passed, name, email, message FROM contact';
  $result = mysqli_query($connect, $query);

  // check if connected to database and print to console
  if ($connect == false) {
    echo "<script>console.log('Aw Man Can't Connect')</script>";
  } else {
    echo '<script>console.log("Yay Connected")</script>';
  }

  while ($record = mysqli_fetch_assoc($result)) {
    // get passed bool value from database and set a string accordingly
    $passed = $record['passed'];
    if ($passed == 1) {
      $passedBday = 'birthday has passed already.';
    } else {
      $passedBday = 'birthday has not passed yet.';
    }

    echo
      '<div class="form-info">
        <h3>Email: ' . $record['email'] . '</h3>
        <h3>' . $record['name'] . "'s Favourite Colour: " . $record['colour'] .
        '<h3>' . $record['name'] . "'s Chosen Month: " . $record['month'] .
        '<h3>' . $record['name'] . "'s Message: " . $record['message'] .
        '<h3>' . $record['name'] . "'s " . $passedBday .
        '<hr>
      </div>';
  }
  ?>

</body>

</html>