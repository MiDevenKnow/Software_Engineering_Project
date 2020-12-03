<?php
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'INVENTORY';


$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);// Create connection
$stmt = $conn->query("SELECT * FROM ORDERTABLE;");//select all content from the database
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetches and returns an array containing all of the remaining rows in the result set.


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
    <link rel="stylesheet" href="../CSS/CustomerOrders.css" />
</head>

<body>
    <div class="HeaderLayout">
        <header>
            <h1>MAMA B'S WHOLESALE</h1>
            <h3>GROCERIES ONLINE INVENTORY</h3>
            <a href="http://localhost/Swen_project1/PHP/Inventory.php">HOME</a>
        </header>
    </div>  
    <table>
                <tr>
                    <th>Order Number</th>
                    <th>First Name</th>
                    <th> Last Name </th>
                    <th>Email</th>
                    <th> Name of Item</th>
                    <th>Selling Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Date Order was Date</th>
                </tr>
                <!--FOR LOOP COLLECTING ITEM INFORMATION-->
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row['Id'] ?></td>
                        <td><?= $row['f_name']?></td>
                        <td><?= $row['l_name']?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['name_item'] ?></td>
                        <td><?= $row['selling_price']?></td>
                        <td><?= $row['quantity']?></td>
                        <td><?= $row['total']?></td>
                        <td><?= $row['dateadded']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
  
</body>
</html>        