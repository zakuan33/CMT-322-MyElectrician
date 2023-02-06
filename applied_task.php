<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="elec_pg1.css">
    <link rel="stylesheet" href="applied_task.css">

</head>
<body>

<div class="header">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
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
            <a href="applied_task_extend3.php?status='Accepted'">Applied task</a>
            <a href="jobCompleted2.php">Completed task</a>
        </div>
    </div>

</div>
<h1 style="display: inline-block; margin-left: 25vw; margin-bottom: 0">Job Applied</h1>
<div id="overlay">
    <div class="overlay_form">
        <div class="overlay-inner">

            <i class="fa fa-close" style="font-size:24px;color:red; position: absolute;margin-left: 320px;" onclick="off()"></i>

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

        </div>
    </div>
</div>


<div class="col-25" style="  margin-left: 30px; margin-top: 40px;">
    <!--    <h4>my</h4>-->
    <div class="sidenav" id="sidenav">

        <h1>Your job choice</h1>
        <h2> Filter your desired jobs here! </h2>
        <br>
        <form method="post" action="applied_task_extend2.php">

            <p><label for="Category">Choose a job scope:</label></p>
            <select name="Category" id="category" required>
                <option name="Category" value="Show All">Show All</option>
                <option name="Category" value="Installation">Installation</option>
                <option name="Category" value="Repairing">Repairing</option>
                <option name="Category" value="Wiring">Wiring</option>
                <option name="Category" value="Others">Others</option>
            </select>

            <p><label><i></i> Date:</label></p>
            <input  type="date" placeholder="DD MM YYYY" name="Date" value="Date">
            <p><button  type="submit" name="submit" value="Search"><i ></i> Search availability</button></p>

        </form>

    </div>

</div>



<script>

    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("sidenav");

    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")

        } else {
            navbar.classList.remove("sticky");

        }
    }
</script>


</body>
</html>

