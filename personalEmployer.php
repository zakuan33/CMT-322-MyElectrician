<?php

if (!isset($_SESSION))
{
    session_start();
}

$hostname = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";

$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");

$value = $_SESSION['user'];
$User = $value;

function function_alert($message)
{
    // Display the alert box
    echo "<script>alert('$message');</script>";
}

if(isset($_POST['submit'])=="Submit Details")
{
    $email = $connection->real_escape_string($_POST['email']);
    $address = $connection->real_escape_string($_POST['add']);
    $postcode = $connection->real_escape_string($_POST['postcode']);
    $city = $connection->real_escape_string($_POST['city']);
    $state = $connection->real_escape_string($_POST['state']);
    $hp = $connection->real_escape_string($_POST['hp']);


    $sql = "UPDATE electrician SET address='$address', city='$city', postcode='$postcode', u_state='$state', hp='$hp',email='$email' where electricianID ='$User'";

    if ($connection->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connection->error;
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyElectrician</title>
    <link rel="shortout icon" type="image/x-icon" href="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="jobs2.css">
    <link rel="stylesheet" href="jobBooking.css">
    <link rel="stylesheet" href="personal.css">


    <style>

        .headertop img{
            height:10%;
            width:10%;
            margin-bottom: 0;
            position: -webkit-sticky; /* Safari */
            position: sticky;
        }

        /* Header/logo Title */
        .headertop {
            /*margin: 0px;*/
            padding: 1px;
            text-align: center;
            background-image: url("img/bg7.png");
            /*background: #48245d;*/
            color: white;
        }

        /* Increase the font size of the heading */
        .headertop h1 {
            font-size: 40px;
        }

        .topnav {
            margin: 0;
            overflow: hidden;
            /*background-color: #111111;*/
            background-color: #323232;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4); /* shadow for box*/

        }

        .topnav a{
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 10px 26px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }

        .topnav .icon {
            display: none;
        }

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {position: relative;}
            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }
            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }
        }


    </style>
</head>
<body>
<div class="headertop">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview%20(1).png">
        <h1 style="margin-top: 30px;">My Electrician</h1>
    </div>
</div>

<div class="topnav" id="topnav">

    <a href="logout.php">Log Out</a>
    <a href="personalEmployer.php">Personal</a>
    <a href="about2.php">About Us</a>
    <a href="posted.php">Job</a>
</div>

<div class="PageContainer">

    <?php
    $query = "SELECT * FROM employer where id ='$User'";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) > 0)
    {
    while($row = mysqli_fetch_array($result))
    {
    if($row['id']== $User)
    {
    ?>

    <div id="overlay">
        <div class="overlay_form">
            <form method="post" action="PersonalEmployer.php">
                <i class="fa fa-close" style="font-size:24px;color:red; position: absolute;margin-left: 430px;" onclick="off()"></i>
                <div class="overlay-inner">
                    <br>
                    <label for="email">Email: </label>
                    <div>
                        <input style="width: 100%;" class="box" type="text" name="email" id="email" value="<?php echo $row['email'] ?>">
                    </div>
                    <br>

                    <label for="add">Address: </label>
                    <div>
                        <input style="width: 100%" class="box" type="text" name="add" id="add" value="<?php echo $row['address'] ?>" placeholder="ADDRESS">
                    </div>
                    <br>

                    <div class="col-25">
                        <label for="postcode">Poscode: </label>
                        <div>
                            <input style="width: 180%;" class="box" type="text" name="postcode" id="postcode" value="<?php echo $row['postcode'] ?>" placeholder="POST CODE">
                        </div>
                    </div>

                    <div class="col-65">

                        <label for="city">City: </label>
                        <div>
                            <input style="width: 100%;" class="box" type="text" name="city" id="city" value="<?php echo $row['city'] ?>" placeholder="CITY">
                        </div>
                    </div>
                    <br>

                    <div class="col-25">
                        <label for="state">State: </label>
                        <div>
                            <input style="width: 180%;" class="box" type="text" name="state" id="state" value="<?php echo $row['u_state'] ?>" placeholder="STATE">
                        </div>
                    </div>

                    <div class="col-65">
                        <label for="hp">Mobile Number: </label>
                        <div>
                            <input style="width: 100%;" class="box" type="text" name="hp" id="hp" value="<?php echo $row['hp'] ?>" placeholder="MOBILE NUMBER">
                        </div>
                    </div>

                    <button style="float: right"  name="submit" class="button" value="Save Details">Save Details</button>
                </div>
            </form>
        </div>
    </div>


    <div class="rowCard1">
        <div class="ImgContainer">
            <img src="img/1.png" style="width: 50%;" alt="Avatar">
        </div>

        <p style="font-size: XX-large; text-align: left"> Welcome, <?php echo $row['f_name'] ?>  <?php echo $row['l_name'] ?></p>

        <table style="width:50%">
            <tr>
                <td><p class="fas fa-briefcase  EDetails">Electrician</p></td>
                <td><p class="fas fa-home  EDetails"><?php echo $row['u_state'] ?></p></td>
                <td><p class="fas fa-envelope  EDetails"><?php echo $row['email'] ?></p></td>
                <td><p class="fas fa-phone   EDetails"><?php echo $row['hp'] ?></p></td>
            </tr>
        </table>

        <input style="float: right" onclick="on('<?php echo $row["email"]; ?>','<?php echo $row["hp"];?>','<?php echo $row["address"];?>','<?php echo $row["postcode"];?>','<?php echo $row["city"];?>','<?php echo $row["u_state"]; ?>')"  class="button"  type="submit" name="submit" value="Edit My Details">
    </div>


    <div class="rowPersonal">

        <div class="column3Personal">
            <div class="cardPersonal">
                <h2><i class="fa fa-home fa-fw headingTitle "></i>Address</h2>
                <p><?php echo $row['address'] ?>, <?php echo $row['postcode'] ?>  <?php echo $row['city'] ?>, <?php echo $row['u_state'] ?></p>
                <br>
                <h2><i class="fa fa-phone  headingTitle"></i>Mobile Number</h2>
                <p><?php echo $row['hp']?></p>
                <br>
                <h2><i class="fa fa-envelope  headingTitle"></i>Email</h2>
                <p><?php echo $row['email']?></p>
            </div>
        </div>
        <?php

        }
        }
        }
        ?>

    </div>

    <script>
        function off() {
            document.getElementById("overlay").style.display = "none";
        }

        function on(email,hp,add,postcode,city,state) {
            document.getElementById("email").innerHTML=email;
            document.getElementById("hp").innerHTML=hp;
            document.getElementById("add").innerHTML=add;
            document.getElementById("postcode").innerHTML=postcode;
            document.getElementById("city").innerHTML=city;
            document.getElementById("state").innerHTML=state;
            document.getElementById("overlay").style.display = "block";
        }

    </script>
</body>
</html>

