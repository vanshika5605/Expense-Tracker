<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    <body>
    <h1 class="text-center">EXPENSE TRACKER</h1>
        <div class="grandParentContaniner">
            <div class="parentContainer">
                <h3>LOGIN</h3>
                <form action="<?php $_PHP_SELF ?>" method="POST">
                    <div class="form-group">
                        <label for="uname">Username:</label>
                        <input type="text" class="form-control" placeholder="Enter username" name="uname" required>
                    </div>
                    <div class="form-group">
                        <label for="psw">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter password" name="psw" required>
                    </div>
                    <button type="submit" class="btn btn-dark">LOGIN</button>
                    <br>
                </form>
                <br>
                <?php
                    session_start();
                    if(isset($_POST['psw']))
                    {
                        $conn = mysqli_connect("localhost", "root", "", "expense");
                        if (!$conn)
                        {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM users WHERE username = '$_POST[uname]' AND password = '$_POST[psw]' ";
                        $result = mysqli_query($conn, $sql);

                        $row  = mysqli_fetch_array($result);
                        if(is_array($row))
                        {
                            $_SESSION["id"] = $row['id'];
                            $_SESSION["name"] = $row['name'];
                            header("Location:home.php");
                        }
                        else
                        {
                            echo "Invalid Email ID or Password!";
                        }
                        mysqli_close($conn);
                    }
                ?>
                <br><br>
                <p>New User? Create Account.</p>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal" data-backdrop="true">SIGN UP</button>

                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" class="text-center">SIGN UP</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="signup.php" method="POST" target="my_iframe" class="was-validated">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact:</label>
                                        <input type="text" class="form-control" placeholder="Enter contact number" name="contact" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="uname">Username:</label>
                                        <input type="text" class="form-control" placeholder="Enter username" name="uname" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="psw">Password:</label>
                                        <input type="password" class="form-control" placeholder="Enter password" name="psw" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Submit</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <iframe name="my_iframe" style="border:none;" height="50"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
