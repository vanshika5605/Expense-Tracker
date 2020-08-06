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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
          <a href="reportc.php">Stats</a>
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

      $b = array(0); $e = array(0); $f = array(0); $g = array(0); $s = array(0); $t = array(0); $o = array(0);
      for($i=1; $i<=12; $i++)
      {
        $sql = "SELECT amount, category FROM transactions WHERE userid='$id' AND (YEAR(date)='$y' AND MONTH(date)='$i')";
        $result = mysqli_query($conn, $sql);
        $bill = 0;$ent = 0;$food = 0;$general = 0;$shop=0;$travel=0;$others=0;

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
          $b[$i] = $bill; $e[$i] = $ent; $f[$i] = $food; $g[$i] = $general; $s[$i] = $shop; $t[$i] = $travel; $o[$i] = $others;
      }
          echo "<h4 style='text-align: center;'>$y</h4>
          <div id='chart' style='width: 1500px; height: 500px;'></div>
          <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
          <script type='text/javascript'>
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
              var data = google.visualization.arrayToDataTable([
              ['Month-Year', 'Bills', 'Entertainment', 'Food', 'General', 'Shopping', 'Travel', 'Others'],
              ['01', $b[1], $e[1], $f[1], $g[1], $s[1], $t[1], $o[1]],
              ['02', $b[2], $e[2], $f[2], $g[2], $s[2], $t[2], $o[2]],
              ['03', $b[3], $e[3], $f[3], $g[3], $s[3], $t[3], $o[3]],
              ['04', $b[4], $e[4], $f[4], $g[4], $s[4], $t[4], $o[4]],
              ['05', $b[5], $e[5], $f[5], $g[5], $s[5], $t[5], $o[5]],
              ['06', $b[6], $e[6], $f[6], $g[6], $s[6], $t[6], $o[6]],
              ['07', $b[7], $e[7], $f[7], $g[7], $s[7], $t[7], $o[7]],
              ['08', $b[8], $e[8], $f[8], $g[8], $s[8], $t[8], $o[8]],
              ['09', $b[9], $e[9], $f[9], $g[9], $s[9], $t[9], $o[9]],
              ['10', $b[10], $e[10], $f[10], $g[10], $s[10], $t[10], $o[10]],
              ['11', $b[11], $e[11], $f[11], $g[11], $s[11], $t[11], $o[11]],
              ['12', $b[12], $e[12], $f[12], $g[12], $s[12], $t[12], $o[12]]
            ]);
              var options = {'title':'My Expenses',
                vAxis: {title: 'Category'},
                hAxis: {title: 'Month'},
                seriesType: 'bars' ,
              series: {12: {type: 'line'}} };
              var chart = new google.visualization.ComboChart(document.getElementById('chart'));
              chart.draw(data, options);
            }
            </script>";
}
 ?>
