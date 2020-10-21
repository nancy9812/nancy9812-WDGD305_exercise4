<?php
$connect = mysqli_connect('localhost', 'formuser', 'd%u5U3AmKXdG', 'forms');

// check if input exists and put into input var
// if it doesn't exist set input var to empty string
$colour = isset($_POST['colour']) ? $_POST['colour'] : '';
$month = isset($_POST['month']) ? $_POST['month'] : '';
$checked = isset($_POST['checked']) ? 1 : 0;
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// validate form
// set error vars to empty to prevent undefined error
$colour_err = '';
$month_err = '';
$email_err = '';
$message_err = '';

// if there is anything in my POST Array
if (count($_POST)) {
  $errors = 0;

  if ($colour == '') {
    $errors++;
    $colour_err = '*Please select a colour*';
  }
  if ($month == '') {
    $errors++;
    $month_err = '*Please select a month*';
  }
  if ($email == '') {
    $errors++;
    $email_err = '*Please enter an email address*';
  }
  if ($message == '') {
    $errors++;
    $message_err = '*Please enter a message*';
  }

  // only insert database if there are no errors
  if ($errors == 0) {
    // addslashes makes sure special characters input right
    $query =
      'INSERT INTO contact (colour, month, passed, email, message) 
      VALUES (
        "' . $colour . '",
        "' . $month . '",
        "' . $checked . '",
        "' . addslashes($_POST['email']) . '",
        "' . addslashes($_POST['message']) . '"
      )';

    // execute query
    mysqli_query($connect, $query);

    // redirect to thank you page
    header('Location: thanks.html');

    //don't execute anything more
    die();
  }
}
?>

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
  <h1>PHP Contact Form</h1>
  <form method="POST">
    Favourite Colour:
    <br>
    <input type="radio" name="colour" value="red">
    <label for="red">Red</label><br>
    <input type="radio" name="colour" value="blue">
    <label for="red">Blue</label><br>
    <input type="radio" name="colour" value="green">
    <label for="red">Green</label><br>
    <input type="radio" name="colour" value="white">
    <label for="red">White</label><br>
    <input type="radio" name="colour" value="black">
    <label for="red">Black</label><br>
    <input type="radio" name="colour" value="other">
    <label for="red">Other(add to message)</label>
    <?php echo "<p class='errormsg'>$colour_err</p>"; ?>

    <label for="month">Favourite Month:</label>
    <br>
    <!-- reset value on submit -->
    <select id="month" name="month" value="<?php echo ""; ?>">
      <option selected disabled>Choose a Month</option>
      <option value="january">January</option>
      <option value="february">February</option>
      <option value="march">March</option>
      <option value="april">April</option>
      <option value="may">May</option>
      <option value="june">June</option>
      <option value="july">July</option>
      <option value="august">August</option>
      <option value="september">September</option>
      <option value="october">October</option>
      <option value="november">November</option>
      <option value="december">December</option>
    </select>
    <?php echo "<p class='errormsg'>$month_err</p>"; ?>

    <label for="checked">Did your birthday pass this year?</label>
    <br>
    <input type="checkbox" name="checked">
    <br><br>

    Email:
    <br>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <?php echo "<p class='errormsg'>$email_err</p>"; ?>

    Message:
    <br>
    <textarea name="message"><?php echo $message; ?></textarea>
    <?php echo "<p class='errormsg'>$message_err</p>"; ?>

    <input type="submit" value="submit">
  </form>

</body>

</html>