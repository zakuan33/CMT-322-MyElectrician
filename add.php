<?php
//get data from faiz.php to edit/update
$title = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');
$date = filter_input(INPUT_POST, 'date');
$address = filter_input(INPUT_POST, 'address');
$category = filter_input(INPUT_POST, 'category');
$time = filter_input(INPUT_POST, 'time');
$state = filter_input(INPUT_POST, 'state');
$city = filter_input(INPUT_POST, 'city');
$empid = filter_input(INPUT_POST, 'employer_id');
//CREATE CONNECTION
$connection = mysqli_connect("localhost", "root", 'Gi07Vi17', "myelectrician");

echo "<script>alert('$category')</script>";
if($category=='Installation')
{
    $img='img/category/installation.jpg';
}elseif($category=='Wiring')
{
    $img='img/category/wiring.jpg';
}elseif($category=='Repairing'){
    $img='img/category/repairing.jpg';
}
echo "<script>alert('$img')</script>";

//SET CONNECTION ERROR MESSAGE IF ERROR CONNECTED
if(mysqli_connect_error()){
    die('Connection Error (' . mysqli_connect_error().')' . mysqli_connect_error());
}
else{
    $date = explode('-', $date);
    $day = $date[2];
    $month= $date[1];
    $year= $date[0];
    $date=$day.'-'.$month.'-'.$year;
    $text = "INSERT INTO job (TaskName,Date,Time,Location,Description,Address,EmployerID,Category,Img,state,city) 
        VALUES ('$title','$date','$time','$city','$description','$address','$empid','$category','$img','$state','$city')";
    $data = mysqli_query($connection, $text);
}
//create a pop up if data inserted
echo '<script>alert("New Job Updated Successfully")</script>';
//redirected web from connect.php to posted.php
echo "<script>location.href ='posted.php'</script>";
?>