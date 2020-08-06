<?php
    session_start();
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $currentyear = date("Y");
    $years = range($currentyear, $currentyear-10);
?>
<html>
    <head>
        <title>Show Report</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap">
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
          <a href="reportc.php">Categorically</a>
          <a href="progress.php">Progress</a>
        </div>
      </div>
      <br><br>
      <form action="<?php $_PHP_SELF ?>" method="post">
        <label for="year">Year</label>
        <select name="year">
          <option value="<?=$years[0]?>"><?=$years[0]?></option>
          <option value="<?=$years[1]?>"><?=$years[1]?></option>
          <option value="<?=$years[2]?>"><?=$years[2]?></option>
          <option value="<?=$years[3]?>"><?=$years[3]?></option>
          <option value="<?=$years[4]?>"><?=$years[4]?></option>
          <option value="<?=$years[5]?>"><?=$years[5]?></option>
          <option value="<?=$years[6]?>"><?=$years[6]?></option>
          <option value="<?=$years[7]?>"><?=$years[7]?></option>
          <option value="<?=$years[8]?>"><?=$years[8]?></option>
          <option value="<?=$years[9]?>"><?=$years[9]?></option>
        </select>
        <button type="submit">Display</button>
      </form>
    </body>
</html>
<?php
if(isset($_POST['year']))
{
  $conn = mysqli_connect("localhost", "root", "", "expense");
      if (!$conn)
      {
          die("Connection failed: " . mysqli_connect_error());
      }
      $y = $_POST['year'];

      $sql = "SELECT amount, category FROM transactions WHERE userid='$id' AND YEAR(date)='$y'";
      $result = mysqli_query($conn, $sql);
      $bill = 0;$ent = 0;$food = 0;$general = 0;$shop=0;$travel=0;$others=0;
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
          else if($cat == "general")
              $general = $general + $row['amount'];
          else if($cat == "shopping")
              $shop = $shop + $row['amount'];
          else if($cat == "travel")
              $travel = $travel + $row['amount'];
          else if($cat == "others")
              $others = $others + $row['amount'];
        }
          echo "<h4>$y</h4><div id='piechart'></div>
          <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
          <script type='text/javascript'>
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
              ['category', 'Expense'],
              ['Bills', $bill],
              ['Entertainment', $ent],
              ['Food', $food],
              ['General', $general],
              ['Shopping', $shop],
              ['Travel', $travel],
              ['Others', $others]
            ]);
              var options = {'title':'My Expenses', 'width':550, 'height':400, is3D: true};
              var chart = new google.visualization.PieChart(document.getElementById('piechart'));
              chart.draw(data, options);
            }
            </script>";
      }
      else {
        echo "No data for this month!";
      }
}
 ?>
