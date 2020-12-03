<?php 
//starts the session
session_start();
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'CUSTOMADMIN';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);// Create connection

    if($_SERVER['REQUEST_METHOD']==='POST'){//checks if the request method was done via $_POST or $_GET
        $user=$_POST['username'];//collects form data after an HTML form is submitted
        $pass=$_POST['password'];//collects form data after an HTML form is submitted
        $_SESSION['usrname'] = $user;
       //used to select data from one or more tables
        $stmt=$conn->query("SELECT username FROM LOGIN where username='$user';");
        $stmtt=$conn->query("SELECT password FROM LOGIN where username='$user';");

        //returns an array containing all of the remaining rows in the result set.
        $resultsuser = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resultspass = $stmtt->fetchAll(PDO::FETCH_ASSOC);

        //set parameters
        $user_name="";
        $pass_wrd="";

        //iterate over elements of the array resultsuser
        foreach ($resultsuser as $data) {
            $user_name=$data['username'];
        }

        //iterate over elements of the array resultspass
        foreach ($resultspass as $data){
            $pass_wrd=$data['password']; 
        }
      
        if ($user_name!=$user || $pass_wrd!=$pass){
            //checks if username and password is invalid/ doesn't matches with data stored
            header("refresh:0;url= ../HTML/login.html");
            echo '<script type="text/JavaScript">  alert("INVALID USERNAME OR PASSWORD"); </script>' ; 
        }
          
        if($user_name==$user && $pass_wrd==$pass){
            //checks if username anpd password is valid ie. matches with the date stored.
            header("refresh:0;url= ../PHP/OrderInterface.php");
            echo '<script type="text/JavaScript">  alert("ACCESS GRANTED"); </script>' ; 
        }   
    }      
?>               