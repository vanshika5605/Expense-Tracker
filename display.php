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
            <li class="nav-item"><a class="nav-link" href="add.php">Add Expense</a></li>
            <li class="nav-item active"><a class="nav-link" href="display.php">Transaction History</a></li>
            <li class="nav-item"><a class="nav-link" href="borrowlend.php">Borrow and Lend</a></li>
            <li class="nav-item"><a class="nav-link" href="budget.php">Set Your Pocket Capacity</a></li>
            <li class="nav-item"><a class="nav-link" href="report.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="savemoney.php">Save Money</a></li>
            <li class="nav-item"><a class="nav-link" href="signout.php">Logout</a></li>
          </ul>
        </div>
      </nav>
      <br><br>
      <div class="container">
        <h4 class="sub-head">TRANSACTION HISTORY</h4><br>
        <?php
          $sql = "SELECT transactionid, date, amount, category, note FROM transactions WHERE userid='$id'";
          $result = mysqli_query($conn, $sql);
          $sno = 1;
          if (mysqli_num_rows($result) > 0)
          {
              echo
              "<table>
                  <tr>
                      <th>S.no</th>
                      <th>AMOUNT</th>
                      <th>TRANSACTION DATE</th>
                      <th>CATEGORY</th>
                      <th>NOTE</th>
                      <th>         </th>
                  </tr>";
              while($row = mysqli_fetch_assoc($result))
              {
                  echo
                  "<tr>
                      <td>".$sno."</td>
                      <td>".$row["amount"]."</td>
                      <td>".$row["date"]."</td>
                      <td>".$row["category"]."</td>
                      <td>".$row["note"]."</td>
                      <td><a href='display.php?link=$row[transactionid]'>DELETE</a></td>
                  </tr>";
                  $sno =$sno + 1;
              }
              echo "</table>";

              if(isset($_GET['link']))
              {
                  $link=$_GET['link'];
                  $sqll = "DELETE FROM transactions WHERE transactionid = '$link'";

                  if (mysqli_query($conn, $sqll))
                  {
                      echo "Transaction deleted successfully";
                      header("Location:display.php");
                  }
                  else
                  {
                      echo "Error deleting record: " . mysqli_error($conn);
                  }
              }
          }
          else
          {
              echo "No transactions";
          }
        ?>
      </div>
    </body>
</html>
