<?php
if(!isset($_SESSION)) {
    session_start();
    $connect=mysqli_connect("localhost","root","Gi07Vi17", "myelectrician");
}


include('applied_task.php');

//$status= $_GET["status"];
$servername = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";
$success = "false";
$conn = new mysqli($servername, $username, $password, $dbname);
$idjob=0;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getMonth($month)
{
    if($month=='1')
    {$rmonth='January';}
    elseif($month=='2')
    {$rmonth='February';}
    elseif($month=='3')
    {$rmonth='March';}
    elseif($month=='4')
    {$rmonth='April';}
    elseif($month=='5')
    {$rmonth='May';}
    elseif($month=='6')
    {$rmonth='June';}
    elseif($month=='7')
    {$rmonth='July';}
    elseif($month=='8')
    {$rmonth='August';}
    elseif($month=='9')
    {$rmonth='September';}
    elseif($month=='10')
    {$rmonth='October';}
    elseif($month=='11')
    {$rmonth='November';}
    elseif($month=='12')
    {$rmonth='December';}

    return $rmonth;
}


if(isset($_POST['jobdone'])=='JobCompleted')
{
    $idappliedjobs = $conn->real_escape_string($_POST["idappliedjobs"]);
    $sql = "UPDATE status SET JobStatus='Completed' WHERE idappliedjobs='$idappliedjobs'";

    if ($conn->query($sql) === TRUE) {
        $msg = "New record created successfully!";
        ?><script language=javascript>
            alert("New record created successfully!");
            location.href="applied_task_extend3.php?status=Accepted";
        </script><?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<div class="bar_outerlayer" style="margin-top: 30px;">

    <div id="status_nav"  style="margin-top: 30px;">
        <a href="applied_task_extend3.php?status=Accepted" class="status_btn active"  type="button" name="submit" value="Accepted">Accepted</a>
        <a href="applied_task_extend3.php?status=Rejected" class="status_btn"  type="button" name="submit" value="Rejected">Rejected</a>
        <a href="applied_task_extend3.php?status=Pending" class="status_btn"  type="button" name="submit" value="Pending">Pending</a>
    </div>
<br><br>
<?php
$status=$_GET['status'];
$_SESSION['status']=$status;
$elecid = $_SESSION['user'];
$query = "SELECT fee,idJob,status,idappliedjobs FROM appliedjobs where ElectricianID='$elecid'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        $fee=$row["fee"];
        $Jobid=$row["idJob"];
        $stat=$row["status"];
        $appliedjobid=$row["idappliedjobs"];

        $sqlquery= "SELECT * FROM job where idJob= '$Jobid'";
        $result2 = mysqli_query($conn, $sqlquery);
        $row2 = mysqli_fetch_array($result2);
        $complete=false;

        if($stat=="Accepted") {

            $sqlquery3 = "SELECT * FROM status where idappliedjobs= '$appliedjobid'";
            $result3 = mysqli_query($conn, $sqlquery3);
            $row3 = mysqli_fetch_array($result3);
            $jobDone = $row3["JobStatus"];
            if($jobDone=="Completed")
            {
                $complete=true;
            }
        }

        if($stat==$status && $complete==false)
        {
            if(mysqli_num_rows($result2) > 0)
            {
                $date=$row2["Date"];
                $date = explode('-', $date);
                $day = $date[0];
                $month= $date[1];
                $year= $date[2];
                $month=getMonth($month);
                ?>
                <div class="bar">
                    <div class="bar_container">
                        <form method="post" action="applied_task_extend3.php">
                        <div class="bar_col10">
                            <div class="date_box">
                                <h3><?php echo $day; ?></h3>
                                <h4><?php echo $month; ?></h4>
                            </div>
                        </div>

                        <div class="bar_col20">
                            <h2><?php echo $row2["TaskName"];?></h2>
                            <div>
                                <label style="display: inline; font-weight: bold">Location : </label>
                                <p style="display: inline;"><?php echo $row2["Location"];?></p>
                            </div>

                            <div style="margin-top: 10px;">
                                <label style="display: inline; font-weight: bold;">Time : </label>
                                <p style="display: inline; font-weight: bold"><?php echo $row2["Time"];?></p>
                            </div>
                        </div>

                        <div class="bar_col80">
                            <div>
                                <label style=" font-weight: bold;font-size: 15px; color: black;display: inline;  " >Fee : RM</label>
                                <p style="font-weight: bold;color: #000000;display: inline; "><?php echo $fee; ?></p>
                            </div>
                            <div style="margin-top: 10px;">
                                <label style=" font-weight: bold;font-size: 15px; color: black;display: inline;  " >Status : </label>
                                <p style="font-weight: bold;color: #000000;display: inline; "><?php echo $status ?></p>
                            </div>
                        </div>
                            <input type="hidden" name="idappliedjobs" value="<?php echo $row["idappliedjobs"]; ?>">
                        <div class="bar_col100">
                            <div class="bar_details">
                                <?php

                                if($status=='Accepted')
                                {
                                    ?>
                                    <input class="details_btn"  type="submit" name="jobdone" value="JobCompleted" id="JobCompleted">
                                    <br>
                                    <a onclick="on('<?php echo $row2["idJob"]; ?>','<?php echo $row2["TaskName"]; ?>',
                                            '<?php echo $row2["Date"];?>','<?php echo $row2["Time"];?>','<?php echo $row2["Location"];?>',
                                            '<?php echo $row2["Description"];?>','<?php echo $row2["Address"];?>','<?php echo $row2["EmployerID"];?>')"
                                       style="color: #ff0000;" type="submit" name="submit"> Click to view details</a>

                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        </form>


                        <?php
                        if(($status=='Rejected') OR ($status=='Pending')  )
                        {
                            ?>
                        <div class="bar_col100">
                            <div class="bar_details">
                            <input onclick="on('<?php echo $row2["idJob"]; ?>','<?php echo $row2["TaskName"]; ?>',
                                    '<?php echo $row2["Date"];?>','<?php echo $row2["Time"];?>','<?php echo $row2["Location"];?>',
                                    '<?php echo $row2["Description"];?>','<?php echo $row2["Address"];?>','<?php echo $row2["EmployerID"];?>')"
                                   class="details_btn"  type="submit" name="submit"  value="View All Details">
                            </div>
                        </div>
                            <?php
                        }

                        ?>

                    </div>
                </div>



                <?php
            }
        }
    }
}

?>
</div>
<script>

    function off() {
        document.getElementById("overlay").style.display = "none";
    }

    function on(id,taskname,date,time,loc,desc,add,emp_id) {
        document.getElementById("job_name").innerHTML=taskname;
        document.getElementById("date").innerHTML=date;
        document.getElementById("time").innerHTML=time;
        document.getElementById("loc").innerHTML=loc;
        document.getElementById("desc").innerHTML=desc;
        document.getElementById("add").innerHTML=add;
        document.getElementById("emp_id").innerHTML=emp_id;
        document.getElementById("overlay").style.display = "block";
    }

</script>