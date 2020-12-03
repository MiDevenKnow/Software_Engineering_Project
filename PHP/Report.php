<?php
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'INVENTORY';


$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);// Create connection
$stmt = $conn->query("SELECT * FROM ITEMS;");//select all content from the database
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetches and returns an array containing all of the remaining rows in the result set.

$total_unit = 0;
$total_current = 0;
$total_expect = 0;
$total_instock = 0;
$total_sold = 0;
$total_perishables = 0;
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
    <link rel="stylesheet" href="../CSS/reports.css" />
    <!-- <script src="../JS/inventory.js"></script>-->
</head>

<body>
    <!--HEADER SECTION FOR REPORTS PAGE-->
    <header>
        <h1>MAMA B'S WHOLESALE</h1>
        <h3>GROCERIES ONLINE STORE</h3>
        <h1>Reports and Complaints</h1>
        <nav>
            <ul>
                <a href="http://localhost/Swen_project1/PHP/Inventory.php">HOME</a>
            </ul>
        </nav>
    </header>
    <main>
        <div class="firstDiv">
            <p class="message">Reports</p>
            <!--CREATION OF TABLE FOR DAILY REPORT-->
            <table>
                <tr>
                    <th>ITEM</th>
                    <th> SELLING PRICE </th>
                    <th>COST PRICE</th>
                    <th> UNIT PROFIT($) </th>
                    <th>CURRENT PROFIT($)</th>
                    <th>EXPECTED PROFIT($)</th>
                    <th>QUANTITY AVAILABLE</th>
                    <th>QUANTITY SOLD</th>
                    <th>PERISHABLES</th>
                    <!-- <th>MOST SOLD ITEMS</th>
                    <th>LOW IN STOCK</th> -->
                </tr>
                <!--FOR LOOP COLLECTING ITEM INFORMATION-->
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?= $row['name_item'] ?></td>
                        <td><?= $row['selling_price']?></td>
                        <td><?= $row['cost_price']?></td>
                        <td><? echo $unit_profit = $row['selling_price'] - $row['cost_price']?></td>
                        <td><? echo $current_profit = $unit_profit * $row['quantity_sold']?></td>
                        <td><? echo $expect_profit = $unit_profit * $row['quantity_instock'] - $unit_profit * $row['perishable']?></td>
                        <td><?= $row['quantity_instock'] - $row['perishable'] ?></td>
                        <td><?= $row['quantity_sold'] ?></td>
                        <td><?= $row['perishable']?></td>
                    </tr>
                    <!--TOTALS BEING ADDED-->
                    <?php
                    $total_unit += $unit_profit;
                    $total_current += $current_profit;
                    $total_expect += $expect_profit;
                    $total_instock += $row['quantity_instock'];
                    $total_sold += $row['quantity_sold'];
                    $total_perishables += $row['perishable'];
                    ?>
                    
                <?php endforeach; ?>
                <!--LAST ROW OF THE TABLE FOR THE TOTAL-->
                <tr class="tfoot" id="tfoot">
                    <td>TOTAL</td>
                    <td></td>
                    <td></td>
                    <td><?= $total_unit ?></td>
                    <td><?= $total_current ?></td>
                    <td><?= $total_expect ?></td>
                    <td><?= $total_instock ?></td>
                    <td><?= $total_sold ?></td>
                    <td><?= $total_perishables?></td>
                </tr>
            </table>
            <!--LISTS OF MOST SOLD ITEMS AND ITEMS LOW IN STOCK-->
            <h2>MOST SOLD ITEMS</h2>
            <ul>
                <?php foreach ($results as $row):?>
                    <?php if ($row['quantity_sold'] >= 15):?>
                        <li class="mostsold"><?= $row['name_item']?></li>
                    <?php endif;?>
                <?php endforeach;?>    
            </ul>
            <br>
            <h2>ITEMS LOW IN STOCK</h2>
            <ul>
                <?php foreach ($results as $row):?>
                    <?php if ($row['quantity_instock'] < 10):?>
                        <li class="lowstock"><?= $row['name_item']?></li>
                    <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div>

        <div class="secondDiv ">
            <p class="message ">Complaints</p>

            <!--CONNECTING TO THE CUSTCOMPLAINTS DATABASE-->
            <?php
                $dbname = 'CUSCOMPLAINTS';

                $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $stmt = $conn->query("SELECT * FROM COMPLAINTS;");
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <table>
                <tr>
                    <th>COMPLAINT ID</th>
                    <th>FIRST NAME </th>
                    <th>LAST NAME</th>
                    <th>EMAIL</th>
                    <th>COMPLAINT</th>
                    <th>DATE</th>
                </tr>
                <!--FOR LOOP COLLECTING ITEM INFORMATION-->
                <?php foreach ($results as $row) :?>
                    <tr>
                        <td><?= $row['complaintId']?></td>
                        <td><?= $row['f_name']?></td>
                        <td><?= $row['l_name']?></td>
                        <td><?= $row['email']?></td>
                        <td><?= $row['complaint']?></td>
                        <td><?= $row['dateadded']?></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </main>
</body>
</html>