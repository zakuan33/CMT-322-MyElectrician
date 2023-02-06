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
<body style="background-color: #ffffff">

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
      background: #ffffff;
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
                if(isset($_GET['jobid'])) {

                    $job_id=$_GET['jobid'];

                    //this one from job table

                    // connect to database myelectrician
                    $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");

                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }


                        $fetch2 = "SELECT * FROM job WHERE idJob='$job_id'";
                        $result2 = $connection->query($fetch2);

                        $fetch = "SELECT * FROM appliedjobs WHERE idJob='$job_id' AND status='Accepted'";
                        $result = $connection->query($fetch);
                        $print = $result->fetch_assoc();

                        $elecid=$print['ElectricianID'];

                        $fetch3 = "SELECT * FROM electrician WHERE id='$elecid'";
                        $result3 = $connection->query($fetch3);
                        $print3 = $result3->fetch_assoc();


                        while($print2 = $result2->fetch_assoc()) {?>
                            <div>

                                <a class="list-group-item list-group-item-action " aria-current="true">
                                    <div style="background-color: #182a69; color: white;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                        <div style="padding: 20px;">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 style="font-family: 'Times New Roman'; font-weight: bold"  class="mb-1">JOB DETAIL </h5>
                                            </div>
                                            <br>
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
                                        <h5 style="font-family: 'Times New Roman'; font-weight: bold;" class="mb-1">ELECTRICIAN THAT IS CURRENT WORKING ON THIS TASK </h5>
                                    </div>
                                    <br>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"> Name&emsp;&emsp;&emsp;&emsp;&emsp; : <?php echo $print3['f_name'];?>    <?php echo $print3['l_name'];?> </h5>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"> Phone&emsp;&emsp;&emsp;&emsp;&emsp;:+6<?php echo $print3['hp'];?></h5>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"> Email&emsp;&emsp;&emsp;&emsp;&emsp;  :<?php echo $print3['email'];?></h5>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"> Qualification&emsp;&emsp;:<?php echo $print3['qualification'];?></h5>
                                    </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php }

                    $connection->close();}?>
            </div>
        </div>
    </div>
</body>
</html>