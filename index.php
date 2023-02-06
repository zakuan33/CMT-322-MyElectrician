<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>َNOTER</title>
    <link rel="shortout icon" type="image/x-icon" href="includes/favicon.png" />
    <link rel="stylesheet" href="login1.css">
    <style>
        .background{
            background-image: url("img/bg.png");
        }
    </style>
</head>

<body >
<div class="background">
    <div class="header">
        <label >
            <img class="logo" src="img/WhatsApp_Image_2021-11-17_at_2.41.13_AM-removebg-preview (1).png">
            <button onclick="login()" class="button button2">Log In</button>
            <h1 style="font-size:3vw">My Electrician</h1>
        </label>

    </div>


</div>

<div class="footer">
    <h1 style="font-size: 2vw;"> FEW THINGS TO </h1>
    <h1 style="font-size: 2vw;"> BOOST YOUR INCOME</h1>
    <h5 style="line-height: 0px; font-size:1vw">WE HELP TO SOLVE YOUR PROBLEMS JUST</h5>
    <h5 style="line-height: 0px;font-size:1vw">WITH YOUR DEVICE</h5>
    <label>
        <button onclick="myfunction()" class= "button button1" >REGISTER</button>
    </label>

</div>

<script>
    function myfunction()
    {
        location.href="emp_Register.php"
    }

    function login()
    {
        location.href="login.php"
    }
</script>
</body>


</html>
