
<?php

if(!isset($_SESSION)) {
    session_start();
    $connect=mysqli_connect("localhost","root","Gi07Vi17", "myelectrician");
}
include('elec_pg1.php');
?>
<?php
$fee_err="";
$servername = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";
$success = "false";
$elecid = $_SESSION['user'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$idjob=0;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//
if(isset($_POST['submit'])=="Apply")
{

    $valid=true;
    if ($valid == true ) {
        $elecid = $_SESSION['user'];

        $jobid = $conn->real_escape_string($_POST["hidden_id"]);
        $empid = $conn->real_escape_string($_POST["hidden_empid"]);
        $fee = $conn->real_escape_string($_POST["fee"]);



        $sql = "INSERT INTO appliedjobs (idJob,EmployerID,ElectricianID,status,fee)
                    VALUES ('$jobid','$empid','$elecid','Pending','$fee')";
        if ($conn->query($sql) === TRUE) {
            $msg = "New record created successfully.!!!";
            ?>
            <script language=javascript>
                location.href="elec_pg1_extend.php";
            </script>

            <?php
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}
?>

<div class="col-75">
    <?php

    $query = "SELECT * FROM job";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $app_idJob=$row["idJob"];
            $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
            $result2 = mysqli_query($conn, $sqlquery);
            $accept=false;
            if(mysqli_num_rows($result2) > 0)
            {
                while($row2 = mysqli_fetch_array($result2))
                {
                    if($row2['status']=="Accepted")
                    {
                        $accept=true;
                    }
                    else{
                        $accept=false;
                    }
                }

            }
            $apply=true;
            $sqlquery3="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob' AND ElectricianID='$elecid'";
            $result3 = mysqli_query($conn, $sqlquery3);
            if(mysqli_num_rows($result3) > 0)
            {
                $apply=false;
            }

            if($accept==false && $apply==true)
            {
            ?>
            <div class="card">
                <div class="container">
                    <form method="post" action="elec_pg1_extend.php">

                        <img src="<?php echo $row["Img"]; ?>" class="img-responsive" /><br />
                        <h4 id="task" name="taskname" class="text-info"><?php echo $row["TaskName"]; ?></h4>
                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                        <p class="time">Time: <?php echo $row["Time"];?></p>
                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                        <label for="fee">Fee: RM </label>
                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee" required>
                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                    </form>
                    <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

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
