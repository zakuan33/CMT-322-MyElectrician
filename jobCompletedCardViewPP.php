<?php
$query = "SELECT * FROM status where idappliedjobs='$jobsAppliedID'";
$resultR = mysqli_query($connection, $query);

if(mysqli_num_rows($resultR) > 0)
{
    while($rowR = mysqli_fetch_array($resultR))
    {
        if($rowR ['JobStatus'] == "Completed" && $rowR ['PaymentStatus'] == "Pending")
        {
            //payment pending
            ?>
            <div class="cardView" style="background-color: tomato ; color: black">
                <div class="containerView" >
                    <div class="statusBox2">
                        <p class="sta" >Payment Pending</p>
                    </div>
                    <form method="post" action="jobCompleted2.php">
                        <h4 id="task" name="taskname" class="text-info"><?php echo $row["TaskName"]; ?></h4>
                        <table style="width:50%">
                            <tr>
                                <td><p class="date" >Date: <?php echo $row["Date"];?></p></td>
                                <td><p class="time">Time: <?php echo $row["Time"];?></p></td>
                            </tr>
                        </table>
                        <p class="loc" >Location: <?php echo $row["state"];?></p>
                        <input type="hidden" name="hidden_id" value="<?php echo $row["idJob"]; ?>">
                        <input type="hidden" name="hidden_empid" value="<?php echo $row["EmployerID"]; ?>">
                        <input type="hidden" name="hidden_review" value="<?php echo "-"; ?>">
                        <input type="hidden" name="hidden_rating" value="<?php echo "-"; ?>">
                    </form>
                    <input onclick="on('<?php echo $row["idJob"]; ?>','<?php echo $row["TaskName"]; ?>','<?php echo $row["Date"];?>','<?php echo $row["Time"];?>','<?php echo $row["Address"];?>','<?php echo $row["Description"];?>','<?php echo $row["state"];?>','<?php echo $row["EmployerID"];?>','<?php echo "-";?>','<?php echo "-";?>')"  class="button button4"  type="submit" name="submit" value="ViewDetails">
                </div>
            </div>

            <?php
        }

    }
}