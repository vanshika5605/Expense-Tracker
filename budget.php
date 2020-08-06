<?php
    session_start();
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $monthyear = date("F Y");
    $conn = mysqli_connect("localhost", "root", "", "expense");
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT userid, Total, Bill, Entertainment, Food, Shopping, Travel, date FROM budget WHERE userid='$id' && date='$monthyear'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) != 0){
      $total = $row['Total'];
      $bill = $row['Bill'];
      $ent = $row['Entertainment'];
      $food = $row['Food'];
      $shop = $row['Shopping'];
      $travel = $row['Travel'];
    }
    else{
      $total = 0;
      $bill = 0;
      $ent = 0;
      $food = 0;
      $shop = 0;
      $travel = 0;
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
            <li class="nav-item active"><a class="nav-link" href="budget.php">Set Your Pocket Capacity</a></li>
            <li class="nav-item"><a class="nav-link" href="report.php">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="savemoney.php">Save Money</a></li>
            <li class="nav-item"><a class="nav-link" href="signout.php">Logout</a></li>
          </ul>
        </div>
      </nav>
      <br><br>
      <h4 class="sub-head">SET YOUR MONTHLY BUDGET</h4><br>
      <div class="container">
        <p><?=$monthyear?> :- </p><br>
        <p>Current Total Budget - <?=$total?></p><br>
        <button type="button" data-toggle="collapse" data-target="#b">See current categorical budgets</button><br>
        <div class="collapse" id="b">
          <p>Bill budget - <?=$bill?></p><br>
          <p>Entertainment budget - <?=$ent?></p><br>
          <p>Food budget - <?=$food?></p><br>
          <p>Shopping budget - <?=$shop?></p><br>
          <p>Travel budget - <?=$travel?></p><br>
        </div><br><br>
        <button type="button" data-toggle="collapse" data-target="#update">Update budgets</button><br>
        <div class="collapse" id="update">
          <form action="budget.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="my" value="<?=$monthyear?>">
            <label for="budget">Total monthly Budget</label><br>
            <input type="text" name="budget" required value="<?=$total?>"><br><br>
            <button type="button" data-toggle="collapse" data-target="#cat">Add Categorical Budget</button>
            <div class="collapse" id="cat">
              <label for="bill">Bill budget - </label><br>
              <input type="text" name="bill" value="<?=$bill?>"><br>
              <label for="ent">Entertainment budget - </label><br>
              <input type="text" name="ent" value="<?=$ent?>"><br>
              <label for="food">Food budget - </label><br>
              <input type="text" name="food" value="<?=$food?>"><br>
              <label for="shop">Shopping budget - </label><br>
              <input type="text" name="shop" value="<?=$shop?>"><br>
              <label for="travel">Travel budget - </label><br>
              <input type="text" name="travel" value="<?=$travel?>">
            </div>
            <br><br><br>
            <button type="submit">SAVE</button>
          </form>
        </div>
      </div>
    </body>
</html>
<?php
  if(isset($_POST['budget']))
  {
    if($_POST['budget'] >= ($_POST['bill'] + $_POST['ent'] + $_POST['food'] + $_POST['shop'] + $_POST['travel']))
    {
      $insertb = "UPDATE users SET balance = '$_POST[budget]',currentbudget = '$_POST[budget]' WHERE id='$_POST[id]'";
      if(mysqli_query($conn, $insertb)){
        echo "Balance updated successfully";
      }
      else{
        echo "Error: " . $insertb . "<br>" . mysqli_error($conn);
      }
      if (mysqli_num_rows($result) == 0)
      {
          $insert = "INSERT INTO budget (userid, Total, Bill, Entertainment, Food, Shopping, Travel, date)
          VALUES ('$_POST[id]', '$_POST[budget]', '$_POST[bill]', '$_POST[ent]', '$_POST[food]', '$_POST[shop]', '$_POST[travel]', '$_POST[my]')";

          if (mysqli_query($conn, $insert))
          {
            echo "Budget added successfully!";
            header("Location:budget.php");
          }
          else
          {
              echo "Error: " . $insert . "<br>" . mysqli_error($conn);
          }
        }
        else
        {
            $update = "UPDATE budget SET Total='$_POST[budget]', Bill='$_POST[bill]', Entertainment='$_POST[ent]', Food='$_POST[food]',Shopping='$_POST[shop]',Travel='$_POST[travel]'
             WHERE userid='$_POST[id]' && date='$_POST[my]'";

             if (mysqli_query($conn, $update))
             {
               echo "Budget updated successfully!";
               header("Location:budget.php");
             }
             else
             {
                 echo "Error: " . $update. "<br>" . mysqli_error($conn);
             }
        }
      }
      else{
        echo "Error! The sum of categorical budgets exceeds the total budget!";
      }
      mysqli_close($conn);
  }
 ?>
