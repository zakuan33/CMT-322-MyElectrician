<?php
if(!isset($_SESSION)) {
    session_start();
}
?>



<?php
$fNameErr=$lNameErr=$addErr=$cityErr=$pcErr=$stateErr=
$hpErr=$emailErr=$userErr=$format=$passErr=$strongErr=$passErr=$c_passErr=$Pass=$email1Err=" ";

$servername = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";
$success = "false";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])=="REGISTER")
{
    $valid=false;
    function function_alert($message)
    {
        // Display the alert box
        echo "<script>alert('$message');</script>";
    }
    $Ucase = preg_match('@[A-Z]@', $_POST["new_password"]);
    $Lcase = preg_match('@[a-z]@', $_POST["new_password"]);
    $Num    = preg_match('@[0-9]@', $_POST["new_password"]);
    $specialChars = preg_match('@[^\w]@', $_POST["new_password"]);

    if(empty($_POST["first_name"])){
        $fNameErr="*first name is not entered";
    }
    elseif(empty($_POST["last_name"])){
        $lNameErr="*last name is not entered";
    }
    elseif(empty($_POST["address"])){
        $addErr="*address is not entered";
    }
    elseif(empty($_POST["city"])){
        $cityErr="*city is not entered";
    }
    elseif(empty($_POST["postcode"])){
        $pcErr="*postcode is not entered";
    }
    elseif(empty($_POST["state"])){
        $stateErr="*state is not entered";
    }
    elseif(empty($_POST["hp"])){
        $hpErr="*hp is not entered";
    }
    elseif(empty($_POST["new_email"])){
        $emailErr="*email is not entered";
    }
    elseif (empty($_POST["username"])) {
        $userErr= "* username is not entered";
    }
    elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["username"])) {
        $format= "* incorrect format for username has been entered";
    }
    elseif (empty($_POST["new_password"])) {
        $passErr="* password is not entered";
    }
    elseif(!$Ucase || !$Lcase || !$Num || !$specialChars || strlen($_POST["new_password"]) < 8) {
        $strongErr = "*Password should be at least 8 characters in length and should include
        at least one upper case letter, one number, and one special character.";
    }
    elseif (empty($_POST["c_password"])) {
        $c_passErr="* confirm password is not entered";
    }
    elseif($_POST["new_password"] != $_POST["c_password"]) {
        $Pass = "* Password does not match";
    }
    elseif (!filter_var($_POST["new_email"], FILTER_VALIDATE_EMAIL)) {
        $email1Err = "incorrect format of email has been entered";
    }
    else
    {
        $valid=true;
    }

    if($valid==true)
    {
        $fName=$conn->real_escape_string($_POST["first_name"]);
        $lName=$conn->real_escape_string($_POST["last_name"]);
        $address=$conn->real_escape_string($_POST["address"]);
        $city=$conn->real_escape_string($_POST["city"]);
        $postcode=$conn->real_escape_string($_POST["postcode"]);
        $state=$conn->real_escape_string($_POST["state"]);
        $hp=$conn->real_escape_string($_POST["hp"]);
        $email = $conn->real_escape_string($_POST['new_email']);
        $username = $conn->real_escape_string($_POST["username"]);
        $password = $conn->real_escape_string($_POST["new_password"]);

        $sql = $conn->prepare("SELECT * FROM employer WHERE username=?");
        $sql->bind_param("s",$username);
        $sql->execute();

        $result=$sql->get_result();

        if ($result->num_rows > 0) {
            $success = "true";
        }
        else{
            $success = "false";
        }

        if($success =="false")
        {
            $sql="INSERT INTO employer (f_name,l_name,address,city,postcode,u_state,hp,email,username,password) VALUES
            ('$fName','$lName','$address','$city','$postcode','$state','$hp','$email','$username','$password')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            function_alert("Success!");
            ?>
            <script language=javascript>
                location.href="login.php";
            </script>
            <?php
        }
        else {
            function_alert("Username already exist.Signup Failed!");
            ?>
            <script language=javascript>
                location.href="login.php";
            </script>
            <?php
        }

    }
}

$conn->close();

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
        <label>
            <img class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
            <h1 style="font-size:2vw">My Electrician</h1>
        </label>
    </div>
    <div class="container">
        <form class="form-inline " method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="register_form">
            <h1 style="margin-top: 20px; color: white;">Sign Up as Employer...</h1>

            <div class="row">
                <div class="col-25">
                    <label for="first_name">First Name: </label>
                </div>
                <div class="col-75">
                    <input type="text" name="first_name" id="first_name" placeholder="FIRST NAME" value="<?php echo isset($_POST['first_name']) ? $_POST["first_name"]:'';?>">
                    <span class="error"><?php echo $fNameErr;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="last_name">Last Name: </label>
                </div>
                <div class="col-75">
                    <input type="text" name="last_name" id="last_name" placeholder="LAST NAME" value="<?php echo isset($_POST['last_name']) ? $_POST["last_name"]:'';?>">
                    <span class="error"><?php echo $lNameErr;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="address">Address: </label>
                </div>
                <div class="col-75">
                    <input type="text" name="address" id="address" placeholder="ADDRESS" value="<?php echo isset($_POST['address']) ? $_POST["address"]:'';?>">
                    <span class="error"><?php echo $addErr;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-15">
                    <label for="city">City: </label>
                </div>
                <div class="col-15">
                    <input type="text" name="city" id="city" placeholder="CITY" value="<?php echo isset($_POST['city']) ? $_POST["city"]:''; ?>">
                    <span class="error"><?php echo $cityErr;?></span>
                </div>
                <div class="col-10">
                    <label for="postcode">Postcode: </label>
                </div>
                <div class="col-15">
                    <input type="text" name="postcode" id="postcode" placeholder="POSTCODE" value="<?php echo isset($_POST['postcode']) ? $_POST["postcode"] :'';?>">
                    <span class="error"><?php echo $pcErr;?></span>
                </div>
                <div class="col-8">
                    <label for="state">State: </label>
                </div>
                <div class="col-15">
                    <input type="text" name="state" id="state" placeholder="STATE" value="<?php echo isset($_POST['state']) ? $_POST["state"]:'';?>">
                    <span class="error"><?php echo $stateErr;?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="hp">Hp: </label>
                </div>
                <div class="col-75">
                    <input type="text" name="hp" id="hp" placeholder="HP NUMBER" value="<?php echo isset($_POST['hp']) ? $_POST["hp"]:'';?>">
                    <span class="error"><?php echo $hpErr;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="email">Email: </label>
                </div>
                <div class="col-75">
                    <input type="email" name="new_email" id="email" placeholder="EMAIL" value="<?php echo isset($_POST['new_email']) ? $_POST['new_email']:'';?>">
                    <span class="error"><?php echo $emailErr;?></span>
                    <span class="error"><?php echo $email1Err;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="username">Username: </label>
                </div>
                <div class="col-75">
                    <input type="text" name="username" id="username" placeholder="USERNAME" value="<?php echo isset($_POST['username']) ? $_POST["username"]:'';?>">
                    <span class="error"><?php echo $userErr;?></span>
                    <span class="error"><?php echo $format;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="password">Password: </label>
                </div>
                <div class="col-75">
                    <input type="password" name="new_password" id="password" placeholder="PASSWORD">
                    <span class="error"><?php echo $passErr;?></span>
                    <span class="error"><?php echo $strongErr;?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="c_password">Confirm Password: </label>
                </div>
                <div class="col-75">
                    <input type="password" name="c_password" id="c_password" placeholder="CONFIRM PASSWORD">
                    <span class="error"><?php echo $c_passErr;?></span>
                    <span class="error"><?php echo $Pass;?></span>
                </div>
            </div>

            <input onclick="register()" type="submit" name="submit" value="REGISTER">
            <h4 style="color: white;">I'm an Electrician.<a href="elec_Register.php">Register</a> as electrician here</h4>
            <h4 style="color: white;">Already a member? <a href="login.php">Log In</a> here</h4>
        </form>
    </div>

</div>
</body>

</html>