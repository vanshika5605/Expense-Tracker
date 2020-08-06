<?php
    session_start();
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $month = date("m");

    $conn = mysqli_connect("localhost", "root", "", "expense");
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT currentbudget,balance FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $budget = $row['currentbudget'];
    $balance = $row['balance'];

    $all = "SELECT amount FROM transactions WHERE userid='$id' AND MONTH(date)='$month'";
    $temp = 0;
    $result = mysqli_query($conn, $all);

    if (mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result))
      {
        $temp = $temp + $row['amount'];
      }
      $updateb = "UPDATE users SET balance = $budget - $temp WHERE id='$id'";
      if(mysqli_query($conn, $updateb)){
        $extractb = "SELECT balance, currentbudget FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $extractb);
        $row = mysqli_fetch_assoc($result);
        $balance = $row['balance'];
        $budget = $row['currentbudget'];
      }
    }
    $p = round((($budget-$balance)/$budget)*100);
?>
<html>
    <head>
        <title><?php echo'WELCOME '. $name.''; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    <body>
      <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="home.php">EXPENSE TRACKER</a>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="signout.php">Logout</a></li>
        </ul>
      </nav><br><br>
      <h3>YOUR DASHBOARD</h3><br>
      <div class="container"
        <img src="public/images/balance.png" alt="balance" border="0" width="50" height="50">
        <h4>BALANCE: <?=$balance?></h4><br><br>
        <div class="progress">
          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=$p?>"
            aria-valuemin="0" aria-valuemax="100" style="width:<?=$p?>%">
            <?=$p?>% Spent
          </div>
        </div>
        <br><br>
        <table>
          <tr>
            <th><a href="add.php"><img src="public/images/add.png" alt="add" border="0" width="100" height="100">
            </a><br><br>
            <p>Add Expense</p>
            <a href="display.php"><img src="public/images/display.png" alt="display" border="0" width="100" height="100">
            </a><br><br>
            <p>Transaction History</p>
            <a href="borrowlend.php"><img src="public/images/borrowlend.png" alt="borrowlend" border="0" width="100" height="100">
            </a>
            <p>Borrow and Lend Money</p></th>
            <th><a href="budget.php"><img src="public/images/budget.png" alt="budget" border="0" width="100" height="100">
            </a><br><br>
            <p>Set Your Pocket Capacity</p>
            <a href="report.php"><img src="public/images/stats.png" alt="report" border="0" width="100" height="100">
            </a><br><br>
            <p>Check your Report</p>
            <a href="savemoney.php"><img src="public/images/save.png" alt="save" border="0" width="100" height="100">
            </a>
            <p>Save Money</p></th>
          </tr>
        </table>
      </div>
    </body>
</html>
