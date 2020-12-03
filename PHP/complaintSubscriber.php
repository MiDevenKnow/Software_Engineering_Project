<?php

//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'SUBSCRIBER';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);//connects database

if (isset($_POST['SubscribeButton'])) {
    $firstname_sub = $_POST['Sfirstname'];
    $lastname_sub = $_POST['Slastname'];
    $email_sub = $_POST['Semail'];
    $stmt=$conn->query("INSERT INTO SUBSCRIBERS (f_name, l_name, email) VALUES ('$firstname_sub', '$lastname_sub', '$email_sub');");
    header("refresh:0;url= ../PHP/complaintSubscriber.php");
    echo '<script type="text/JavaScript">  alert("YOU HAVE SUBSCRIBED TO OUR MAILING LIST"); </script>' ; 
}

?>

<!-- Creating a HTML Graphic Interface -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MAMA B'S ONLINE WHOLESALE</title>
    <link rel="stylesheet" href="../CSS/complaintSubscriber.css" />
</head>

<body>
        <header>
            <h1>MAMA B'S WHOLESALE</h1>
            <h3>GROCERIES ONLINE STORE</h3>
            <a href="http://localhost/Swen_project1/PHP/OrderInterface.php">ORDER GOODS</a>
            <a href="http://localhost/Swen_project1/PHP/complaint.php">LOG A COMPLAINT</a>
        </header>
        <img src="join-mailing-list.png" alt="IMG">
        <section class="Subscribe">
            <h3>SUBSCRIBE TO OUR MAILING LIST</h3>
            <p>Get information about upcoming sales, promotions, new stocks and more</p>
            <p>Become a valued customer</p>
            <form method="POST"  action="http://localhost/Swen_project1/PHP/complaintSubscriber.php">

            <input type="text" name="Sfirstname" id="Sfirstname" placeholder="Enter your first name" required>
                <input type="text" name="Slastname" id="Slastname" placeholder="Enter your last name" required>
                <input type="email" name="Semail" id="Semail" placeholder="Enter your email address" required>
                <button type="submit" value="sub" name="SubscribeButton" class="SubscribeButton">Subscribe</button>
                </form>
            </div>
        </section>
</body>        
</html>