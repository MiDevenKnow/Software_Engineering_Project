<?php
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'SUBSCRIBER';

//Connecting to the Inventory Database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$stmt = $conn->query("SELECT * FROM SUBSCRIBERS;");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Creating a HTML Graphic Interface -->
<!DOCTYPE html>
<html lang="en">

<!--TITLE AND ORGANIZATION OF THE PAGE-->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MAMA B'S ONLINE WHOLESALE</title>
    <link rel="stylesheet" href="../CSS/ViewSubscribers.css" /> 
</head>

<body>
    <!--HEADER SECTION BILLING PAGE-->
    <header>
        <h1>MAMA B'S WHOLESALE</h1>
        <h3>GROCERIES ONLINE STORE</h3>
        <nav>
            <ul>
                <a href="http://localhost/Swen_project1/PHP/ViewSubscribers.php" class="REFRESH" id="REFRESH">REFRESH</a>
                <a href="http://localhost/Swen_project1/PHP/Inventory.php">HOME</a>
                <a href="http://localhost/Swen_project1/PHP/Report.php">REPORTS</a>
                <a href="http://localhost/Swen_project1/PHP/CustomerOrders.php">VIEW CUSTOMER ORDERS</a>
                
                
            </ul>
        </nav>
    </header>
    <main>
        <div class="subscriberDiv">
            <!-- FOR LOOP COLLECTING SUBSCRIBER INFORMATION -->
            <h2>SUBSCRIBERS</h2>
            <?php foreach ($results as $row) : ?>
                <ul>
                    <li><?= $row['f_name'] ?> <?= $row['l_name'] ?></li>
                    <?= $row['email'] ?>
                    <div>
                    <a href="http://localhost/Swen_project1/PHP/ViewSubscribers.php?delete=<?php echo $row['Id'];?>" class="Delete" name="Delete" value="Delete">DELETE</a>
                    </div> 
                </ul>    
            <?php endforeach; ?>
            <?php

                if(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $stmt = $conn->query("DELETE FROM SUBSCRIBERS WHERE Id='$id';"); 
                }
            ?>
        </div>   
    </main>

</body>
</html>    