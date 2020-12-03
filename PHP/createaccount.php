<?php
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'CUSTOMADMIN';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);//Create connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //checks if the request method was done via $_POST or $_GET
    $firstname = $_POST['firstname'];//collects form data after an HTML form is submitted
    $lastname = $_POST['lastname'];//collects form data after an HTML form is submitted
    $email = $_POST['email'];//collects form data after an HTML form is submitted
    $username = $_POST['username'];//collects form data after an HTML form is submitted
    $passwrd = $_POST['password'];//collects form data after an HTML form is submitted

    //used to add new records to a MySQL table.
    $stmt=$conn->query("INSERT INTO CREATEACCOUNT (f_name,l_name,username,email,password) VALUES ('$firstname','$lastname','$username','$email','$passwrd')");
    $stmt=$conn->query("INSERT INTO LOGIN (Id, username, password) SELECT Id, username, password FROM CREATEACCOUNT WHERE '$username'=username");

    header("refresh:0;url= ../HTML/login.html");
    echo '<script type="text/JavaScript">  alert("ACCOUNT CREATED"); </script>' ; 

}