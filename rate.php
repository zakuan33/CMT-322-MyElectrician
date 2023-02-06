<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv=" X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title> My Electricians </title>

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

<div class="headertop"  style="background-image: url('img/bg7.png');">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
        <h1 style="margin-top: 30px;">My Electrician</h1>
    </div>
</div>

<style>
    .hover-custom_posted:hover{
        background: #0d6efd !important;
        color: white;

    }
</style>

<div class="topnav" id="topnav">

    <a href="logout.php">Log Out</a>
    <a href="personalEmployer.php">Personal</a>
    <a href="about2.php">About Us</a>
    <a href="posted.php">Job</a>
</div>



<!--White boc Background-->
<div style="
      background: white;
      margin: 50px;
      padding: 10px;
      border-radius: 10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

    <!--Navs&tabs for type of tasks-->


<!--    rating page-->
    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <!--List of posted tasks-->
            <div class="list-group">
                <?php
                if(isset($_GET['jobid'])) {
                    $job_id=$_GET['jobid'];?>
                    <?php //this one from job table

                    // connect to database myelectrician
                    $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }
                    else
                    {

                        $fetch = "SELECT * FROM appliedjobs WHERE idJob='$job_id' AND status='Accepted'";
                        $result = $connection->query($fetch);

                        $fetch2 = "SELECT * FROM job WHERE idJob='$job_id'";
                        $result2 = $connection->query($fetch2);
                        $print2 = $result2->fetch_assoc();


                        //to print the all the data on table 'teks' that is fetched
                        if(mysqli_num_rows($result)>0)
                        {
                            while($print = $result->fetch_assoc()) {


                                $elecid=$print['ElectricianID'];

                                $fetch3 = "SELECT * FROM electrician WHERE id='$elecid'";
                                $result3 = $connection->query($fetch3);
                                $print3 = $result3->fetch_assoc();

                                ?>
                                    <div >
                                        <a class="list-group-item list-group-item-action " aria-current="true">

                                            <div style="background-color: #182a69; color: white;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                <div style="padding: 20px;">

                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 style="font-family: 'Times New Roman'; font-weight: bold;" class="mb-1">JOB DETAIL </h5>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"> Title&ensp;&emsp;&emsp;&emsp;: <?php echo $print2['TaskName'];?></h5>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"> Description : <?php echo $print2['Description'];?></h5>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"> Address &emsp;&ensp;: <?php echo $print2['Address'];?></h5>
                                            </div>
                                                </div>
                                            </div>
                                            <div style="background-color: #cad5e7;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                <div style="padding: 20px;">

                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 style="font-family: 'Times New Roman'; font-weight: bold;" class="mb-1">ELECTRICIAN THAT HAVE COMPLETED THIS TASK </h5>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"> Name&emsp;&emsp;&emsp;: <?php echo $print3['f_name'];?>    <?php echo $print3['l_name'];?></h5>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"> Phone&emsp;&emsp;&emsp;:+6<?php echo $print3['hp'];?></h5>
                                            </div>
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                <?php }}?>
                        <br>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <?php

                            ?>


                            <button style="margin-left: 20px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rate">
                                Rate
                            </button>
                            <button style="margin-left: 20px;" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewrate">
                                View Rate
                            </button>
                        </ul>


<!--                        post rating-->
                        <div class="modal fade" id="rate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- <form method="POST" action="rateconnect.php?"> -->
                                    <form method="POST">
                                        <?php
                                        if(isset($_POST['submit'])) {
                                            $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                                            if ($connection->connect_error) {
                                                die("Connection failed: " . $connection->connect_error);
                                            } else {
                                                $get = "SELECT * FROM rating WHERE idJob='$job_id'";
                                                $result5 = $connection->query($get);
                                                $print5 = $result5->fetch_assoc();
                                                if (mysqli_num_rows($result5) == 0) {

                                                    $rate = filter_input(INPUT_POST, 'rate');
                                                    $description = filter_input(INPUT_POST, 'description');


                                                    $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");

                                                    if (mysqli_connect_error()) {
                                                        die('Connection Error (' . mysqli_connect_error() . ')' . mysqli_connect_error());
                                                    } else {
                                                        $text = "INSERT INTO rating (idJob,rate,description)
                                                                VALUES ('$job_id','$rate','$description')";
                                                        $data = mysqli_query($connection, $text);
                                                    }

                                                    echo '<script>alert("Electrician Rated Successfully")</script>';
                                                    echo "<script>location.href ='rate.php?jobid=$job_id'</script>";
                                                    exit();
                                                } else {
                                                    echo '<script>alert("You have already rated.")</script>';
                                                    echo "<script>location.href ='rate.php?jobid=$job_id'</script>";
                                                    exit();
                                                }

                                            }
                                        }
                                        ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Rate the elelctrician here</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rate</span>
                                                <select name="rate" class="form-select" id="rate" required="">
                                                    <option value="">Choose...</option>
                                                    <option value="EXCELLENT">EXCELLENT</option>
                                                    <option value="GOOD">GOOD</option>
                                                    <option value="MODERATE">MODERATE</option>
                                                    <option value="BAD">BAD</option>
                                                    <option value="VERY BAD">VERY BAD</option>

                                                </select>
                                            </div>

                                            <div class="input-group">
                                                <span class="input-group-text">Description</span>
                                                <textarea name="description" class="form-control" aria-label="With textarea" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name= "submit" class="btn btn-primary" value="save">Post</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>




<!--                        view rating-->
                        <div class="modal fade" id="viewrate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left: -5vw;">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width: 700px;">

                                    <?php
                                    $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                                    if ($connection->connect_error) {
                                        die("Connection failed: " . $connection->connect_error);
                                    }
                                    else
                                    {

                                        $fetch = "SELECT * FROM rating WHERE idJob='$job_id' ORDER BY idrating DESC";
                                        $result = $connection->query($fetch);

                                        $fetch4 = "SELECT * FROM appliedjobs WHERE idJob='$job_id' AND status='Accepted'";
                                        //to make sure that the data is fetch in the database using $connection
                                        $result4 = $connection->query($fetch4);
                                        $print4 = $result4->fetch_assoc();

                                        $elecid=$print4['ElectricianID'];

                                        $fetch3 = "SELECT * FROM electrician WHERE id='$elecid'";
                                        $result3 = $connection->query($fetch3);
                                        $print3 = $result3->fetch_assoc();

                                        if($print = $result->fetch_assoc()) { ?>

                                            <a class="list-group-item list-group-item-action " aria-current="true">

                                                <hr style =" height:5px; background:black !important">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h4 class="mb-1"  style="margin-left: 20vw;">RATING </h4>
                                                </div>
                                                <br>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <pre><h5 class="mb-1"> Electrician Name         : <?php echo $print3['f_name'];?> <?php echo $print3['l_name'];?></h5></pre>
                                                </div>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <pre> <h5 class="mb-1"> Electrician Phone        :+6<?php echo $print3['hp'];?></h5></pre>
                                                </div>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <pre><h5 class="mb-1"> Rate         : <?php echo $print['rate'];?></h5></pre>
                                                </div>
                                                <div class="d-flex w-100 justify-content-between">
                                                    <pre><h5 class="mb-1"> Description  : <?php echo $print['description'];?></h5></pre>
                                                </div>
                                            </a>


                                        <?php }
                                        else{?>
                                            <a class="list-group-item list-group-item-action " aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">THIS WORKER HAS NOT BEEN RATED YET</h5>
                                                </div>
                                            </a>

                                        <?php }


                                    }?>

                                </div>
                            </div>
                        </div>
                    <?php }$connection->close();}?>
            </div>
        </div>
    </div>
</body>
</html>