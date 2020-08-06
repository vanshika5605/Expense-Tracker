<?php
    if(isset($_POST['uname']))
    {
        $conn = mysqli_connect("localhost", "root", "", "expense");
        if (!$conn)
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM users WHERE username = '$_POST[uname]'";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) == 0)
        {
                $sql = "INSERT INTO users (username, password, name, contact)
                values ('$_POST[uname]','$_POST[psw]','$_POST[name]','$_POST[contact]')";

                if (mysqli_query($conn, $sql))
                {
                    echo "New User created successfully";
                }
                else
                {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        }
        else
        {
            echo "Username already taken.";
        }

        mysqli_close($conn);
    }
?>
