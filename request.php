<?php
ob_start();
$connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if(isset($_POST['reject']) ) {



    $job_id= $connection->real_escape_string($_POST['job_id']);
    $request_id= $connection->real_escape_string($_POST['req_id']);
    $fetch = "UPDATE appliedjobs SET status='Rejected' WHERE idappliedjobs='$request_id' " ;
    //to make sure that the data is fetch in the database using $connection



    if (mysqli_query($connection, $fetch)) {
        echo '<script>alert("Electrician Rejected Successfully")</script>';
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
    echo "<script>location.href ='request.php?jobid=$job_id'</script>";

}

if(isset($_POST['accept']) ) {

    $request_id= $connection->real_escape_string($_POST['req_id']);
    $job_id= $connection->real_escape_string($_POST['job_id']);

    $fetch = "UPDATE appliedjobs SET status='Accepted' WHERE idappliedjobs='$request_id' " ;
    $fetch2 = "UPDATE appliedjobs SET status='Rejected' WHERE idJob='$job_id' AND status='Pending' " ;

    $fetch3="INSERT INTO status(idappliedjobs,JobStatus, PaymentStatus)
                VALUES('$request_id', 'Pending','Pending') ";
//    $fetch3 = "UPDATE job SET status='pending' WHERE jobid='$job_id' " ;
    //to make sure that the data is fetch in the database using $connection


    if ($connection->query($fetch) === TRUE) {
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
    if ($connection->query($fetch2) === TRUE) {
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
    if ($connection->query($fetch3) === TRUE) {
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
    echo "<script>location.href ='posted.php?jobid=$job_id'</script>";

}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv=" X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyElectrician</title>
    <link rel="shortout icon" type="image/x-icon" href="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="elec_pg1.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body style="background-color: #f1f1f1">
<div class="header">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview%20(1).png">
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

<br>
<div class=" text-center rounded mb-5 text-black">
    <h1 class="mb-3 h2">APPLICANTS LIST</h1>
    <p> Find best electricians near you! </p>
</div>
<!--White boc Background-->
<div style=" background-color: #24265d;margin: 50px; padding: 10px;border-radius: 10px ; box-shadow: 10px 15px 15px 0 rgba(0,0,0,0.2); /* shadow for box*/">

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

            <!--List of posted tasks-->
            <div class="list-group">
                <?php
                if(isset($_GET['jobid'])) {
                    $job_id=$_GET['jobid'];

                    // connect to database myelectrician
                    $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }
                    else
                    {
                        $fetch = "SELECT * FROM appliedjobs WHERE idJob='$job_id' AND status='Pending'";
                        //to make sure that the data is fetch in the database using $connection
                        $result = $connection->query($fetch);
                        $fetch2 = "SELECT * FROM job WHERE idJob='$job_id'";
                        $result2 = $connection->query($fetch2);
                        //to print the all the data on table 'teks' that is fetched
                        while($print2 = $result2->fetch_assoc()) {?>
                            <div >
                                <a class="list-group-item list-group-item-action " aria-current="true" style="background-color: #bcbbbb">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">JOB DETAIL </h5>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"> Title&ensp;&emsp;&emsp;&emsp;: <?php echo $print2['TaskName'];?></h6>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"> Description : <?php echo $print2['Description'];?></h6>
                                    </div>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"> Address &emsp;&ensp;: <?php echo $print2['Address'];?></h6>
                                    </div>
                                </a>
                            </div>
                        <?php }

                        if(mysqli_num_rows($result)==0)
                        {
                            echo
                            '<div >
                                <a  class="list-group-item list-group-item-action " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"> No applicant for this job</h5>
                                
                                </div>
                                </a>
                                 </div>';
                        }
                        else{
                            echo '<a  class="list-group-item list-group-item-action " aria-current="true" style="background-color: #dddddd">
                                <div class="d-flex w-100 justify-content-between" >
                                     <h5 class="mb-1">APPLICATION LIST </h5>
                                 </div>
                                 </a>';
                            while($print = $result->fetch_assoc()) {
                                $elecid=$print['ElectricianID'];

                                $fetch3 = "SELECT * FROM electrician WHERE id='$elecid'";
                                $result3 = $connection->query($fetch3);
                                $print3 = $result3->fetch_assoc();


                                ?>
                                <div >
                                    <a  class="list-group-item list-group-item-action hover-custom_posted" aria-current="true">

                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"> Name : <?php echo $print3['f_name'];?>    <?php echo $print3['l_name'];?></h5>
                                        </div>

                                        <span style="float:right" type="button"   >

                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn-group" role="group" aria-label="Basic example" method="POST">
                                                    <input type="hidden" name="req_id" value="<?php echo $print['idappliedjobs'];?>">
                                                    <input type="hidden" name="job_id" value="<?php echo $print['idJob'];?>">

                                                    <input type="submit" class="btn btn-danger" value="Reject" name="reject">
                                                    <input type="submit" class="btn btn-success" value="Accept" name="accept">
                                                 </form>
                                            </span>

                                        <!-- <span style="float:right" type="button" class="btn btn-secondary"  >
                                        Accept
                                        </span>  -->
                                        <small>Phone : +6<?php echo $print3['hp'] ;?></small>
                                        <br>
                                        <small>Fee : <?php echo $print['fee'] ;?></small>
                                        <br>
                                        <small>Qualification: <?php echo $print3['qualification'] ;?></small>
                                        <br>
                                        <small>Experience: <?php echo $print3['exper_duration'] ;?></small>
                                    </a>
                                </div>
                            <?php }}

                    }$connection->close();}?>
            </div>
        </div>
    </div>
</body>
</html>
