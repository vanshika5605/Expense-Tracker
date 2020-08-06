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
        <title>Budget</title>
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
      <h4 class="sub-head">MONEY LENT</h4><br>
      <div>
        <?php
          $sql = "SELECT l_id, date, lent, person FROM lent WHERE userid='$id'";
          $result = mysqli_query($conn, $sql);
          $sno = 1;
          if (mysqli_num_rows($result) > 0)
          {
              echo
              "<table>
                  <tr>
                      <th>S.no</th>
                      <th>AMOUNT</th>
                      <th>LENT ON</th>
                      <th>LENT TO</th>
                      <th>IF RECEIVED - </th>
                  </tr>";
              while($row = mysqli_fetch_assoc($result))
              {
                  echo
                  "<tr>
                      <td>".$sno."</td>
                      <td>".$row["lent"]."</td>
                      <td>".$row["date"]."</td>
                      <td>".$row["person"]."</td>
                      <td><a href='lent.php?link=$row[l_id]'>DELETE</a></td>
                  </tr>";
                  $sno =$sno + 1;
              }
              echo "</table>";

              if(isset($_GET['link']))
              {
                  $link=$_GET['link'];
                  $sqll = "DELETE FROM lent WHERE l_id = '$link'";

                  if (mysqli_query($conn, $sqll))
                  {
                      echo "Record deleted successfully";
                      header("Location:lent.php");
                  }
                  else
                  {
                      echo "Error deleting record: " . mysqli_error($conn);
                  }
              }
          }
          else
          {
              echo "No records";
          }
        ?>
      </div>
    </body>
</html>
