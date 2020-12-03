<?php
//starts the session
session_start();

//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'INVENTORY';
$dbname1 = 'CUSTOMADMIN';

//intitalizes variables 
$expenseTotal =0;
$gctTotal =0;

$f_name = 'NONE';
$l_name = 'NONE';
$email = 'NONE';
$id = 'NONE';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);// Create connection
$stmt = $conn->query("SELECT * FROM ITEMS;");//select all content from the database table
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetches and returns an array containing all of the remaining rows in the result set.

$conn1 = new PDO("mysql:host=$host;dbname=$dbname1", $username, $password);// Create connection
$stmt1 = $conn1->query("SELECT * FROM CREATEACCOUNT;");//select all content from the database table
$results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);//fetches and returns an array containing all of the remaining rows in the result set.


//for each loop to get firstname,lastname,email and ID of users
foreach($results1 as $row){
    if($_SESSION['usrname'] == $row['username']){
        $f_name = $row['f_name'];
        $l_name = $row['l_name'];
        $email = $row['email'];
        $id = $row['Id'];
        break;
    }
}

$i = 0;
//function uses to increment the value of i
foreach ($results as $row) {
    $i++;
}

//function used to get selling price of order
function getSellPrice($myorder)
{
    foreach ($GLOBALS['results'] as $row) {
        if ($myorder == $row['name_item']) {
            return $row['selling_price'];
        }
    }
}

//function used to get the number of an item currently in stock
function getAmount($myorder)
{
    foreach ($GLOBALS['results'] as $row) {
        if ($myorder == $row['name_item']) {
            return $row['quantity_instock'];
        }
    }
}

//function used to get row of customer's order
function getRow($myorder)
{
    $x = 0;
    foreach ($GLOBALS['results'] as $row) {
        $x++;
        if ($myorder == $row['name_item']) {
            return $x - 1;
        }
    }
}
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
    <link rel="stylesheet" href="../CSS/Bill.css" />
</head>

<body>
    <div class="HeaderLayout">
        <!--HEADER SECTION FOR ORDER PAGE-->
        <header>
            <h1>MAMA B'S WHOLESALE</h1>
            <h3>GROCERIES ONLINE STORE</h3>
            <a href="http://localhost/Swen_project1/PHP/OrderInterface.php">HOME</a>
        </header>
        <main>
            <!--Creation of bill/invoice-->
            <h3>MAMA B'S GROCERIES</h3>
            <h4>763 OLYMPIC WAY,</h4>
            <h4>KINGSTON 14.</h4>

            <h4>BILL TO:<?php echo $f_name.' '.$l_name?></h4>
            
            <h4>EMAIL :<?php echo $email?></h4>
            
            <hr>
        </main>
    </div>

    <h2>INVOICE</h2>



    <?php echo '<br>';
    //Used to output the billing table if the button submit is clicked.
    if (isset($_POST['SubmitButton'])) {
        if (!empty($_POST['arr'])) {
        echo '<table>
        <tr style="text-align:center">
        <th>QUANTITY</th>
        <th>ITEM ($)</th>
        <th>UNIT COST</th>
        <th>AMOUNT ($)</th>
        </tr>';
            $Total = 0;
            for ($x = 0; $x < $i; $x++) {
                if (!empty($_POST['arr'][$x])) {
                    if (($_POST['money'][getRow($_POST['arr'][$x])]) != 0) {
                        $amount = $_POST['money'][getRow($_POST['arr'][$x])];
                        $cost = getSellPrice($_POST['arr'][$x]);
                        
                        $expense = $amount * $cost;
                        $expenseTotal+=$expense;
                        
                        $gct = 0.15 * $expense;
                        $gctTotal+=$gct;

                        $Total += $expense + $gct;
                        echo '<tr style="text-align:center">
                    <td>' . $amount . '</td>
                    <td>' . $_POST['arr'][$x] . '</td>
                    <td>' . $cost . '</td>
                    <td>' . $expense . '</td>
                    </tr>';
                    $name_item=$_POST['arr'][$x];
                    $stmt=$conn->query("INSERT INTO ORDERTABLE (f_name,l_name,email,name_item,selling_price,quantity,total) VALUES ('$f_name','$l_name','$email','$name_item','$cost','$amount','$expense')");
                    }
                }
            }
            echo '</table>';
        }
    }
?>
    <!--Calculates subtotal,gct,grandtotal along with Miss Brown signiture and outputs it-->
    <div class="Calculations">
    <p> SUBTOTAL: $<?= $expenseTotal ?></p>
    <p> G.C.T: $<?= $gctTotal ?> </p>
    <p> GRAND TOTAL: $<?= $Total ?></p>
    <h5>SIGNED BY: MISS DIANA BROWN</h5>
</div>

<footer class="message">
    <h3>THANK YOU FOR SHOPPING WITH MAMA B'S GROCERIES.</h3>
    <h4>COME AGAIN SOON !</h4>
</footer>

</body>

</html>