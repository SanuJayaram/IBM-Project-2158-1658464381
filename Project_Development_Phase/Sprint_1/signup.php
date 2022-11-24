<?php
function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }
    $len = rand(4,$length);
    for ($i=0; $i < $len; $i++) { 
        # code...
        $text .= rand(0,9);
    }
    return $text;
}
session_start();
    include("connection.php");
    //include("functions.php");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //save to database
            $user_id = random_num(20);
            $query = "insert into users (userid,username,password) values ('$user_id','$user_name','$password')";
            mysqli_query($con,$query);
            header("Location: login.php ");
            die;

        }
        else
        {
            echo "Please enter some valid information!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
</head>
<body>
    <style type = "text/css">
      #text
    {
        height : 25px;
        border-radius: 5px;            
        padding: 4px;
        border: solid thin #aaa;
        width : 100%;
    }
    #button
    {
        padding : 10px;
        width :100%;
        color:white;
        background-color: #008B8B;
        border:none;
        font-weight: 500;
        border-radius: 6px;
    }
    .action {
	margin-top: 2rem;
    }
    #box 
    {
       background-color:#87A96B;
       margin :auto;
       width : 300px;
       padding:20px;
       border-radius: 10px;
       position: relative;
    }
    body {
	font-family: "DM Sans", sans-serif;
	line-height: 1.5;
	background-color: #f8fbf0;
	padding: 0 2rem;
    }
    #text1
    {
        line-height: 1.222;
        font-size: 1.75rem;
        font-weight: 700;
        margin:10px; 
        color: white
    }
    </style>   
    <br><br><br><br><br><br><br>
    <div id="box" >
        <form method = "post" >
        <center><div id = "text1" >Register</div><br>
        <input id = "text" type="text" name = "user_name"><br><br>
        <input id = "text" type="password" name = "password"><br><br>
        <input id = "button" type="submit" value = "Register"><br><br>
       
        <a href="login.php">Click to Login</a><br><br></center>
        </form>
    </div>

</body>
</html>
