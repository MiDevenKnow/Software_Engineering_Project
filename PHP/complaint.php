<?php
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'CUSCOMPLAINTS';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);//Create connection, connects the database to make it accessible

//Used to store&post first and last name,email and complaints if the complaint button is clicked.
if (isset($_POST['ComplaintButton'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $complaint = $_POST['complaints'];

    $stmt=$conn->query("INSERT INTO COMPLAINTS (f_name,l_name,email,complaint) VALUES ('$firstname','$lastname','$email', '$complaint');");
    header("refresh:0;url= ../PHP/complaint.php");
    echo '<script type="text/JavaScript">  alert("COMPLAINT WAS LOGGED"); </script>' ; 
}
?>

<!-- Creating a HTML Graphic Interface -->
<!DOCTYPE html>
<html>

<!--TITLE AND ORGANIZATION OF THE PAGE-->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../CSS/complaint.css" />
</head>
<body>
    <!--HEADER SECTION BILLING PAGE-->
        <header>
            <h1>MAMA B'S WHOLESALE</h1>
            <h3>GROCERIES ONLINE STORE</h3>
            <a href="http://localhost/Swen_project1/PHP/OrderInterface.php">ORDER GOODS</a>
            <a href="http://localhost/Swen_project1/PHP/complaintSubscriber.php"> SUBSCRIBE TO OUR MAILING LIST</a>

        </header>
        <section class="Complaints">

            <div class="complaintsInput" id="complaintsInput">
                <div class="complaintsimg" data-tilt>
     
                            <img src="../HTML/send.jpeg" alt="IMG">
                </div>
                    <h1>We are here to assist you!</h1>
                    <h2>Please complete the form below for your complaints.</h2>
                    
                    <!--Creation of Complaint form-->
                    <form method="POST"  action="http://localhost/Swen_project1/PHP/complaint.php">

                        <label id="firstname"for="firstname">First Name</label>
                        <label id="lastname1"for="lastname">Last Name</label><br>
                        <input type="text" id="firstname" name="firstname" placeholder="Your first name.." required>
                        <input type="text" id="lastname" name="lastname" placeholder="Your last name.." required>
                        <label id="firstname"for="firstname">Email</label><br>
                        <input type="email" name="email" id="email" placeholder="Your email address..">                        <br>	
                        <label for="subject">Subject</label><br>
                        <textarea id="subject" name="complaints" placeholder="Write complaint here.." style="height:200px" required></textarea><br>
                        <button type="submit" value="cmpt" name="ComplaintButton" class="ComplaintButton">Submit</button>    
                    </form>
            </div>
    
        </section>    
</body>        
</html>
