<?php

if(!isset($_SESSION)) {
    session_start();
    $connect=mysqli_connect("localhost","root","Gi07Vi17", "myelectrician");
}
?>
<?php

$servername = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";
$success = "false";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$job_id=$_GET['jobid'];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="elec_pg1.css">

    <style>
        .pay_box{
            font-family: Arial;
            margin-top: 40px;
            margin-bottom: 90px;
            margin-left: 100px;
            height: 500px;
            width: 1300px;
            background-color: #e2e2e2;
            border-radius: 10px;
            padding:10px;
            box-shadow: 0 8px 16px 0 rgba(47, 45, 45, 0.5);
            border-color: #ffffff; ;
        }
        .pay_box:hover{
            box-shadow: 0 8px 16px 0 rgba(19, 19, 19, 0.7);
        }
        .pay_box .col-300{
            color: white;
            text-align: center;
            width:500px;
            height: 500px;
            background-color: #24265d;
            border-radius: 10px;
            float: left;
        }
        .pay_box .col-600{
            margin-left: 10px;
            width: 780px;
            height: 490px;
            float: left;
            background-color: white;
            border-radius: 10px;
            padding: 5px;
        }
        .col-600 .col-100{
            background-color: #ffffff;
            font-weight: bold;
            float: left;
            width: 45px;
            height: 20px;
            padding: 7px;
        }

        .col-200 input[type="text"]{
            background-color: #f2f8ff;
            font-weight: bold;
            float: left;
            width: 120px;
            height: 30px;
            border-radius: 5px;
            padding-left: 10px;
        }
        .col-400 input[type="text"]{
            background-color: #f2f8ff;
            font-weight: bold;
            float: left;
            width: 620px;
            height: 30px;
            border-radius: 5px;
            padding-left: 10px;
            margin-top:25px; ;
            display: flex;
        }
        #Pay:hover{
            /*background-color: #04AA6D;*/
            /**/
            background-color: #9995ec;
            color: rgb(255, 255, 255);
            font-weight: bold;
            box-shadow: 0 8px 16px 0 rgba(19, 19, 19, 0.2);
        }

    </style>

</head>
<body>

<div class="header">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
        <h1 style="margin-top: 30px;">My Electrician</h1>
    </div>
</div>

<div class="topnav" id="topnav">

    <a href="logout.php">Sign Out</a>
    <a href="about2.php">About Us</a>
    <a href="PersonalEmployer.php">Personal</a>
    <a aria-current="page" href="posted.php">Job</a>

</div>
<h1 style="text-align: center">Payment</h1>
<div class="pay_box">
    <?php

    $sqlquery="SELECT * FROM appliedjobs where idJob= '$job_id' and status='Accepted'";
    $result2 = mysqli_query($conn, $sqlquery);
    $row2 = mysqli_fetch_array($result2);

    $query= "SELECT * FROM job where idJob= '$job_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) > 0)
    {
        $date=$row["Date"];
        $date = explode('-', $date);
        $day = $date[0];
        $month= $date[1];
        $year= $date[2];

        if($month=='1')
        {$month='January';}
        elseif($month=='2')
        {$month='February';}
        elseif($month=='3')
        {$month='March';}
        elseif($month=='4')
        {$month='April';}
        elseif($month=='5')
        {$month='May';}
        elseif($month=='6')
        {$month='June';}
        elseif($month=='7')
        {$month='July';}
        elseif($month=='8')
        {$month='August';}
        elseif($month=='9')
        {$month='September';}
        elseif($month=='10')
        {$month='October';}
        elseif($month=='11')
        {$month='November';}
        elseif($month=='12')
        {$month='December';}
        ?>

        <div class="col-300">
            <h1><?php echo $row["TaskName"];?></h1>
            <h3>Category : <?php echo $row["Category"]?></h3>
            <img style="border-radius:10px; border-color:white; border-width: medium; border-style: solid; height: 300px; width: 400px; " src="<?php echo $row["Img"] ?>" class="img-responsive"/>
        </div>

        <div class="col-600">
            <div style="margin-left: 15px;">

                <h2 style="text-align: center;">Job & Electrician Details</h2>

                <div class="col-100">
                    <label>Date: </label>
                </div>

                <div class="col-200">
                    <input type="text" value="<?php echo $row["Date"]; ?>" readonly>
                </div>

                <div style=" width: 80px; margin-left: 60px;" class="col-100">
                    <label>Location: </label>
                </div>

                <div class="col-200">
                    <input type="text" value="<?php echo $row["Location"]; ?>" readonly>
                </div>

                <div style="margin-left: 70px;" class="col-100">
                    <label>Time: </label>
                </div>

                <div class="col-200">
                    <input type="text" value="<?php echo $row["Time"]; ?>" readonly>
                </div>

            </div>

            <div style="margin-left: 15px;">
                <div style="width: 100px; margin-top: 25px;" class="col-100">
                    <label>Address: </label>
                </div>

                <div class="col-400">
                    <input type="text" value="<?php echo $row["Address"]; ?>" readonly>
                </div>
            </div>

            <div style="margin-left: 15px;">
                <div style="width: 100px; margin-top: 25px;" class="col-100">
                    <label>Description: </label>
                </div>

                <div class="col-400">
                    <input type="text" value="<?php echo $row["Description"]; ?>" readonly>
                </div>


            </div>



            <?php
            $elec_id=$row2["ElectricianID"];
            $query3="SELECT * FROM electrician where id= '$elec_id'";
            $result3 = mysqli_query($conn, $query3);
            $row3 = mysqli_fetch_array($result3);
            $arr = array($row3["f_name"],$row3["l_name"]);
            $elecname=join(" ",$arr);
            ?>
            <div style="margin-left: 15px;">
                <div style="width: 160px; margin-top: 25px;" class="col-100">
                    <label>Electrician Name: </label>
                </div>

                <div class="col-400">
                    <input style="width: 558px;" type="text" value="<?php echo $elecname; ?>" readonly>
                </div>

                <div style="width: 100px; margin-top: 15px;" class="col-100">
                    <label>Electrician Contact Number: </label>
                </div>

                <div class="col-400">
                    <input type="text" value="<?php echo $row3["hp"]; ?>" readonly>
                </div>

                <div style="width: 100px; margin-top: 25px;" class="col-100">
                    <label>Electrician Fee: </label>
                </div>

                <div class="col-400">
                    <input type="text" value="RM  <?php echo $row2["fee"]; ?>" readonly>
                </div>
            </div>

            <a href="card.php?jobid=<?php echo $job_id?>" style="border-radius: 10px; margin-right: 15px;font-size: 16px;" type="submit" name="submit"  class="button button2" value="Pay" id="Pay">Pay</a>
        </div>
        <?php
    }
    ?>
</div>

</body>
</html>

