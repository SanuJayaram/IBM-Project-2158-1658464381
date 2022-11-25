<?php
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
        //read from database
        echo "1";
        $query = "select * from users where username = '$user_name' limit 1";
        $result = mysqli_query($con,$query);
        if($result)
        {
            echo "2";
            if($result && mysqli_num_rows($result) > 0)
            {
                echo "3";
            $user_data =mysqli_fetch_assoc($result);
            if($user_data['password'] == $password)
                {
                    echo "4";
                    $_SESSION['user_id'] =$user_data['userid'];
                    header("Location: http://127.0.0.1:5000/");
                    die;
                }
            }

        }
        else{
        echo "User name doesn't exist or password doesn't match!";
        }
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
    <title>Login</title>
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
    background-image: url('https://images.pexels.com/photos/1517355/pexels-photo-1517355.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load');
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
    <br><br><br><br><br><br><br><br>
    <div id = "box" >
        
        <form method = "post" >
        <center><div id= "text1" >Login</div><br>
        <input id = "text" type="text" name = "user_name"><br><br>
        <input id = "text" type="password" name = "password"><br><br>
        <input id = "button" type="submit" value = "Login"><br><br>
        <a href="signup.php">Click to Signup</a><br>
        <a href="University/CollegeAdmission.html">View University details</a><br><br></center>
        </form>
    </div>

</body>
</html>
