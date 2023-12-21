<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "queenzi";

if (!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");
}

if ( $_SERVER['REQUEST_METHOD']=="post")
{
    $username = $_post['username'];
    $password = $_post['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username))
    {
        $query = "select * from clint where name = '$username' limit 1 ";
        $result = mysqli_query($con , $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $userdata = mysqli_fetch_assoc($result);
                if($userdata['password'] === $password)
                {
                    $_SESSION['username'] = $userdata['name'] ;
                    header("location : index.php");
                    die;
                }
            }
        }
    }
    echo('right username and password');
}else{
    echo('wrong username and password');
}
?>