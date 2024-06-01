<?php
session_start();
$name = "";
$password = "";
$email = "";
$phone_number = "";
$num_of_flight = "";
$gender = "";
$db=mysqli_connect('localhost' , 'asmaa' , 'root' , 'mywebsite');
if(isset($_POST['login']))
{
$name = mysqli_real_escaper_string($db , $_POST['name']);
$number = mysqli_real_escaper_int($db , $_POST['number']);
}
if(empty($name)) 
{
    array_push($errors , "name is reguired");
}
if(empty($number))
{
    array_push($errors , "number of flight is required");
}
if(count($errors == 0))
{
    $number = md5($number);
    $query = "select * from register where name = '$name' and number = '$number'";
    $result = mysqli_query($db , $query); 
    if(mysqli_num_rows($result) == 1)
    {
        $_SESSION['name'] = $name;
        $_session['number'] = $number;
        $_session['success'] = "LOGIN SUCESS";
        header('location : home.php');
    }
    else
    {
        array_push($errors , "ERROE IN USERNAME OR PASSWORD");
    }
}
?>