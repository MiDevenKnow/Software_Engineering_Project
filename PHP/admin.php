<?php 
$host = 'localhost'; //sets the variable host to localhost
$username = 'admin';//sets the variable username to admin
$password = 'mamab';//sets the variable password to mamab
$dbname = 'CUSTOMADMIN';//sets the variable databasename to CUSTOMADMINS

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); //Create connection, connects the database to make it accessible

    if($_SERVER['REQUEST_METHOD']==='POST'){ //checks if the request method was done via $_POST or $_GET
        $user=$_POST['username']; //collects form data after an HTML form is submitted
        $pass=$_POST['password'];//collects form data after an HTML form is submitted

        //selects data from tables
        $stmt=$conn->query("SELECT username FROM ADMINLOGIN where username='$user';");
        $stmtt=$conn->query("SELECT password FROM ADMINLOGIN where username='$user';");

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

        //iterate over elements of an array resultspass
        foreach ($resultspass as $data){
            $pass_wrd=$data['password']; 
        }

        if ($user_name!=$user || $pass_wrd!=$pass){ 
            //checks if username and password is invalid/ doesn't matches with data stored.
            header("refresh:0;url= ../HTML/Adminlogin.html");
            echo '<script type="text/JavaScript">  alert("INVALID USERNAME OR PASSWORD"); </script>' ; 
        }
          
        if($user_name==$user && $pass_wrd==$pass){
            //checks if username and password is valid ie. matches with the date stored.
            header("refresh:0;url= ../PHP/Inventory.php");
            echo '<script type="text/JavaScript">  alert("ACCESS GRANTED"); </script>' ; 
        }    
    }
        
?>               
      
