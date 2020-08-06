<?php
    session_start();
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
?>
<html>
    <head>
        <title>Add Expense</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    <body>
      <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="home.php">EXPENSE TRACKER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="add.php">Add Expense</a></li>
            <li class="nav-item"><a class="nav-link" href="display.php">Transaction History</a></li>
            <li class="nav-item"><a class="nav-link" href="borrowlend.php">Borrow and Lend</a></li>
            <li class="nav-item"><a class="nav-link" href="budget.php">Set Your Pocket Capacity</a></li>
            <li class="nav-item"><a class="nav-link" href="report.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="savemoney.php">Save Money</a></li>
            <li class="nav-item"><a class="nav-link" href="signout.php">Logout</a></li>
          </ul>
        </div>
      </nav>
      <br><br>
      <h4 class="sub-head">LOG YOUR DAILY EXPENSES</h4><br>
      <div class="container">
        <form action="add.php" method="post">
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="date" name="date" required><br><br><br>
          <label for="expense">Amount</label><br>
          <input type="text" name="expense" required><br><br>
          <label for="category">Choose Expense category - </label><br>
          <select name="category" required>
            <option value="bills">Bills</option>
            <option value="entertainment">Entertainment</option>
            <option value="food">Food</option>
            <option value="general">General</option>
            <option value="shopping">Shopping</option>
            <option value="travel">Travel</option>
            <option value="null">Others</option>
          </select><br><br>
          <label for="notes">Note</label><br>
          <textarea name="notes" rows="5" cols="50" placeholder="Add a note"></textarea><br><br>
          <button type="submit">SAVE</button>
        </form>
      </div>
    </body>
</html>
<?php
  if(isset($_POST['expense']))
  {
      $conn = mysqli_connect("localhost", "root", "", "expense");
      if (!$conn)
      {
          die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "INSERT INTO transactions (userid, date, amount, category, note)
      VALUES ('$_POST[id]', '$_POST[date]', '$_POST[expense]', '$_POST[category]', '$_POST[notes]')";
      if (mysqli_query($conn, $sql))
      {
        echo "Expense added successfully!<br>";
        $e = $_POST['expense'];
        $updateb = "UPDATE users SET balance = balance - $e WHERE id='$_POST[id]'";
        if(mysqli_query($conn, $updateb)){
          echo "Balance updated!";
        }
        else{
          echo "Error: " . $updateb . "<br>" . mysqli_error($conn);
        }
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      mysqli_close($conn);
  }
 ?>
