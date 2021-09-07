<?php
session_start();
$useremail = $_POST["useremail"];
$userpassword  =  $_POST["userpassword"];

$username = validateUser($useremail,$userpassword);


if ($username!="")
    echo "Welcome".$username;
else
    echo "Login Failed";


function validateUser($useremail,$userpassword){
    $dbhost = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "myshop";
    $username = "";
    $dbconnection = new mysqli($dbhost,$dbusername,$dbpassword,$dbname);
    
    if($dbconnection->error){
        echo "DB CONNECTION FAILED";
    }
    else{
        echo "DB CONNECTION ESTABLISHED <br> ";
        $sql = "SELECT * FROM logindata";
        $result = $dbconnection->query($sql);
        
    
    
        $sql = "SELECT * FROM logindata";

        $result = $dbconnection->query($sql);

        while ($row = $result-> fetch_assoc()){
            if ($row["email"]==$useremail && $row["password"]==$userpassword){
                $username = $row["name"];
                break;
            }
        }
    }    
    $dbconnection->close();
    return $username;
}

?>