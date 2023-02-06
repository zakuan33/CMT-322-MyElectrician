<?php


if(!isset($_SESSION)) {
    session_start();
    $connect=mysqli_connect("localhost","root","Gi07Vi17", "myelectrician");
}
include('elec_pg1.php');
?>
<?php
$servername = "localhost";
$username = "root";
$password = "Gi07Vi17";
$dbname = "myelectrician";
$success = "false";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$idjob=0;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])=="Apply")
{
    $valid=true;
    if (empty($_POST["fee"])) {
        $fee_err = "*Please enter the fee";
        $valid = false;
    }
    if ($valid == true ) {
        $elecid = $_SESSION['user'];
        $jobid = $conn->real_escape_string($_POST["hidden_id"]);
        $empid = $conn->real_escape_string($_POST["hidden_empid"]);
        $fee = $conn->real_escape_string($_POST["fee"]);

        $sql = "INSERT INTO appliedjobs (idJob,EmployerID,ElectricianID,status,fee)
                            VALUES ('$jobid','$empid','$elecid','null','$fee')";
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
    if(isset($_POST['submit'])=="Search")
    {
        $category = $conn->real_escape_string($_POST['Category']);
        $date = $conn->real_escape_string($_POST['Date']);
        $location_city = $conn->real_escape_string($_POST['City']);
        $location_state = $conn->real_escape_string($_POST['State']);
        
        if(!(empty($date)))
        {
            $date = explode('-', $date);
            $day = $date[2];
            $month= $date[1];
            $year= $date[0];
            $date=$day.'-'.$month.'-'.$year;
        }

        if ($category=="Show All")
        {
            if((empty($date)) && ($location_state == "None") && ($location_city == "City"))
            {
                $query = "SELECT * FROM job";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                        ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">

                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">
                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date)))  && ($location_state == "None") && ($location_city == "City"))
            {
                $query = "SELECT * FROM job where Date='$date'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

            elseif((empty($date))  && ($location_state != "None") && ($location_city == "City"))
            {
                $query = "SELECT * FROM job where state='$location_state'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

            elseif((empty($date))  && ($location_state == "None") && ($location_city != "City"))
            {
                $query = "SELECT * FROM job where City='$location_city'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date)))  && ($location_state != "None") && ($location_city == "City"))
            {
                $query = "SELECT * FROM job where Date='$date' and state='$location_state'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskbName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date)))  && ($location_state == "None") && ($location_city != "City"))
            {
                $query = "SELECT * FROM job where Date='$date' and City='$location_city'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

            elseif((empty($date))  && ($location_state != "None") && ($location_city != "City"))
            {
                $query = "SELECT * FROM job where jobtate='$location_state' and jobCity='$location_city'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date)))  && (!$location_state == "None") && ($location_city != "City"))
            {
                $query = "SELECT * FROM job where jobDate='$date' and jobtate='$location_state' and jobCity='$location_state'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>
                        <?php
                        }
                    }
                }
            }

        }

        elseif ($category != "Show All")
        {
            if((empty($date)) && ($location_state == "None") && ($location_city == "City"))
            {
                $query = "select * from job where Category = '$category'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date))) && ($location_state == "None") && ($location_city == "City"))
            {
                $query = "select *from job where Category = '$category' and Date = '$date'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
                }
            }

            elseif((empty($date)) && ($location_state != "None") && ($location_city == "City"))
            {
                $query = "select *from job where Category = '$category' and state = '$location_state'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
                }
            }

            elseif((empty($date)) && ($location_state == "None") && ($location_city != "City"))
            {
                $query = "select *from job where Category = '$category' and City = '$location_city'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date))) && ($location_state != "None") && ($location_city == "City"))
            {
                $query = "select *from job where Category = '$category' and Date = '$date' and state='$location_state'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date))) && ($location_state == "None") && ($location_city != "City"))
            {
                $query = "select *from job where Category = '$category' and Date = '$date' and City='$location_city'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
                }
            }

            elseif((empty($date)) && ($location_state != "None") && ($location_city != "City"))
            {
                $query = "select *from job where Category = '$category' and state = '$location_state' and City='$location_city'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
                }
            }

            elseif((!(empty($date))) && ($location_state != "None") && ($location_city != "City"))
            {
                $query = "select *from job where Category = '$category' and Date = '$date' and state='$location_state' and City='$location_city'";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);

                if(mysqli_num_rows($result) > 0) {
                    if ($count > 0) {
                        $success = true;

                    } else {

                        $success = false;
                    }
                }

                if ($success == "true")
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $app_idJob=$row["idJob"];
                        $sqlquery="SELECT * FROM  appliedjobs  WHERE idJob='$app_idJob'";
                        $result2 = mysqli_query($conn, $sqlquery);
                        if(mysqli_num_rows($result2) == 0)
                        {

                            ?>
                        <div class="card">
                            <div class="container">
                                <!--            <div class="col-md-4">-->
                                <form method="post" action="elec_pg1_extend.php">
                                    <div align="center">
                                        <img src="<?php echo $row["Img"]; ?>" style="width:100%" class="img-responsive" /><br />
                                        <h4 class="text-info"><?php echo $row["TaskName"]; ?></h4>
                                        <p class="date" >Date: <?php echo $row["Date"];?></p>
                                        <p class="time">Time: <?php echo $row["Time"];?></p>
                                        <p class="loc" >Location: <?php echo $row["Location"];?></p>
                                        <label for="fee">Fee: RM </label>
                                        <input type="text" style="width: 80px; padding: 4px;"  name="fee" id="fee">
                                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                                        <input type="submit" name="submit"  class="button button2" value="Apply" id="Apply">
                                    </div>
                                </form>
                                <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Location"];?>','<?php echo $row["Description"];?>','<?php echo $row["Address"];?>','<?php echo $row["EmployerID"];?>')"  class="button button3"  type="submit" name="submit" value="ViewDetails">

                            </div>
                        </div>

                        <?php
                        }
                    }
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
</body>
</html>
