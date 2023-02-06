<?php
if(!isset($_SESSION)) {
    session_start();
}
$usernameError=$passwordError=$userPassError=$NoMatch=$roleError=" ";
$hostname = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";

$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");


if(isset($_POST['submit'])=="LOGIN")
{
    $valid=false;
    if((empty($_POST["password"]))&&(empty ($_POST["username"])) && (empty($_POST["role"]))){
        $userPassError = "*Please enter password, username and role";
    }

    elseif(empty($_POST["username"])){
        $usernameError = "*username is not entered";
    }

    elseif(empty($_POST["password"])){
        $passwordError = "*password is not entered";
    }

    elseif((empty($_POST["role"]))){
        $roleError = "*Please choose your role";
    }

    else
    {
        $valid=true;
    }

if ($valid==true)
{
    if( $_POST["role"]=="EMPLOYER")
    {
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);

        $sql = "select *from employer where username = '$username' and password = '$password'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count> 0) {
            $success=true;
        } else {
            $success=false;
        }

        if ($success == "true")
        {
            $_SESSION['user']= $row['id'];

            ?>
            <script language=javascript>
                location.href="posted.php";
            </script>

            <?php
        }
        else
        {
            $NoMatch = "*Login Failed";
            ?>
            <script language=javascript>

                location.href="login.php";
            </script>

            <?php
        }
    }
    if($_POST["role"]=="ELECTRICIAN")
    {
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);

        $sql = "select id from electrician where username = '$username' and password = '$password'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count> 0) {
            $success=true;
        } else {
            $success=false;
        }

        if ($success == "true")
        {
            $_SESSION['user']= $row['id'];

            ?>
            <script language=javascript>
                location.href="elec_pg1_extend.php";
            </script>

            <?php
        }
        else
        {
            $NoMatch = "*Login Failed";
            ?>
            <script language=javascript>

                location.href="login.php";
            </script>

            <?php
        }
    }
}
}
$connection->close();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>َNOTER</title>
    <link rel="shortout icon" type="image/x-icon" href="includes/favicon.png" />
    <link rel="stylesheet" href="login1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-auth.js">
    </script>
    <style>
        .background{
            background-image: url("img/bg7.png");
            margin: 0;
            height:1000px;
        }
    </style>
</head>

<body >
<div class="background">
    <div class="header">
        <label >
            <img class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
            <h1 style="font-size:3vw">My Electrician</h1>
        </label>
    </div>
    <div class="container" id="container">
        <form class="form-inline " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  id="register_form">
            <h1 style="margin-top: 20px; color: white;">Login</h1>


            <div class="row">
                <div class="col-25">
                    <label for="username">Username: </label>
                </div>
                <div class="col-75">
                    <input type="text" name="username" id="username" placeholder="USERNAME">
                    <span class="error"><?php echo $usernameError;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">Password: </label>
                </div>
                <div class="col-75">
                    <input type="password" name="password" id="password" placeholder="PASSWORD">
                    <span class="error"><?php echo $passwordError;?></span>
                </div>
            </div>

            <div class="row">

                <p style="color: white">Please select whether you are:- </p>

                <input type="radio" id="employer" name="role" value="EMPLOYER">
                <label style="color: white" for="employer">EMPLOYER</label>
                <input type="radio" id="electrician" name="role" value="ELECTRICIAN">
                <label style="color: white" for="electrician">ELECTRICIAN</label>
                <span class="error"><?php echo $roleError;?></span>
                <br>


            </div>


            <input type="submit" name="submit" value="LOGIN">
            <span class="error"><?php echo $userPassError;?></span>

            <h4 style="color: white">No account?<a href="emp_Register.php"> Register</a> Now</h4>
        </form>
    </div>

</div>

</body>

</html>