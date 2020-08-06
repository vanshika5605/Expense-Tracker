<?php
    session_start();
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $monthyear = date("F Y");
    $month = date("m");
    $conn = mysqli_connect("localhost", "root", "", "expense");
        if (!$conn)
        {
            die("Connection failed: " . mysqli_connect_error());
        }

    $sql = "SELECT amount, category FROM transactions WHERE userid='$id' AND MONTH(date) = '$month'";
    $result = mysqli_query($conn, $sql);
    $bill = 0;$ent = 0;$food = 0;$shop=0;$travel=0;
    if (mysqli_num_rows($result) > 0)
    {
      while($row = mysqli_fetch_assoc($result))
      {
        $cat = $row['category'];

        if($cat == "bills")
            $bill = $bill + $row['amount'];
        else if($cat == "entertainment")
            $ent = $ent + $row['amount'];
        else if($cat == "food")
            $food = $food + $row['amount'];
        else if($cat == "shopping")
            $shop = $shop + $row['amount'];
        else if($cat == "travel")
            $travel = $travel + $row['amount'];
      }
    }
    $budget = "SELECT Bill, Entertainment, Food, Shopping, Travel from budget WHERE userid='$id' and date='$monthyear'";
    $result = mysqli_query($conn, $budget);
    $row = mysqli_fetch_assoc($result);
    $pbill=0; $pfood=0; $pshop=0; $pent=0; $ptravel=0;
    if($row['Bill']!=0)
      $pbill = ($bill/$row['Bill'])*100;
    if($row['Entertainment']!=0)
      $pent = ($ent/$row['Entertainment'])*100;
    if($row['Food']!=0)
      $pfood = ($food/$row['Food'])*100;
    if($row['Shopping']!=0)
      $pshop = ($shop/$row['Shopping'])*100;
    if($row['Travel']!=0)
      $ptravel = ($travel/$row['Travel'])*100;
?>
<html>
    <head>
        <title>Show Report</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap">
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
            <li class="nav-item"><a class="nav-link" href="add.php">Add Expense</a></li>
            <li class="nav-item"><a class="nav-link" href="display.php">Transaction History</a></li>
            <li class="nav-item"><a class="nav-link" href="borrowlend.php">Borrow and Lend</a></li>
            <li class="nav-item"><a class="nav-link" href="budget.php">Set Your Pocket Capacity</a></li>
            <li class="nav-item active"><a class="nav-link" href="report.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="savemoney.php">Save Money</a></li>
            <li class="nav-item"><a class="nav-link" href="signout.php">Logout</a></li>
          </ul>
        </div>
      </nav>
      <br><br>
      <div class="dropdown">
        <button class="dropbtn">Expenses Statistics</button>
        <div class="dropdown-content">
          <a class="active" href="report.php">Monthly</a>
          <a href="reporty.php">Yearly</a>
          <a href="reportc.php">Stats</a>
          <a href="progress.php">Progress</a>
        </div>
      </div>
      <br><br>
      <h4>BILLS</h4>
      <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$pbill?>"
          aria-valuemin="0" aria-valuemax="100" style="width:<?=$pbill?>%">
          <?=$pbill?>% Spent
        </div>
      </div>
      <h4>ENTERTAINMENT</h4>
      <div class="progress">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=$pent?>"
          aria-valuemin="0" aria-valuemax="100" style="width:<?=$pent?>%">
          <?=$pent?>% Spent
        </div>
      </div>
      <h4>FOOD</h4>
      <div class="progress">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?=$pfood?>"
          aria-valuemin="0" aria-valuemax="100" style="width:<?=$pfood?>%">
          <?=$pfood?>% Spent
        </div>
      </div>
      <h4>SHOPPING</h4>
      <div class="progress">
        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$pshop?>"
          aria-valuemin="0" aria-valuemax="100" style="width:<?=$pshop?>%">
          <?=$pshop?>% Spent
        </div>
      </div>
      <h4>TRAVEL</h4>
      <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$ptravel?>"
          aria-valuemin="0" aria-valuemax="100" style="width:<?=$ptravel?>%">
          <?=$ptravel?>% Spent
        </div>
      </div>
    </body>
</html>
