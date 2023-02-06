<?php
session_start();
$employerID = $_SESSION['user'];
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

<!--<body style="background-image: url('img/bg7.png');">-->
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

<!--White boc Background-->
<div style="
      background: #24265d;
      margin: 50px;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 10px 15px 15px 0 rgba(0,0,0,0.2);">
    <!--Navs&tabs for type of tasks-->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-posted" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Posted</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-pending" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Pending</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="payment" aria-selected="false">Payment</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Completed</button>
        </li>

        <li style="padding-left: 75px;">
            <!-- Button trigger post task -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>
        </li>
    </ul>

    <!-- POP-UP ADD TASK -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="add.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Need electrician?Post the task here</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Job Title</span>
                            <input type="title" class="form-control" placeholder="Job Title" aria-label="Username" name="title" required>
                        </div>

                        <div class="input-group  mb-3">
                            <span class="input-group-text">Job Description</span>
                            <textarea name="description" class="form-control" aria-label="With textarea" required></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon3">Address</span>
                            <textarea name="address" class="form-control"  aria-describedby="basic-addon3" required></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Date</span>
                            <!--                            <span class="input-group-text">RM</span>-->
                            <input type="date" class="form-control" placeholder="date" aria-label="date" name="date" required>
                            <!--                            <span class="input-group-text">.00</span>-->
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Time</span>
                            <!--                            <span class="input-group-text">RM</span>-->
                            <input type="time" class="form-control" placeholder="00" aria-label="Time" name="time" required>
                            <!--                            <span class="input-group-text">.00</span>-->
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Category</span>
                            <select name="category" class="form-select" id="category" required="">
                                <option value="">Choose...</option>
                                <option value="Installation">Installation</option>
                                <option value="Wiring">Wiring</option>
                                <option value="Repairing">Repairing</option>

                            </select>
                        </div>

                        <!--                        <div class="input-group mb-3">-->
                        <!--                            <span class="input-group-text">State</span>-->
                        <!--                            <input type="text" class="form-control" placeholder="State" aria-label="State" name="state" required>-->
                        <!--                        </div>-->

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">State</span>
                            <select name="state" id="State" class="form-select" required="">
                                <option name="State" value="None">None</option>
                                <option name="State" value="Johor">Johor</option>
                                <option name="State" value="Kedah">Kedah</option>
                                <option name="State" value="Kelantan">Kelantan</option>
                                <option name="State" value="Kuala Lumpur">Kuala Lumpur</option>
                                <option name="State" value="Labuan">Labuan</option>
                                <option name="State" value="Malacca">Malacca</option>
                                <option name="State" value="Negeri Sembilan">Negeri Sembilan</option>
                                <option name="State" value="Pahang">Pahang</option>
                                <option name="State" value="Perak">Perak</option>
                                <option name="State" value="Perlis">Perlis</option>
                                <option name="State" value="Penang">Penang</option>
                                <option name="State" value="Sabah">Sabah</option>
                                <option name="State" value="Sarawak">Sarawak</option>
                                <option name="State" value="Selangor">Selangor</option>
                                <option name="State" value="Terengganu">Terengganu</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">City</span>
                            <input type="text" class="form-control" placeholder="City" aria-label="City" name="city" required>
                        </div>

                        <input type="hidden" class="form-control" placeholder="employer_id" aria-label="employer_id" name="employer_id" value=<?php echo $employerID; ?> required>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" value="save">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Tab content-->
    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-posted" role="tabpanel" aria-labelledby="pills-home-tab">
            <!--List of posted tasks-->
            <div class="list-group">
                <?php
                // connect to database myelectrician
                $connection = mysqli_connect("localhost", "root", 'Gi07Vi17', "myelectrician");
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $CurrentUser=  $_SESSION['user'];

                $fetch = "SELECT * FROM job WHERE EmployerID='$CurrentUser'";


                //to make sure that the data is fetch in the database using $connection

                $result = $connection->query($fetch);
                //to print the all the data on table 'teks' that is fetched

                while($print = $result->fetch_assoc()) {

                    $jobid=$print['idJob'];

                    $fetch2="SELECT * FROM appliedjobs WHERE idJob='$jobid' AND status='Accepted'";
                    $result2 = mysqli_query($connection, $fetch2);
                    $found=false;

                    if (mysqli_num_rows($result2) == 0)
                    {
                        ?>

                        <div type="button" >
                            <a  href="request.php?jobid=<?php echo $print['idJob'];?>" class="list-group-item list-group-item-action hover-custom_posted " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $print['TaskName'];?></h5>
                                    <span style="float:right" type="button" class="btn btn-secondary"  >Application list</span>
                                </div>

                                <p class="mb-1"><?php echo$print['Description']?></p>

                            </a>
                        </div>

                    <?php }}
                $connection->close(); ?>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-profile-tab">
            <!--List of pending tasks-->

            <ul class="list-group">
                <?php
                // connect to database myelectrician
                $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                $fetch = "SELECT * FROM job WHERE EmployerID='$CurrentUser'";
                //to make sure that the data is fetch in the database using $connection
                $result = $connection->query($fetch);

                //to print the all the data on table 'teks' that is fetched
                while($print = $result->fetch_assoc()) {
                    $found=false;
                    $jobid=$print['idJob'];

                    $fetch2="SELECT * FROM appliedjobs WHERE idJob='$jobid' AND status='Accepted'";
                    $result2 = mysqli_query($connection, $fetch2);

                    $print2 = mysqli_fetch_array($result2);
                    if (mysqli_num_rows($result2) > 0)
                    {
                        $appliedid=$print2['idappliedjobs'];
                        $fetch3="SELECT * FROM status WHERE idappliedjobs='$appliedid' AND JobStatus='Pending' AND PaymentStatus='Pending'";
                        $result3=mysqli_query($connection,$fetch3);
                        if (mysqli_num_rows($result3) > 0)
                        {
                            $found=true;
                        }

                    }

                    if($found==true){
                        ?>
                        <div type="button" >

                            <a href="pending.php?jobid=<?php echo $print['idJob'];?>" class="list-group-item list-group-item-action hover-custom_posted " aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $print['TaskName'];?></h5>
                                </div>
                                <span style="float:right" type="button" class="btn btn-secondary"  >
                                        Job Details
                                     </span>
                                <p class="mb-1"><?php echo$print['Description']?></p>
                                <small>RM <?php echo $print2['fee'] ;?></small>
                            </a>
                        </div>
                    <?php }}$connection->close(); ?>

            </ul>
        </div>

        <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="payment-tab">

            <!--List of PAYMENT tasks-->
            <ol class="list-group list-group-numbered">
                <?php
                // connect to database myelectrician
                $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                $fetch = "SELECT * FROM job WHERE EmployerID='$CurrentUser'";
                //to make sure that the data is fetch in the database using $connection
                $result = $connection->query($fetch);


                //to print the all the data on table 'teks' that is fetched
                while($print = $result->fetch_assoc()) {

                    $found=false;
                    $jobid=$print['idJob'];

                    $fetch2="SELECT * FROM appliedjobs WHERE idJob='$jobid' AND status='Accepted'";
                    $result2 = mysqli_query($connection, $fetch2);

                    $print2 = mysqli_fetch_array($result2);
                    if (mysqli_num_rows($result2) > 0)
                    {
                        $appliedid=$print2['idappliedjobs'];
                        $fetch3="SELECT * FROM status WHERE idappliedjobs='$appliedid' AND JobStatus='Completed' AND PaymentStatus='Pending'";
                        $result3=mysqli_query($connection,$fetch3);
                        if (mysqli_num_rows($result3) > 0)
                        {
                            $found=true;
                        }

                    }

                    if($found==true){

                        ?>

                        <div type="button"  data-bs-toggle="modal" data-bs-target="#payment_modal">
                            <a href="Payment.php?jobid=<?php echo $print['idJob']; ?>"class="list-group-item list-group-item-action hover-custom_posted" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $print['TaskName'];?></h5>
                                </div>
                                <span  style="float:right" type="button" class="btn btn-secondary"  >
                                                 Pay
                                             </span>
                                <p class="mb-1"><?php echo $print['Description']?></p>
                                <small>RM <?php echo $print2['fee'] ;?></small>
                            </a>

                        </div>

                    <?php }}
                $connection->close(); ?>
            </ol>

        </div>

        <div class="tab-pane fade" id="pills-completed" role="tabpanel" aria-labelledby="pills-contact-tab">

            <!--List of completed tasks-->
            <ol class="list-group list-group-numbered">
                <?php
                // connect to database myelectrician
                $connection = mysqli_connect("localhost", "root", "Gi07Vi17", "myelectrician");
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                $fetch = "SELECT * FROM job WHERE EmployerID='$CurrentUser'";
                //to make sure that the data is fetch in the database using $connection
                $result = $connection->query($fetch);
                //to print the all the data on table 'teks' that is fetched
                while($print = $result->fetch_assoc()) {

                    $found=false;
                    $jobid=$print['idJob'];

                    $fetch2="SELECT * FROM appliedjobs WHERE idJob='$jobid' AND status='Accepted'";
                    $result2 = mysqli_query($connection, $fetch2);

                    $print2 = mysqli_fetch_array($result2);
                    if (mysqli_num_rows($result2) > 0)
                    {
                        $appliedid=$print2['idappliedjobs'];
                        $fetch3="SELECT * FROM status WHERE idappliedjobs='$appliedid' AND JobStatus='Completed' AND PaymentStatus='Completed'";
                        $result3=mysqli_query($connection,$fetch3);
                        if (mysqli_num_rows($result3) > 0)
                        {
                            $found=true;
                        }

                    }

                    if($found==true){

                        ?>
                        <div type="button"  >

                            <a href="rate.php?jobid=<?php echo $print['idJob'];?>" class="list-group-item list-group-item-action hover-custom_posted" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $print['TaskName'];?></h5>
                                </div>
                                <span style="float:right" type="button" class="btn btn-secondary"  >
                                            Rate
                                        </span>
                                <p class="mb-1"><?php echo$print['Description']?></p>
                                <small>RM <?php echo $print2['fee'] ;?></small>
                            </a>
                        </div>

                    <?php }}$connection->close(); ?>
            </ol>

        </div>

        <div class="modal fade" id="rate_modal_testbelumguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Pop Up Rating -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Need electrician?Post the task here</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Reject</button>
                            <button type="button" class="btn btn-primary">Accept</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>





    </div>

</div>

</body>
</html>