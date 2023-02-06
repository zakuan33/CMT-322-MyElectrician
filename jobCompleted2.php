<?php
if (!isset($_SESSION)) {
    session_start();
}
$hostname = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";

$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");

//$value = $_SESSION['user'];
//$User = $value;

function function_alert($message)
{
    // Display the alert box
    echo "<script>alert('$message');</script>";
}

$success = "";

$electricianID = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyElectrician</title>
    <link rel="shortout icon" type="image/x-icon" href="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="jobs2.css">
    <link rel="stylesheet" href="jobBooking.css">
</head>
<body>
<div class="header">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview%20(1).png">
        <h1 style="margin-top: 30px;">My Electrician</h1>
    </div>
</div>

<div class="topnav" id="topnav">

    <a href="logout.php">Log Out</a>
    <a href="personalElectrician.php">Personal</a>
    <a href="about.php">About</a>
    <div class="dropdown">
        <button class="dropbtn">Job
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="elec_pg1_extend.php">Available task</a>
            <a href="applied_task_extend3.php?status=Accepted">Applied task</a>
            <a href="jobCompleted2.php">Completed task</a>
        </div>
    </div>

    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>

<div class="col-25" style="  margin-left: 30px; margin-top: 40px;">
    <div class="sidenav" id="sidenav">
        <h1>Your job choice</h1>
        <h2> Filter your desired jobs here! </h2>
        <br>
        <form method="post" action="jobCompleted2.php ">

            <p><label for="Payment">Payment Status:</label></p>
            <select name="Payment" id="Payment" >
                <option name="Payment" value="Show All">Show All</option>
                <option name="Payment" value="Pending">Payment Pending</option>
                <option name="Payment" value="Settle">Payment Done</option>
            </select>

            <p><label for="Category">Job scope:</label></p>
            <select name="Category" id="category">
                <option name="Category" value="Show All">Show All</option>
                <option name="Category" value="Installation">Installation</option>
                <option name="Category" value="Repairing">Repairing</option>
                <option name="Category" value="Wiring">Wiring</option>
                <option name="Category" value="Others">Others</option>
            </select>

            <p><label><i></i> Date:</label></p>
            <input  type="date" placeholder="DD MM YYYY" name="Date" value="Date">

            <p><button  type="submit" name="submit" value="Search"><i ></i> Search</button></p>

        </form>
        </form>
    </div>

</div>

<div id="overlay">
    <div class="overlay_form">
        <i class="fa fa-close" style="font-size:24px;color:red; position: absolute;margin-left: 430px;" onclick="off()"></i>
        <div class="overlay-inner">

            <h2 style="margin-top: 2px; margin-bottom: 1px;" id="job_name"></h2>
            <p style="margin-bottom: 2px;" id="emp_id"></p>

            <div class="col-25">
                <label for="date">Date: </label>
                <div style="width: 100px;" class="box">
                    <p id="date" name="date"></p>
                </div>
            </div>

            <div class="col-65">
                <label for="time">Time: </label>
                <div style="width: 100px;" class="box">
                    <p id="time" name="time"></p>
                </div>
            </div>

            <br>
            <label for="loc">Location: </label>
            <div class="box">
                <p id="loc" name="loc"></p>
            </div>
            <br>
            <label for="add">Address: </label>
            <div class="box">
                <p id="add" name="add"></p>
            </div>

            <br>
            <label for="desc">Description: </label>
            <div class="box">
                <p id="desc" name="desc"></p>
            </div>

            <br>
            <label for="rev">Reviews: </label>
            <div class="box">
                <p id="rev" name="rev"></p>
            </div>

            <br>
            <label for="rate">Ratings: </label>
            <div class="box">
                <p id="rate" name="rate"></p>
            </div>

        </div>
    </div>
</div>


<div style="padding-left:500px">

    <div style="padding-left:300px">
        <h2 style="font-size:2vw">Jobs Completed</h2>
    </div>
    <div class="col-75" style="background-color: #edeff5; padding-left: 20px;">

        <?php
        $electricianID = $_SESSION['user'];

        $query = "SELECT * FROM appliedjobs where ElectricianID='$electricianID'";
        $resulte = mysqli_query($connection, $query);

        if(mysqli_num_rows($resulte) > 0)
        {
            while($rowe = mysqli_fetch_array($resulte))
            {
                if($rowe ['ElectricianID'] == $electricianID)
                {
                    $jobsAppliedID = $rowe['idappliedjobs'];
                    $jobApplied_jobID = $rowe['idJob'];

                    if(isset($_POST['submit'])=="Search")
                    {
                        $payment = $connection->real_escape_string($_POST['Payment']);
                        $category = $connection->real_escape_string($_POST['Category']);
                        $date = $connection->real_escape_string($_POST['Date']);

                        if(!(empty($date)))
                        {
                            $date = explode('-', $date);
                            $day = $date[2];
                            $month= $date[1];
                            $year= $date[0];
                            $date=$day.'-'.$month.'-'.$year;
                        }

                        if($payment == "Show All")
                        {
                            if((empty($date)) && ($category == "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardView.php';
                                    }
                                }
                            }
                            elseif((!(empty($date))) && ($category == "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Date='$date'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardView.php';
                                    }
                                }
                            }
                            elseif((!(empty($date))) && ($category != "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Category='$category' and Date='$date'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardView.php';
                                    }
                                }
                            }
                            elseif((empty($date)) && ($category != "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Category='$category'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardView.php';
                                    }
                                }

                            }

                        }

                        elseif($payment == "Pending")
                        {
                            if((empty($date)) && ($category == "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPP.php';
                                    }
                                }
                            }
                            elseif((!(empty($date))) && ($category == "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Date='$date'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPP.php';
                                    }
                                }
                            }
                            elseif((!(empty($date))) && ($category != "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Category='$category' and Date='$date'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPP.php';
                                    }
                                }
                            }
                            elseif((empty($date)) && ($category != "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Category='$category'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPP.php';
                                    }
                                }

                            }

                        }

                        elseif($payment == "Settle")
                        {
                            if((empty($date)) && ($category == "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPS.php';
                                    }
                                }
                            }
                            elseif((!(empty($date))) && ($category == "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Date='$date'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPS.php';
                                    }
                                }
                            }
                            elseif((!(empty($date))) && ($category != "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Category='$category' and Date='$date'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPS.php';
                                    }
                                }
                            }
                            elseif((empty($date)) && ($category != "Show All")){

                                $query = "SELECT * FROM job where idJob='$jobApplied_jobID' and Category='$category'";
                                $result = mysqli_query($connection, $query);

                                if(mysqli_num_rows($result) > 0)
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        include 'jobCompletedCardViewPS.php';
                                    }
                                }

                            }
                        }

                    }

                    else

                    {
                        $query = "SELECT * FROM job where idJob='$jobApplied_jobID'";
                        $result = mysqli_query($connection, $query);

                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_array($result))
                            {
                                $query = "SELECT * FROM status where idappliedjobs='$jobsAppliedID'";
                                $resultR = mysqli_query($connection, $query);

                                if(mysqli_num_rows($resultR) > 0)
                                {
                                    while($rowR = mysqli_fetch_array($resultR))
                                    {
                                        include 'jobCompletedCardView.php';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        ?>
    </div>
</div>


<script>

    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("sidenav");
    // var navbari = document.getElementById("topnav");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }

    function off() {
        document.getElementById("overlay").style.display = "none";
    }

    function on(id,taskname,date,time,loc,desc,add,emp_id,rev,rate) {
        document.getElementById("job_name").innerHTML=taskname;
        document.getElementById("date").innerHTML=date;
        document.getElementById("time").innerHTML=time;
        document.getElementById("loc").innerHTML=loc;
        document.getElementById("desc").innerHTML=desc;
        document.getElementById("add").innerHTML=add;
        document.getElementById("emp_id").innerHTML=emp_id;
        document.getElementById("rev").innerHTML=rev;
        document.getElementById("rate").innerHTML=rate;
        document.getElementById("overlay").style.display = "block";
    }
</script>

</body>
</html>
