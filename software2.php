<?php
session_start();
$name = "";
$password = "";
$email = "";
$phone_number = "";
$num_of_flight = "";
$gender = "";
$db=mysqli_connect('localhost' , 'root' , '' , 'flight');
if(mysqli_connect_error())
{
    echo "NOT CONNECTION";
    exit();
}
if(isset($_POST['Submit']))
{
$name = mysqli_real_escaper_string($db , $_POST['name']);
$number = mysqli_real_escaper_int($db , $_POST['number']);
}
if(empty($name)) 
{
 echo "NOT FOUND";
}
else
{
    array_pop($errors);
}
if(empty($number))
{
    echo "NOT FOUND";
}
else
{ 
    array_pop($errors);
}
if(count($errors == 0))
{
    $number = md5($number);
    $query = "delete from register where name = '$name' and number = '$number'";
    $result = mysqli_query($db , $query); 
    if(mysqli_num_rows($result) == 1)
    {
        $_SESSION['name'] = $name;
        $_session['number'] = $number;
        $_session['success'] = "FLIGHT CANCELED";
        header('location : login.php');
    }
    else
    {
        array_push($errors , "ERROR IN CANCELLATION");
    }
}
$db->close();
?>