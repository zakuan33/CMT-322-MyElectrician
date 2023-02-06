<?php
ob_start();
$connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv=" X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyElectrician</title>
    <link rel="shortout icon" type="image/x-icon" href="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="posted.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
<div class="headertop" style="background-image: url('img/bg7.png');">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
        <h1 style="margin-top: 30px;">My Electrician</h1>
    </div>
</div>

<div class="topnav" id="topnav">

    <a href="logout.php">Sign Out</a>
    <a href="about.php">About Us</a>
    <a href="PersonalEmployer.php">Personal</a>
    <a aria-current="page" href="posted.php">Job</a>

</div>

<body style="background-color: #ececec">
<style>
    .hover-custom_posted:hover{
        background: #0d6efd !important;
        color: white;

    }
</style>



<!--White boc Background-->
<div style="
      background: #20364f;
      margin: 50px;
      padding: 10px;
      border-radius: 10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

    <!--Navs&tabs for type of tasks-->

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <!--List of posted tasks-->
            <div class="list-group">
                <?php
                $job_id=$_GET['jobid'];
                //this one from job table

                // connect to database myelectrician
                $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $fetch = "SELECT * FROM job WHERE idjob='$job_id'";
                $result = $connection->query($fetch);
                $print = mysqli_fetch_array($result);

                $fetch2 = "SELECT * FROM appliedjobs WHERE idJob='$job_id' AND status='Accepted'";
                $result2 = $connection->query($fetch2);
                $print2 = mysqli_fetch_array($result2);
                $electid2= $print2['ElectricianID'];
                $fee = $print2['fee'];

                //to print the all the data on table 'teks' that is fetched
                ?>

                <form method="POST">
                    <?php
                    if(isset($_POST['submit'])){
                        $card_number = filter_input(INPUT_POST, 'card_number');
                        $card_cvv = filter_input(INPUT_POST, 'card_cvv');
                        $card_expired = filter_input(INPUT_POST, 'card_expired');
                        $card_name = filter_input(INPUT_POST, 'card_name');


                        $text = "INSERT INTO payment (idJob, ElectricianID, card_number, card_expired, card_CVV, card_name, AmountPaid) 
                                    VALUES ('$job_id','$electid2','$card_number', '$card_expired' , '$card_cvv' , '$card_name','$fee')";
                        if ($connection->query($text) === TRUE) {
                            $request_id= $connection->real_escape_string($_POST['req_id']);
                            $job_id= $connection->real_escape_string($_POST['job_id']);

                            $fetch = "UPDATE status SET paymentStatus='Completed' WHERE idappliedjobs='$request_id' ";
                            //to make sure that the data is fetch in the database using $connection

                            if ($connection->query($fetch) === TRUE) {
                                echo '<script>alert("Payment Successful")</script>';
                                echo "<script>location.href ='posted.php'</script>";
                            } else {
                                echo "Error updating record: " . $connection->error;
                            }
                        }
                        else {
                            echo "Error inserting table: " . $connection->error;
                        }

                    }
                    ?>
                    <div class="modal-body">
                        <div class="input-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Card Number</span>
                                <input type="card_number" class="form-control" placeholder="XXXX XXXX XXXX XXXX" aria-label="card_number" name="card_number" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Expiry Date</span>
                                <input type="card_expired" class="form-control" placeholder="e.g 11/22" aria-label="card_expired" name="card_expired" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">CVV</span>
                                <input type="card_cvv" class="form-control" placeholder="e.g 123" aria-label="card_cvv" name="card_cvv" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Name on Card</span>
                                <input type="card_name" class="form-control"  aria-label="card_name" name="card_name" required>


                            </div>
                            <div class="modal-footer">

                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn-group" role="group" aria-label="Basic example" method="POST">
                                    <input type="hidden" name="req_id" value="<?php echo $print2['idappliedjobs'];?>">
                                    <input type="hidden" name="job_id" value="<?php echo $print2['idJob'];?>">
                                    <input type="submit" class="btn btn-primary" value="Post" name="submit">
                                </form>
                            </div>
                </form>

                <?php

                $connection->close();?>
            </div>
        </div>
    </div>
</body>
</html>