<?php
    session_start();
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];

    $conn = mysqli_connect("localhost", "root", "", "expense");
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
<html>
    <head>
        <title>Log Borrowed Money</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../public/css/styles.css">
    </head>
    <body>
      <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="../home.php">EXPENSE TRACKER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../add.php">Add Expense</a></li>
            <li class="nav-item"><a class="nav-link" href="../display.php">Transaction History</a></li>
            <li class="nav-item active"><a class="nav-link" href="../borrowlend.php">Borrow and Lend</a></li>
            <li class="nav-item"><a class="nav-link" href="../budget.php">Set Your Pocket Capacity</a></li>
            <li class="nav-item"><a class="nav-link" href="../report.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="../savemoney.php">Save Money</a></li>
            <li class="nav-item"><a class="nav-link" href="../signout.php">Logout</a></li>
          </ul>
        </div>
      </nav>
      <br><br>
      <h4 class="sub-head">LOG MONEY BORROWED</h4><br>
      <div class="container">
        <form action="<?php $_PHP_SELF ?>" method="post">
          <input type="hidden" name="id" value="<?=$id?>">
          <label for="date">On:</label><br>
          <input type="date" name="date"><br>
          <label for="borrow">Amount: </label><br>
          <input type="text" name="borrow" required><br>
          <label for="from">Borrowed from:</label><br>
          <input type="text" name="from" required><br><br>
          <button type="submit">ADD</button>
        </form>
      </div>
    </body>
</html>
<?php
  if(isset($_POST['borrow']))
  {
    $insert = "INSERT INTO borrowed (userid, date, borrowed, person)
    VALUES ('$_POST[id]', '$_POST[date]', '$_POST[borrow]', '$_POST[from]')";

    if (mysqli_query($conn, $insert))
    {
      echo "Added successfully!";
      header("Location:borrow.php");
    } else {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
  }
?>
