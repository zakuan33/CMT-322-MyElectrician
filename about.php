<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv=" X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> My Electricians </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="elec_pg1.css">-->
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

    .dropdown1 {
        float: right;
        overflow: hidden;
    }

    .dropdown1 .dropbtn1{
        display: block;
        text-align: center;
        text-decoration: none;
        font-size: 17px;
        border: none;
        outline: none;
        color: white;
        padding: 10px 26px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .dropdown1:hover .dropbtn1 {
        background-color: #ddd;
        color: black;
    }
    .dropdown1-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown1-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown1-content a:hover {
        background-color: #ddd;
    }

    .dropdown1:hover .dropdown1-content {
        display: block;
    }

</style>

</head>
<div class="headertop">
    <div style="display: flex">
        <img style="height: 7%; width: 7%;" class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
        <h1 style="margin-top: 30px;">My Electrician</h1>
    </div>
</div>



<body>

<div class="topnav" id="topnav">

    <a href="logout.php">Log Out</a>
    <a href="personalElectrician.php">Personal</a>
    <a href="about.php">About</a>
    <div class="dropdown1">
        <button class="dropbtn1">Job
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown1-content">
            <a href="elec_pg1_extend.php">Available task</a>
            <a href="applied_task_extend3.php?status=Accepted">Applied task</a>
            <a href="jobCompleted2.php">Completed task</a>
        </div>
    </div>
</div>

<div >
    <!-- header -->
    <div class="ui container pad-top-30 pad-bottom-30" >
        <div class="center aligned segment">
            <div class="ui horizontal divider " style="color: white;">OUR TEAM</div>
        </div>
    </div>



    <!-- cards -->
    <div class="ui container" >
        <div class="ui four column grid">
            <div class="row">

                <div class="column">
                    <div class="ui card">
                        <div class="image">
                            <a class="ui red right ribbon label">Leader</a>
                            <img src="../assets/witch.png" />
                        </div>
                        <div class="content">
                            <a class="header">Faiz</a>
                            <div class="description">
                                Employer Job Posting Backend| Employer Job Payment Backend
                            </div>
                        </div>
                        <div class="extra content">
                            <a class="ui teal tag label">SE</a>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="ui card">
                        <div class="image">
                            <img src="img/pic.jpg" />
                        </div>
                        <div class="content">
                            <a class="header">Vinisha</a>
                            <div class="description">
                                Electrician Login Backend| Electrician Job posting Backend
                            </div>
                        </div>
                        <div class="extra content">
                            <a class="ui teal tag label">SE</a>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="ui card">
                        <div class="image">

                            <img src="img/photo_2021-10-25_10-40-24.jpg" />
                        </div>
                        <div class="content">
                            <a class="header">Dashny</a>
                            <div class="description">
                                Electrician Login | Electrician Job posting
                            </div>
                        </div>
                        <div class="extra content">
                            <a class="ui teal tag label">SE</a>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="ui card">
                        <div class="image">

                            <img src="../assets/witch.png" />
                        </div>
                        <div class="content">
                            <a class="header">Zakuan</a>
                            <div class="description">
                                Employer Job Posting | Employer Job Feedback
                            </div>
                        </div>
                        <div class="extra content">
                            <a class="ui teal tag label">SE</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="sticky-footer ">
        <div class="container my-auto">
            <div class="copyright text-center my-auto 5 " style="color: white;">
                <span> CMT 322 &copy; GROUP 16</span>
            </div>
        </div>
        <!-- </footer>  -->

</div>
</body>





